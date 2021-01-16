<?php


class ServicepagesController extends \protec\core\Controller
{

    public function actionCustomerpromotion()
    {
        $title='ProTec > CustomerPromotion';
        $this->setParam('title', $title);
    }

    public function actionTrustpoints()
    {
        $title='ProTec > Treuepunkte';
        $this->setParam('title', $title);
    }

    public function actionBusinessdiscount()
    {
        $title='ProTec > Geschäftskundenrabatte';
        $this->setParam('title', $title);
    }
    public function actionNewsletter()
    {
        $title='ProTec > Newsletter';
        $this->setParam('title', $title);
    }
    public function actionContactForm()
    {
        $title='ProTec > Kontaktformular';
        $this->setParam('title', $title);
    }
}