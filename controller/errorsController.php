<?php


class ErrorsController extends \protec\core\Controller
{
    public function actionError404()
	{
		header('Location: error404.php');
	}
}