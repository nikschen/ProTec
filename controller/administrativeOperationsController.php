<?php


class AdministrativeOperationsController extends \protec\core\Controller
{
    public function actionChooseOperation()
    {
        $title = 'Admin@ProTec';
        $this->setParam('title', $title);
    }
    
    public function actionManageCustomers()
    {
        $title = 'Admin@ProTec > Kundenverwaltung';
        $this->setParam('title', $title);
    }
    
    public function actionManageProducts()
    {
        $addProductErrors = [];
        $changeProductErrors = [];
        $deleteProductErrors = [];
        $db = $GLOBALS["db"];
        $categories = getAllCategories();
        $this->setParam('categories', $categories);
        
        if (isset($_POST["password"]) && isset($_POST["submit"])) {
            $admin = \protec\model\Account::findOne("username=\"admin@protec.de\"");
            $pwdHash = $admin->passwordHash;
            
            if (password_verify($_POST["password"], $pwdHash)) {
                
                switch ($switch = $_POST["submit"]) {
                    case $switch == "addProduct":
                        
                        if (!isset($_POST["category"])) {
                            $addProductErrors[] = "Keine Kategorie angegeben";
                            }
                            else
                            {
                                foreach ($_POST as $key => $value) {
                                    if ($key != "submit") {
                                        $values[$key] = $value;
                                    } //submit braucht nicht in values array
                                }
                                array_pop($values);
        
                                $newProduct = new \protec\model\Product($values);
                                $newPricing = new \protec\model\Pricing($values);
        
                                $productErrors = array();
                                $pricingErrors = array();
        
                                $newProduct->validate($productErrors);
                                $newPricing->validate($pricingErrors);
                                validateUploadedProductImage($addProductErrors);
        
        
                                if (empty($productErrors) && empty($pricingErrors) && empty($addProductErrors)) {
                                    $newProduct->insert();
                                    $newPricing->insert();
            
                                    $uploadFolder = IMAGESPATH; //Upload-Verzeichnis
                                    $filename = $db->lastInsertId();
                                    $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
                                    $destinationPath = $uploadFolder . $filename . '.' . $extension;
                                    move_uploaded_file($_FILES['file']['tmp_name'], $destinationPath);
                                    $_POST = array();
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
                        if(empty(\protec\model\Pricing::findOne($sqlParamPricing))){$changeProductErrors[]="Keine gültige ID";}
                        else if(empty(\protec\model\Product::findOne($sqlParamProduct))){$changeProductErrors[]="Keine gültige ID";}
                        else
                        {
                            foreach ($_POST as $key => $value)
                            {
                                if ($key != "submit" && isset($key)) //submit braucht nicht in values array
                                {
                                    if ($key == "currency" && empty($_POST["amount"]) || $key == "productID" || $key == "password" || $value == "") //currency wird nicht übernommen, wenn sich der Preis nicht ändert
                                    {
                                        continue;
                                    }
                                    else if ($key == "currency" && !empty($_POST["amount"]) || $key == "amount")
                                    {
                                        $pricingValues[] = "$key=\"$value\"";
                                    }
                                    else
                                    {
                                        $productValues[] = "$key=\"$value\"";
                                    }
                                }
                            }
                            $sqlParamProduct = "productID=" . "\"" . $_POST["productID"] . "\"";
                            $sqlParamPricing = "pricingID=" . "\"" . $_POST["productID"] . "\"";
                            $toBeChangedProduct = \protec\model\Product::findOne($sqlParamProduct);
                            $toBeChangedPricing = \protec\model\Pricing::findOne($sqlParamPricing);
    
                            if (!empty($productValues))
                            {
                                $toBeChangedProduct->update($productValues, $toBeChangedProduct->productID);
                            }
                            else if (!empty($pricingValues))
                            {
                                $toBeChangedPricing->update($pricingValues, $toBeChangedPricing->pricingID);
                            }
                            else
                            {
                                $changeProductErrors[]="Keine zu ändernden Produkt- oder Preisdaten angegeben.";
                            }
                            
                            if(!empty($_FILES) && empty($changeProductErrors))
                            {
                                $uploadFolder = IMAGESPATH; //Upload-Verzeichnis
                                $filename = $toBeChangedProduct->productID;
                                $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
                                $destinationPath = $uploadFolder . $filename . '.' . $extension;
                                move_uploaded_file($_FILES['file']['tmp_name'], $destinationPath);
                                $_POST = array();
                            }
                            
                        }
                        break;
                    case $switch == "deleteProduct":
    
                        
                        
                        $pricingID=$_POST["productID"];
                        $productID=$_POST["productID"];
                        $sqlParamPricing="pricingID="."\"".$pricingID."\"";
                        $sqlParamProduct="productID="."\"".$productID."\"";
                        
                        if(empty(\protec\model\Pricing::findOne($sqlParamPricing))){$deleteProductErrors="Keine gültige ID";}
                        else if(empty(\protec\model\Product::findOne($sqlParamProduct))){$deleteProductErrors="Keine gültige ID";}
                        else
                        {
                            $pricingToBeRemoved = \protec\model\Pricing::findOne($sqlParamPricing);
                            $productToBeRemoved = \protec\model\Product::findOne($sqlParamProduct);
    
    
                            $pricingToBeRemoved->delete($deleteProductErrors);
                            $productToBeRemoved->delete($deleteProductErrors);
                        }
                        break;
                }
                
            }
            
        }
        
        
        $this->setParam('addProductErrors', $addProductErrors);
        $this->setParam('changeProductErrors', $changeProductErrors);
        $this->setParam('deleteProductErrors', $deleteProductErrors);
    
        $title = 'Admin@ProTec > Produktverwaltung';
        $this->setParam('title', $title);
    }
    
    
}