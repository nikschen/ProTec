<?php


/**
 * Class ServicepagesController
 * provides logic for all servicepages
 */
class ServicepagesController extends \protec\core\Controller
{

    /**
     * Only provides the tab title because of the absence of dynamic elements
     */
    public function actionCustomerpromotion()
    {
        $title='ProTec > CustomerPromotion';
        $this->setParam('title', $title);
    }

    /**
     * Only provides the tab title because of the absence of dynamic elements
     */
    public function actionTrustpoints()
    {
        $title='ProTec > Treuepunkte';
        $this->setParam('title', $title);
    }

    /**
     * Only provides the tab title because of the absence of dynamic elements
     */
    public function actionBusinessdiscount()
    {
        $title='ProTec > Geschäftskundenrabatte';
        $this->setParam('title', $title);
    }

    /**
     * Only provides the tab title because of the absence of dynamic elements
     */
    public function actionNewsletter()
    {
        $title='ProTec > Newsletter';
        $this->setParam('title', $title);
    }

    /**
     * Only provides the tab title because of the absence of dynamic elements
     */
    public function actionContactForm()
    {
        $title='ProTec > Kontaktformular';
        $this->setParam('title', $title);
    }

    /**
     * Only provides the tab title because of the absence of dynamic elements
     */
    public function actionDocumentation()
    {
        $title='ProTec > Dokumentation';
        $this->setParam('title', $title);
    }
}