<?php


/**
 * Class ErrorsController
 * Provides the logic for the error page
 */
class ErrorsController extends \protec\core\Controller
{
    /**
     * Only provides error page title because of the absence of dynamic elements
     */
    public function actionError404()
	{
        $title='ProTec > Error404';
        $this->setParam('title', $title);
	}
}


