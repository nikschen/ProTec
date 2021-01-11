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

		#prepare to save to DB
		$email = $_POST['email'] ?? null;
		$password = $_POST['password'] ?? null;
		$telefon= $_POST['fon'] ?? null;
		$title = $_POST['title'] ?? null;
		$firstName = $_POST['firstName'] ?? null;
		$lastName = $_POST['lastName'] ?? null;
		$salutation = $_POST['Anrede'] ?? null;


		//Überprüfung der Eingaben in den SignUp Forms wird per JS geprüft (zusätzlich!!! da es ja auch ohne gehen soll)
		//null Prüfung entfällt da required gesetzt wird im html form

		if(mb_strlen($firstName)<2 || mb_strlen($firstName)>46 || preg_match('/[0-9]/',$firstName))
		{
			echo "<br>";
			echo "Vorname entspricht nicht den Anforderungen -> mind. 2 max. 46 Zeichen,  keine Zahlen oder Sonderzeichen";
			$errors['firstName'] = "Vorname zu kurz";
		}
		if(mb_strlen($lastName)<2 || mb_strlen($firstName)>100 ||preg_match('/[0-9]/',$lastName))
		{
			echo "<br>";
			echo "Name entspricht nicht den Anforderungen -> mind. 2 max. 100 Zeichen, keine Zahlen oder Sonderzeichen";
			$errors['lastName'] = "Vorname zu kurz";
		}
		if(isset($_POST['title']) && mb_strlen($title)<2)
		{
			echo "<br>";
			echo "Titel ist zu kurz";
			$errors['title'] = "Vorname zu kurz";
		}
		if(mb_strlen($password)<8 )
		{
			echo "<br>";
			echo "Password unzureichend, ist zu kurz";
			$errors['password'] = "Vorname zu kurz";
		}
		if(mb_strlen($email)<4 || !filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			echo "<br>";
			echo "Email entspricht nicht den Vorgaben";
			$errors['email'] = "Vorname zu kurz";
		}

		}
		//$this->setParams('errors', $errors); //weiß leider nicht, warum ich dem keinen setParams übergeben kann
	}
}