<?php


/**
 * Class InfopagesController
 * Provides the logic for the infopages
 */
class InfopagesController extends \protec\core\Controller
{
    /**
     * Only provides page title because of the absence of dynamic elements
     */
    public function actionPaymentAndShippingDetails()
    {
        $title='ProTec > Versand- und Zahlungsbedingungen';
        $this->setParam('title', $title);
    }

    /**
     * Only provides page title because of the absence of dynamic elements
     */
    public function actionRightOfWithdrawal()
    {
        $title='ProTec > Widerrufsrecht';
        $this->setParam('title', $title);
    }

    /**
     * Only provides page title because of the absence of dynamic elements
     */
    public function actionPrivacyGuidelines()
    {
        $title='ProTec > Datenschutz';
        $this->setParam('title', $title);
    }

    /**
     * Only provides page title because of the absence of dynamic elements
     */
    public function actionAgb()
    {
        $title='ProTec > AGB';
        $this->setParam('title', $title);
    }

    /**
     * Only provides page title because of the absence of dynamic elements
     */
    public function actionImpressum()
    {
        $title='ProTec > Impressum';
        $this->setParam('title', $title);
    }


    /**
     * Only provides page title because of the absence of dynamic elements
     */
    public function actionJobs()
    {
        $title='ProTec > Jobs';
        $this->setParam('title', $title);
    }
}