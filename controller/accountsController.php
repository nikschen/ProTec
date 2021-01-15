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
		$title='ProTec > SignUp';
		$this->setParam('title', $title);
		$errors = [];
		$success = false;

	

		if(isset($_POST['submit']))
		{

		#prepare to save to DB
		$email = $_POST['email'] ?? null; //
		$password = $_POST['password'] ?? null;//
		$password_repeat = $_POST['password-repeat'] ?? null;
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
			$errors['firstName'] = "Vorname entspricht nicht den Anforderungen -> mind. 2 max. 46 Zeichen,  keine Zahlen oder Sonderzeiche";
		}
		if(mb_strlen($lastName)<2 || mb_strlen($firstName)>100 ||preg_match('/[0-9]/',$lastName))
		{
			$errors['lastName'] = "Name entspricht nicht den Anforderungen -> min. 2 max. 100 Zeichen, keine Zahlen oder Sonderzeichen";
		}
		if(mb_strlen($title)>0 && mb_strlen($title)<2)
		{
			$errors['title'] = "Titel zu kurz";
		}
		if(mb_strlen($password)<8 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&_-]{8,}$/',$password))
		{
			$errors['password'] = "Password unzureichend. Anforderungen: min. 8 Zeichen, min. 1 Klein- und Großbuchstaben, min. 1 Sonderzeichen (@$!%*?&_-)";
		}
		if($password !== $password_repeat)
		{
			$errors['password-ident'] = "Die Passworteingaben sind leider nicht identisch!";
		}

		if(mb_strlen($email)<4 || !filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$errors['email'] = "Email entspricht nicht den Vorgaben";
		}

		if( !is_numeric($telefon))
		{
			$errors['fon'] = "Bitte geben Sie Ihre Telefonnummer ohne Sonderzeichen/Leerzeichen an";
		}

		if(mb_strlen($streetInfo)<2 || mb_strlen($streetInfo)>255 )
		{
			$errors['streetInfo'] = "Straßenangabe entspricht nicht den Anforderungen min. 2 max. 255 Zeichen";
		}

		if(mb_strlen($streetNo)<1 || mb_strlen($streetNo)>10 )
		{
			$errors['streetNo'] = "Hausnummereingabe entspricht nicht den Anforderungen min. 1 max. 10 Zeichen";
		}
		if(mb_strlen($zipcode)<3 || mb_strlen($zipcode)>12 )
		{
			$errors['zipcode'] = "PLZ entspricht nicht den Anforderungen min. 3 max. 12 Zeichen";
		}
		if(mb_strlen($city)<2 || mb_strlen($city)>60 )
		{
			$errors['city'] = "Stadt entspricht nicht den Anforderungen min. 2 max. 60 Zeichen";
		}
		
		if(mb_strlen($country)<2 || mb_strlen($country)>60 )
		{
			$errors['country'] = "Land entspricht nicht den Anforderungen min. 2 max. 60 Zeichen";
			
		}


		$this->setParam('errors', $errors);
		
		


		if(count($errors)===0)
		{
			//wenn keine Fehler sind dann prüfen ob in Datenbank nicht schon was vorhanden ist.
			





		if(true) // hier kommt dann später die Frage, ob es keinen Fehler gab, wenn ja, dann Datenbank-Eintrag erstellen.
		{
			$success = true;
			$this->setParam('success', $success);
			
			
		}

		}
		}
		$this->setParam('success', $success);
	}
}