<?php


class AccountsController extends \protec\core\Controller
{
    public function actionLogin()
	{
	
	}

	public function actionLogout()
	{
		
	}

	public function actionSignup() 
	{

		$errors = [];

		if(isset($_POST['submit']))
		{
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";

		$firstName= $_POST['firstName'];
		echo $firstName;

		if(mb_strlen($firstName)<2)
		{
			echo "<br>";
			echo "Name ist zu kurz";
			$errors['firstName'] = "Vorname zu kurz";
		}

		}
		//$this->setParams('errors', $errors); //weiß leider nicht, warum ich dem keinen setParams übergeben kann
	}
}