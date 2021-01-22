<?php


class ErrorsController extends \protec\core\Controller
{
    public function actionError404()
	{
        $title='ProTec > Error404';
        $this->setParam('title', $title);
	}
}


