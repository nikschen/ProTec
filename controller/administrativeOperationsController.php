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
        $errors = [];
        $db = $GLOBALS["db"];
        $categories = getAllCategories();
        $this->setParam('categories', $categories);
        
        if (isset($_POST["password"]) && isset($_POST["submit"])) {
            $admin = \protec\model\Account::findOne("username=\"admin@protec.de\"");
            $pwdHash = $admin->passwordHash;
            
            if (password_verify($_POST["password"], $pwdHash)) {
                echo $_POST["submit"];
                
                switch ($switch = $_POST["submit"]) {
                    case $switch == "addProduct":
                        
                        if (!isset($_POST["category"])) {
                            $errors[] = "Keine Kategorie angegeben";
                        }
                        else {
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
                            validateUploadedProductImage($errors);
                            
                            
                            if (empty($productErrors) && empty($pricingErrors) && empty($errors)) {
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
                                    $errors[] = "Produktdaten sind ungültig";
                                }
                                if (!empty($pricingErrors)) {
                                    $errors[] = "Preisdaten sind ungültig";
                                }
                            }
                        }
                        break;
                    case $switch == "changeProduct":
                        foreach ($_POST as $key => $value) {
                            if ($key != "submit" && isset($key)) //submit braucht nicht in values array
                            {
                                if ($key=="currency" && empty($_POST["amount"]) || $key=="productID" || $key=="password" || $value=="") //currency wird nicht übernommen, wenn sich der Preis nicht ändert
                                {
                                    continue;
                                }
                                else if ($key=="currency" && !empty($_POST["amount"]) || $key=="amount")
                                {
                                    $pricingValues[] = "$key=\"$value\"";
                                }
                                else
                                {
                                    $productValues[] = "$key=\"$value\"";
                                }
                            }
                        }
                        $sqlParamProduct = "productID="."\"".$_POST["productID"]."\"";
                        $sqlParamPricing = "pricingID="."\"".$_POST["productID"]."\"";
                        $toBeChangedProduct = \protec\model\Product::findOne($sqlParamProduct);
                        $toBeChangedPricing= \protec\model\Pricing::findOne($sqlParamPricing);
                        
                        if(!empty($productValues)){$toBeChangedProduct->update($productValues, $toBeChangedProduct->productID);}
                        if(!empty($pricingValues)){$toBeChangedPricing->update($pricingValues, $toBeChangedPricing->pricingID);}
                        
                        break;
                    case $switch == "deleteProduct":
                        $pricingID=$_POST["productID"];
                        $productID=$_POST["productID"];
                        $sqlParamPricing="pricingID="."\"".$pricingID."\"";
                        $sqlParamProduct="productID="."\"".$productID."\"";
                        $pricingToBeRemoved=\protec\model\Pricing::findOne($sqlParamPricing);
                        $productToBeRemoved=\protec\model\Product::findOne($sqlParamProduct);
                        $pricingToBeRemoved->delete($errors);
                        $productToBeRemoved->delete($errors);
                        break;
                }
                
            }
            
        }
        
        
        $this->setParam('errors', $errors);
        $title = 'Admin@ProTec > Produktverwaltung';
        $this->setParam('title', $title);
    }
    
    
}