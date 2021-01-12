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
		$success = false;

		if(isset($_POST['submit']))
		{
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";

		#prepare to save to DB
		$email = $_POST['email'] ?? null; //
		$password = $_POST['password'] ?? null;//
		$telefon= $_POST['fon'] ?? null;//
		$title = $_POST['title'] ?? null;//
		$firstName = $_POST['firstName'] ?? null;//
		$lastName = $_POST['lastName'] ?? null;// check warum ab Leerzeichen getrennt wird
		$salutation = $_POST['Anrede'] ?? null; //

		$streetInfo= $_POST['streetInfo'] ?? null; //
		$streetNo= $_POST['streetNo'] ?? null;//
		$address2= $_POST['address2'] ?? null; //eventuell rauslassen (Mit Niklasius besprechen) 
		$zipcode= $_POST['zipcode'] ?? null;//
		$city= $_POST['city'] ?? null;//
		$country= $_POST['country'] ?? null;//


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
			echo "Name entspricht nicht den Anforderungen -> min. 2 max. 100 Zeichen, keine Zahlen oder Sonderzeichen";
			$errors['lastName'] = "Vorname zu kurz";
		}
		if(mb_strlen($title)>0 && mb_strlen($title)<2)
		{
			echo "<br>";
			echo "Titel ist zu kurz";
			$errors['title'] = "Vorname zu kurz";
		}
		if(mb_strlen($password)<8 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&_-]{8,}$/',$password))
		{
			echo "<br>";
			echo "Password unzureichend. Anforderungen: min. 8 Zeichen, min. 1 Klein- und Großbuchstaben, min. 1 Sonderzeichen (@$!%*?&_-)";
			$errors['password'] = "Vorname zu kurz";
		}
		if(mb_strlen($email)<4 || !filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			echo "<br>";
			echo "Email entspricht nicht den Vorgaben";
			$errors['email'] = "Vorname zu kurz";
		}
		if( !is_numeric($telefon))
		{
			echo "<br>";
			echo "Bitte geben Sie Ihre Telefonnummer ohne Sonderzeichen/Leerzeichen an";
		}

		if(mb_strlen($streetInfo)<2 || mb_strlen($streetInfo)>255 )
		{
			echo "<br>";
			echo "Straßenangabe entspricht nicht den Anforderungen min. 2 max. 255 Zeichen";
			$errors['streetInfo'] = "Hausnummerfehler";
		}

		if(mb_strlen($streetNo)<1 || mb_strlen($streetNo)>10 )
		{
			echo "<br>";
			echo "Hausnummereingabe entspricht nicht den Anforderungen min. 1 max. 10 Zeichen";
			$errors['streetNo'] = "Hausnummerfehler";
		}
		if(mb_strlen($zipcode)<3 || mb_strlen($zipcode)>12 )
		{
			echo "<br>";
			echo "PLZ entspricht nicht den Anforderungen min. 3 max. 12 Zeichen";
			$errors['zipcode'] = "PLZ FEHLER";
		}
		if(mb_strlen($city)<2 || mb_strlen($city)>60 )
		{
			echo "<br>";
			echo "Stadt entspricht nicht den Anforderungen min. 2 max. 60 Zeichen";
			$errors['city'] = "Stadteingabe falsch";
		}
		if(mb_strlen($country)<2 || mb_strlen($country)>60 )
		{
			echo "<br>";
			echo "Land entspricht nicht den Anforderungen min. 2 max. 60 Zeichen";
			$errors['country'] = "Landeingabe fehlerhaft";
		}
		if(count($errors)===0)
		{
		if(true) // hier kommt dann später die Frage, ob es keinen Fehler gab, wenn ja, dann Datenbank-Eintrag erstellen.
		{
			$success = true;
			//header('Location: index.php?c=pages&a=login');
			//exit(0);
			$this->setParam('true', $success);
		}

		}
		}
		//$this->setParams('errors', $errors); //weiß leider nicht, warum ich dem keinen setParams übergeben kann
	}
}