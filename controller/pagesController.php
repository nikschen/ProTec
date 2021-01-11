<?php

//namespace protec\core;

class PagesController extends \protec\core\Controller
{

	public function actionIndex()
	{
		$myValue = 'This is the Index page. If Martin did it right, you won\'t see me in the final version.';
		$info='This is the Homepage. There will be a lot of fun to buy. Stay tuned.';
		print_r("actionIndex started...");
		$this->setParam('myValue',$myValue,);
		$this->setParam('This is the Homepage. There will be a lot of fun to buy. Stay tuned.',$info);
	}

	public function actionLogin()
	{
		if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false)
		{
			if(isset($_POST['submit']))
			{
				$email    = $_POST['email'] ?? null;
				$password = $_POST['password'] ?? null;

				if($email === 'user' && $password === '12345678')
				{
					$_SESSION['loggedIn'] = true;
					header('Location: index.php');
				}
				else
				{
					$_SESSION['loggedIn'] = false;
				}
			}
		}
		else
		{
			header('Location: index.php');
		}
	}

	public function actionLogout()
	{
		if($_SESSION['loggedIn'] === true)
		{
			$_SESSION['loggedIn'] = false;
		}

		header('Location: index.php');
		exit();
	}


	public function actionProfile()
	{
		if($_SESSION['loggedIn'] === true)
		{

		}
		else
		{
			header('Location: index.php');
		}
	}

	public function actionPaymentAndShippingDetails()
	{
		
	}

	


}