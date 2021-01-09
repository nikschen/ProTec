<?php
namespace protec\controller;

class ErrorsController extends \protec\core\Controller
{
    public function actionError404()
	{
		print_r("actionError404 aufgerufen");

		$errorMessage ="Check code, this error is unknown to me!";

		if(isset($_GET['error']))
		{
			switch($_GET['error'])
			{
				case 'nocontroller':
					$errorMessage = 'no controller found!';
				break; 


			}

		}
		//exit(1);
		//header('Location: views/errors/error404.php');
		//$this->setParam('errrorMessage',$errorMessage);
	}
}



?>