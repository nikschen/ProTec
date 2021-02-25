<?php


/**
 * Class AdministrativeOperationsController
 * Provides all logics for the administration menu
 */
class AdministrativeOperationsController extends \protec\core\Controller
{
    /**
     *  Only provides tab title because of the absence of dynamic elements
     */
    public function actionChooseOperation()
    {
        $title = 'Admin@ProTec';
        $this->setParam('title', $title);
    }

    /**
     * Checks for input of a customerID and the admin password to delete a customer
     * Provides errors for wrong customerID and wrong password
     */
    public function actionManageCustomers()
    {
        $success=null;
        $errors = [];
        $db = $GLOBALS["db"];

        if (isset($_POST["password"]) && isset($_POST["submit"])) //check for password and submit being set
        {
            $admin = \protec\model\Account::findOne("username=\"admin@protec.de\"");
            $pwdHash = $admin->passwordHash;
    
            if (password_verify($_POST["password"], $pwdHash)) //check for correct password of the admin account
            {
                $sqlParamCustomer="customerID="."\"".$_POST["customerID"]."\"";
                $sqlParamAccount="accountID="."\"".$_POST["customerID"]."\"";
    
                if(empty(\protec\model\Customer::findOne($sqlParamCustomer)) || empty(\protec\model\Account::findOne($sqlParamAccount))) //checks for given customer and account being valid objects in the database
                {
                    $errors[]="Keine gültige ID.";
                }
                else //deletion of the customer and its associated account
                {
                    $customerToBeDeleted=\protec\model\Customer::findOne($sqlParamCustomer);
                    $accountToBeDeleted=\protec\model\Account::findOne($sqlParamAccount);
                    $accountToBeDeleted->delete($errors);
                    $customerToBeDeleted->delete($errors);
                    $success="Kunde erfolgreich gelöscht";
                }
            }
            else
            {
                $errors[]="Das eingegebene Passwort ist nicht korrekt";
            }
        }
    
        $this->setParam('success', $success);
        $this->setParam('errors', $errors);
        $title = 'Admin@ProTec > Kundenverwaltung';
        $this->setParam('title', $title);
    }

    /**
     * checks for input of a productID, the admin password and all needed attributes of a 'Product' object, depending on the form data, to insert a product into the database
     * OR
     * checks for input of a productID, the admin password and several changed attributes of a 'Product' object, depending on the form data, to change a product's data in the database
     * OR
     * checks for input of a productID and the admin password to delete a product
     * Provides errors for wrong productID, wrong password and wrong or missing product data
     */
    public function actionManageProducts()
    {
        $addProductSuccess = [];
        $productChangeSuccess = [];
        $deleteProductSuccess = [];
        $addProductErrors = [];
        $changeProductErrors = [];
        $deleteProductErrors = [];
        $db = $GLOBALS["db"];
        $categories = getAllCategories();
        $this->setParam('categories', $categories);






        if (isset($_POST["password"]) && isset($_POST["submit"])) {  //check for password and submit being set
            $admin = \protec\model\Account::findOne("username=\"admin@protec.de\"");
            $pwdHash = $admin->passwordHash;
            
            if (password_verify($_POST["password"], $pwdHash)) { //check for correct password of the admin account
                
                switch ($switch = $_POST["submit"]) { //switch for the kind of operation wished, either to add, change or delete a product
                    case $switch == "addProduct":
                        
                        if (!isset($_POST["category"])) {
                            $addProductErrors[] = "Keine Kategorie angegeben";
                            }
                            else
                            {
                                foreach ($_POST as $key => $value) {
                                    if ($key != "submit") { //no submit in values array
                                        $values[$key] = $value;
                                    }
                                }
                                array_pop($values); //no admin password in values array
        
                                $newProduct = new \protec\model\Product($values);
                                $newPricing = new \protec\model\Pricing($values);
        
                                $productErrors = array();
                                $pricingErrors = array();
        
                                $newProduct->validate($productErrors);
                                $newPricing->validate($pricingErrors);
                                validateUploadedProductImage($addProductErrors);
        
        
                                if (empty($productErrors) && empty($pricingErrors) && empty($addProductErrors)) { //check for validation being successful for all uploaded data, if true, inserts are executed
                                    $newProduct->insert();
                                    $newPricing->insert();
            
                                    $uploadFolder = IMAGESPATH; //Upload-directory
                                    $filename = $db->lastInsertId();
                                    $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
                                    $destinationPath = $uploadFolder . $filename . '.' . $extension;
                                    move_uploaded_file($_FILES['file']['tmp_name'], $destinationPath);
                                    $_POST = array();
                                    $addProductSuccess[]="Produkt erfolgreich hinzugefügt";
                                }
                                else {
                                    if (!empty($productErrors)) {
                                        $addProductErrors[] = "Produktdaten sind ungültig";
                                    }
                                    if (!empty($pricingErrors)) {
                                        $addProductErrors[] = "Preisdaten sind ungültig";
                                    }
                                }
                            }
                        break;
                        
                    case $switch == "changeProduct":
                        
                        $pricingID=$_POST["productID"];
                        $productID=$_POST["productID"];
                        $sqlParamPricing="pricingID="."\"".$pricingID."\"";
                        $sqlParamProduct="productID="."\"".$productID."\"";
                        if(empty(\protec\model\Pricing::findOne($sqlParamPricing))){$changeProductErrors[]="Keine gültige ID";} //check for valid ID
                        else if(empty(\protec\model\Product::findOne($sqlParamProduct))){$changeProductErrors[]="Keine gültige ID";}//check for valid ID
                        else
                        {
                            foreach ($_POST as $key => $value)
                            {
                                if ($key != "submit" && isset($key)) //no submit in values array
                                {
                                    if ($key == "currency" && empty($_POST["amount"]) || $key == "productID" || $key == "password" || $value == "") //currency is not changed if amount does not change
                                    {
                                        continue;
                                    }
                                    else if ($key == "currency" && !empty($_POST["amount"]) || $key == "amount")
                                    {
                                        $pricingValues[] = "`$key`=\"$value\"";
                                    }
                                    else
                                    {
                                        $productValues[] = "`$key`=\"$value\"";
                                    }
                                }
                            }
                            $sqlParamProduct = "productID=" . "\"" . $_POST["productID"] . "\"";
                            $sqlParamPricing = "pricingID=" . "\"" . $_POST["productID"] . "\"";
                            $toBeChangedProduct = \protec\model\Product::findOne($sqlParamProduct);
                            $toBeChangedPricing = \protec\model\Pricing::findOne($sqlParamPricing);
    
                            if (!empty($productValues)) //checks for data being empty
                            {
                                $toBeChangedProductBefore=\protec\model\Product::findOne($sqlParamProduct);

                                $toBeChangedProduct->update($productValues, $toBeChangedProduct->productID);

                                $toBeChangedProductAfter = \protec\model\Product::findOne($sqlParamProduct);

                                if($toBeChangedProductBefore==$toBeChangedProductAfter)
                                {
                                    $changeProductErrors[]="Es wurden keine veränderten Daten erkannt.";
                                }
                                else
                                {
                                    $productChangeSuccess[]="Produktdaten erfolgreich geändert";
                                }

                            }
                            else
                            {
                                $changeProductErrors[]="Keine zu ändernden Produktdaten angegeben.";
                            }

                            if (!empty($pricingValues)) //checks for data being empty
                            {
                                $toBeChangedPricingBefore=\protec\model\Pricing::findOne($sqlParamPricing);

                                $toBeChangedPricing->update($pricingValues, $toBeChangedPricing->pricingID);

                                $toBeChangedPricingAfter = \protec\model\Pricing::findOne($sqlParamPricing);

                                if( $toBeChangedPricingBefore==$toBeChangedPricingAfter)
                                {
                                    $changeProductErrors[]="Es wurden keine veränderten Daten erkannt.";
                                }
                                else
                                {
                                    $productChangeSuccess[] = "Preisdaten erfolgreich geändert";
                                }
                            }
                            else
                            {
                                $changeProductErrors[]="Keine zu ändernden Preisdaten angegeben.";
                            }
                            
                            if(!empty($_FILES) && empty($changeProductErrors))  //if product or pricing is changed, image will be changed too if provided
                            {
                                $uploadFolder = IMAGESPATH; //Upload-Directory
                                $filename = $toBeChangedProduct->productID;
                                $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
                                $destinationPath = $uploadFolder . $filename . '.' . $extension;
                                move_uploaded_file($_FILES['file']['tmp_name'], $destinationPath);
                                $_POST= [];
                            }
                            
                        }
                        break;
                        
                    case $switch == "deleteProduct":
    
                        
                        
                        $pricingID=$_POST["productID"];
                        $productID=$_POST["productID"];
                        $sqlParamPricing="pricingID="."\"".$pricingID."\"";
                        $sqlParamProduct="productID="."\"".$productID."\"";
                        
                        if(empty(\protec\model\Pricing::findOne($sqlParamPricing))){$deleteProductErrors[]="Keine gültige ID";} //check for valid ID
                        else if(empty(\protec\model\Product::findOne($sqlParamProduct))){$deleteProductErrors[]="Keine gültige ID";} //check for valid ID
                        else
                        {
                            $pricingToBeRemoved = \protec\model\Pricing::findOne($sqlParamPricing);
                            $productToBeRemoved = \protec\model\Product::findOne($sqlParamProduct);
    
    
                            $pricingToBeRemoved->delete($deleteProductErrors);
                            $productToBeRemoved->delete($deleteProductErrors);
                            if(empty($deleteProductErrors)) $deleteProductSuccess[]="Produkt erfolgreich gelöscht";
                        }
                        break;
                }
            }
            else //error if password is wrong
            {
                switch ($switch = $_POST["submit"])
                {
                    case $switch == "addProduct":  $addProductErrors[]="Das eingegebene Passwort ist nicht korrekt"; break;
                    case $switch == "changeProduct": $changeProductErrors[]="Das eingegebene Passwort ist nicht korrekt"; break;
                    case $switch == "deleteProduct": $deleteProductErrors[]="Das eingegebene Passwort ist nicht korrekt"; break;
                }
            }
        }




        if(isset($_POST["submit"]))
        {
            $quantityStoredValueAdd='';
            $categoryValueAdd='Kategorie wählen';
            $prodNameValueAdd='';
            $prodDescriptionValueAdd='';
            $amountValueAdd='';
            $currencyValueAdd='Euro';

            $productIDValueChange='';
            $quantityStoredValueChange='';
            $categoryValueChange='Kategorie wählen';
            $prodNameValueChange='';
            $prodDescriptionValueChange='';
            $amountValueChange='';
            $currencyValueChange='Euro';

            if($_POST["submit"]=="loadDataFromDB") //checks for button in change product section of the admin menu, provides possibility to load the existing data of a product from the database by its productID
            {
                $productID=$_POST["productID"];
                $sqlProduct="productID="."\"".$productID."\"";
                $product=\protec\model\Product::findOne($sqlProduct);
                $sqlPricing="pricingID="."\"".$productID."\"";
                $pricing=\protec\model\Pricing::findOne($sqlPricing);

                if(!empty($product)&&!empty($pricing))
                {
                    $productIDValueChange=$productID;
                    $quantityStoredValueChange=$product->quantityStored;
                    $categoryValueChange=$product->category;
                    $prodNameValueChange=$product->prodName;
                    $prodDescriptionValueChange=$product->prodDescription;
                    $amountValueChange=$pricing->amount;
                    $currencyValueChange=$pricing->currency;
                }
                else
                {
                    $changeProductErrors[]="Es ist kein Produkt mit dieser ID vorhanden.";
                }

            }
            else if ($_POST["submit"]=="addProduct" && empty($addProductSuccess)) //prefills the correct form with data from the POST array for user convenience after reloading the page or getting an error
            {
                $quantityStoredValueAdd=htmlspecialchars($_POST['quantityStored']??'');
                $categoryValueAdd=htmlspecialchars($_POST['category']??'');
                $prodNameValueAdd=htmlspecialchars($_POST['prodName']??'');
                $prodDescriptionValueAdd=htmlspecialchars($_POST['prodDescription']??'');
                $amountValueAdd=htmlspecialchars($_POST['amount']??'');
                $currencyValueAdd=htmlspecialchars($_POST['currency']??'Euro');

                $productIDValueChange='';
                $quantityStoredValueChange='Kategorie wählen';
                $categoryValueChange='';
                $prodNameValueChange='';
                $prodDescriptionValueChange='';
                $amountValueChange='';
                $currencyValueChange='Euro';
            }
            else if ($_POST["submit"]=="changeProduct" && empty($productChangeSuccess)) //prefills the correct form with data from the POST array for user convenience after reloading the page or getting an error
            {
                $productIDValueChange=htmlspecialchars($_POST['productID']??'');
                $quantityStoredValueChange=htmlspecialchars($_POST['quantityStored']??'');
                $categoryValueChange=htmlspecialchars($_POST['category']??'');
                $prodNameValueChange=htmlspecialchars($_POST['prodName']??'');
                $prodDescriptionValueChange=htmlspecialchars($_POST['prodDescription']??'');
                $amountValueChange=htmlspecialchars($_POST['amount']??'');
                $currencyValueChange=htmlspecialchars($_POST['currency']??'Euro');

                $quantityStoredValueAdd='';
                $categoryValueAdd='Kategorie wählen';
                $prodNameValueAdd='';
                $prodDescriptionValueAdd='';
                $amountValueAdd='';
                $currencyValueAdd='Euro';
            }



        }
        else if(isset($_POST["reset"])) //clears the form because reset button malfunctioned on this site
        {

            $quantityStoredValueAdd='';
            $categoryValueAdd='Kategorie wählen';
            $prodNameValueAdd='';
            $prodDescriptionValueAdd='';
            $amountValueAdd='';
            $currencyValueAdd='Euro';


            $productIDValueChange='';
            $quantityStoredValueChange='';
            $categoryValueChange='Kategorie wählen';
            $prodNameValueChange='';
            $prodDescriptionValueChange='';
            $amountValueChange='';
            $currencyValueChange='Euro';
        }
        else //no prefilled data if not any of the given cases is matched
        {

            $quantityStoredValueAdd='';
            $categoryValueAdd='Kategorie wählen';
            $prodNameValueAdd='';
            $prodDescriptionValueAdd='';
            $amountValueAdd='';
            $currencyValueAdd='Euro';


            $productIDValueChange='';
            $quantityStoredValueChange='';
            $categoryValueChange='Kategorie wählen';
            $prodNameValueChange='';
            $prodDescriptionValueChange='';
            $amountValueChange='';
            $currencyValueChange='Euro';
        }


        $this->setParam('quantityStoredValueAdd',$quantityStoredValueAdd);
        $this->setParam('categoryValueAdd',$categoryValueAdd);
        $this->setParam('prodNameValueAdd',$prodNameValueAdd);
        $this->setParam('prodDescriptionValueAdd',$prodDescriptionValueAdd);
        $this->setParam('amountValueAdd',$amountValueAdd);
        $this->setParam('currencyValueAdd',$currencyValueAdd);


        $this->setParam('productIDValueChange',$productIDValueChange);
        $this->setParam('quantityStoredValueChange',$quantityStoredValueChange);
        $this->setParam('categoryValueChange',$categoryValueChange);
        $this->setParam('prodNameValueChange',$prodNameValueChange);
        $this->setParam('prodDescriptionValueChange',$prodDescriptionValueChange);
        $this->setParam('amountValueChange',$amountValueChange);
        $this->setParam('currencyValueChange',$currencyValueChange);



        $this->setParam('addProductSuccess', $addProductSuccess);
        $this->setParam('changeProductSuccess', $productChangeSuccess);
        $this->setParam('deleteProductSuccess', $deleteProductSuccess);
        $this->setParam('addProductErrors', $addProductErrors);
        $this->setParam('changeProductErrors', $changeProductErrors);
        $this->setParam('deleteProductErrors', $deleteProductErrors);
    
        $title = 'Admin@ProTec > Produktverwaltung';
        $this->setParam('title', $title);
    }
    
    
}