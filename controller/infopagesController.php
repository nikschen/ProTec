<?php


class InfopagesController extends \protec\core\Controller
{
    public function actionPaymentAndShippingDetails()
    {
        $title='ProTec > Versand- und Zahlungsbedingungen';
        $this->setParam('title', $title);
    }

    public function actionRightOfWithdrawal()
    {
        $title='ProTec > Widerrufsrecht';
        $this->setParam('title', $title);
    }
    public function actionPrivacyGuidelines()
    {
        $title='ProTec > Datenschutz';
        $this->setParam('title', $title);
    }
    public function actionAgb()
    {
        $title='ProTec > AGB';
        $this->setParam('title', $title);
    }
    public function actionImpressum()
    {
        $title='ProTec > Impressum';
        $this->setParam('title', $title);
    }


    public function actionJobs()
    {
        $title='ProTec > Jobs';
        $this->setParam('title', $title);
    }
}