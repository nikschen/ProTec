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
			/*$db = $GLOBALS['db'];
			$statement =  $db->prepare("INSERT INTO `CUSTOMER` (firstName, lastName, birthDate, eMail) VALUES (:firstName , :lastName , :birthDate, :eMail)");
			$statement->execute(array('firstName' => 'Holger', 'lastName' => 'Nachname', 'birthDate' => '1200-03-03', 'eMail' => 'mailing@gmx.de'));*/

		#prepare to save to DB
		$email = $_POST['email'] ?? null; //
		$password = $_POST['password'] ?? null;//
		$password_repeat = $_POST['password-repeat'] ?? null;
		$telefon= $_POST['fon'] ?? null;//
		$title = $_POST['title'] ?? null;//
		$firstName = $_POST['firstName'] ?? null;//
		$lastName = $_POST['lastName'] ?? null;// check warum ab Leerzeichen getrennt wird
		$birthDate = $_POST['birthDate'] ?? null;
		$salutation = $_POST['Anrede'] ?? null; //

		$streetInfo= $_POST['streetInfo'] ?? null; //
		$streetNo= $_POST['streetNo'] ?? null;//
		$address2= $_POST['address2'] ?? null; //eventuell rauslassen (Mit Niklasius besprechen) 
		$zipcode= $_POST['zipcode'] ?? null;//
		$city= $_POST['city'] ?? null;//
		$country= $_POST['country'] ?? null;//

			///
		//$errors['testdate'] = date('Y-m-d', strtotime($birthDate));
		//



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
		if(mb_strlen($birthDate)<10 || mb_strlen($birthDate)>15 || !preg_match('/^\s*(3[01]|[12][0-9]|0?[1-9])\.(1[012]|0?[1-9])\.((?:19|20)\d{2})\s*$/',$birthDate))
		{
			$errors['birthDate'] = "Geburtsdatum fehlerhaft: Das ist kein gültiges Datumsformat. Bsp: 12. März 2020 = 12.03.2020";
			
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
			$db = $GLOBALS['db'];
			print_r($email);
			$emailFromDataBase = \protec\model\Customer::findOne('eMail = '.$db->quote($email) );
			
			
		

			
			if($emailFromDataBase !== null)
			{
				$errors['IsMailused'] = "Die Mailadresse kann nicht verwendet werden.";
			}
			else{
				/*$NewUser = new \protec\model\Customer(['eMail' => $email , 'firstName' => $firstName, 'lastName' => $lastName, 'birthDate' => date('Y-m-d', strtotime($birthDate))]);
				$NewAddress = new \protec\model\Address(['street' => $streetInfo , 'streetNumber' => $streetNo, 'zipCode' => $zipcode, 'city' => $city, 'additionalInformation' => $address2,'phone' => $telefon]);
				$NewAccount = new \protec\model\Account(['username' => $email , 'passwordHash' => password_hash($password, PASSWORD_DEFAULT)]);
				$NewUser->insert();
				$NewAddress->insert();
				$NewAccount->insert();*/
			}
			
		
		
		$this->setParam('errors', $errors);


				
				










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