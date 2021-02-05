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
                            if($key=="submit") {} //submit braucht nicht in values array
                            else {$values[$key]=$value;}
                        }
                        array_pop($values);

                        $newProduct=new \protec\model\Product($values);
                        $newPricing=new \protec\model\Pricing($values);

                        $productErrors=array();
                        $pricingErrors=array();

                        $newProduct->validate($productErrors);
                        $newPricing->validate($pricingErrors);

                        if(empty($productErrors) && empty($pricingErrors))
                        {
                            $newProduct->insert();
                            $newPricing->insert();

                        }
                        else
                        {
                            if(!empty($productErrors)) {$errors[]="Produktdaten sind ungültig";}
                            if(!empty($pricingErrors)) {$errors[]="Preisdaten sind ungültig";}
                        }
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