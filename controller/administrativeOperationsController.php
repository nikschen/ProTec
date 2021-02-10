<?php


class AdministrativeOperationsController extends \protec\core\Controller
{
    public function actionChooseOperation()
    {
        $title='Admin@ProTec';
        $this->setParam('title', $title);
    }

    public function actionManageCustomers()
	{
        $title='Admin@ProTec > Kundenverwaltung';
        $this->setParam('title', $title);
	}
    public function actionManageProducts()
    {
        $errors=[];
        $db=$GLOBALS["db"];
        $categories=getAllCategories();
        $this->setParam('categories', $categories);

        if(isset($_POST["password"]) && isset($_POST["submit"]))
        {
            $admin=\protec\model\Account::findOne("username=\"admin@protec.de\"");
            $pwdHash=$admin->passwordHash;

            if(password_verify($_POST["password"],$pwdHash))
            {

                switch($switch=$_POST["submit"])
                {
                    case $switch=="addProduct": //TODO: Bild Upload

                        foreach($_POST as $key => $value)
                        {
                            if($key!="submit") {$values[$key]=$value;} //submit braucht nicht in values array
                        }
                        array_pop($values);

                        $newProduct=new \protec\model\Product($values);
                        $newPricing=new \protec\model\Pricing($values);

                        $productErrors=array();
                        $pricingErrors=array();

//                        echo "<pre>";
//                        print_r($_FILES);
//                        echo "<pre>";
//                        exit(1);

                        $newProduct->validate($productErrors);
                        $newPricing->validate($pricingErrors);
                        validateUploadedProductImage($errors);


                        if(empty($productErrors) && empty($pricingErrors) && empty($errors))
                        {
                            $newProduct->insert();
                            $newPricing->insert();

                            $uploadFolder = IMAGESPATH; //Upload-Verzeichnis
                            $filename = $db->lastInsertId();
                            $extension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
                            $destinationPath = $uploadFolder.$filename.'.'.$extension;
                            move_uploaded_file($_FILES['file']['tmp_name'], $destinationPath);
                            $_POST = array();
                        }
                        else
                        {
                            if(!empty($productErrors)) {$errors[]="Produktdaten sind ungültig";}
                            if(!empty($pricingErrors)) {$errors[]="Preisdaten sind ungültig";}
                        }

//                        echo "<pre>";
//                        $_FILES("productImageUpload");
//                        echo "<pre>";
//                        exit(1);


                        break;
                    case $switch=="changeProduct":
                        break;
                    case $switch=="deleteProduct":
                        break;
                }

            }

        }



        $this->setParam('errors', $errors);
        $title='Admin@ProTec > Produktverwaltung';
        $this->setParam('title', $title);
    }


}