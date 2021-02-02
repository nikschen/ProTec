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
        $categories=getAllCategories(); //braucht noch Pflege
        $title='Admin@ProTec > Produktverwaltung';
        $this->setParam('title', $title);
        $this->setParam('categories', $categories);
    }


}