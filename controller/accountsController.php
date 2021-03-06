<?php


/**
 * Class AccountsController
 * Provides all logics around login, logout, signup and the user profile
 */
class AccountsController extends \protec\core\Controller
{
    /**
     *  Checks for input of email and password for login as well as the rememberMe checkbox to let users stay signed in
     * provides error if email or password is wrong
     */
    public function actionLogin()
    {
        $title='ProTec > Login';
        $this->setParam('title', $title);
        $success = false;
        $errors = [];

        if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false)
        {
            //empty POST und dann alles aus dem Cookie reinknallen in anmeldung und bäm angemeldet
            if(isset($_POST['submit']))
            {
                $email    = $_POST['email'] ?? null;
                $password = $_POST['password'] ?? null;
                $rememberMe = $_POST['Remember'] ?? null;

                //check in database if email is known
                $db = $GLOBALS['db'];
                $login = \protec\model\Customer::findOne('eMail = '.$db->quote($email));

                //if there is a user found with that mail, start to check whether the pw is correct
                if($login !== null)
                {

                    //get specific Info on user for showing that he is logged in as
                    $loginID = $login->customerID;

                    $account= \protec\model\Account::findOne('accountID = ' . $loginID);
                    $PWHash = $account->passwordHash;

                    if (password_verify($password , $PWHash))
                    {
                        $loginFirstName= $login->firstName;
                        $loginLastName= $login->lastName;

                        $_SESSION['loggedIn']= true;
                        $_SESSION['username'] = $loginFirstName ." ". $loginLastName;
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = encryptPassword($password);

                        //if rememberMe was set, than start to set the cookies with the function rememberMe
                        if($rememberMe=="on")
                        {
                            $this->rememberMe($email, $password);
                        }
                        $success = true;
                        header("refresh:5;url=index.php");
                    }
                    else
                    {
                        $errors['checkMailAndPassword'] = "Die E-Mail Adresse oder das Passwort ist nicht korrekt!";
                    }
                }
                else
                {
                    $errors['checkMailAndPassword'] = "Die E-Mail Adresse oder das Passwort ist nicht korrekt!";
                }

                $this->setParam('errors', $errors);
                $this->setParam('success', $success);

            }
        }
    }

    /**
     * logs the user out by destroying the session and invalidate the cookie
     * forwards to the homepage
     */
    public function actionLogout()
    {
        $title='ProTec > Logout';
        $this->setParam('title', $title);
        if($_SESSION['loggedIn'] === true)
        {
            $_SESSION['loggedIn'] = false;
        }
        setcookie('email','',-1,'/');
        setcookie('password','',-1,'/');
        unset($_SESSION['username']);
        session_destroy();
        header('Location: index.php?c=pages&a=index');
    }

    /**
     * checks for input of form data to change a users personal data or password
     * provides errors for wrong or malformed data or wrong password conditions
     */

	public function actionProfile()
	{
		
		$title='ProTec > Profile';
		$this->setParam('title', $title);
		$errors = [];
		$success = false;

		if(isset($_POST['submit']))
		{
		//get all post-variables to local-variables for easier reading later on
		$email = $_POST['email'] ?? null; //
		$password = $_POST['password'] ?? null;//
		$password_repeat = $_POST['password-repeat'] ?? null;
		$telefon= $_POST['phone'] ?? null;//
		$firstName = $_POST['firstName'] ?? null;//
		$lastName = $_POST['lastName'] ?? null;// 
		$birthDate = $_POST['birthDate'] ?? null;
		$salutation = $_POST['Anrede'] ?? null; //

		$streetInfo= $_POST['streetInfo'] ?? null; //
		$streetNo= $_POST['streetNo'] ?? null;//
		$address2= $_POST['address2'] ?? null; //
		$zipcode= $_POST['zipcode'] ?? null;//
		$city= $_POST['city'] ?? null;//
		$country= $_POST['country'] ?? null;//

		//php checking the user input and creating errors-array if errors occured
		if(mb_strlen($firstName)<2 || mb_strlen($firstName)>46 || preg_match('/[0-9]/',$firstName))
		{
			$errors['firstName'] = "Vorname entspricht nicht den Anforderungen -> mind. 2 max. 46 Zeichen,  keine Zahlen oder Sonderzeichen";
		}
		if(mb_strlen($lastName)<2 || mb_strlen($firstName)>100 ||preg_match('/[0-9]/',$lastName))
		{
			$errors['lastName'] = "Name entspricht nicht den Anforderungen -> min. 2 max. 100 Zeichen, keine Zahlen oder Sonderzeichen";
		}
		if(mb_strlen($birthDate)<10 || mb_strlen($birthDate)>15 || !preg_match('/^\s*(3[01]|[12][0-9]|0?[1-9])\.(1[012]|0?[1-9])\.((?:19|20)\d{2})\s*$/',$birthDate))
		{
			$errors['birthDate'] = "Geburtsdatum fehlerhaft: Das ist kein gültiges Datumsformat. Bsp: 12. März 2020 = 12.03.2020";
		}
		if(isset($_POST['passwordOld']) && $_POST['passwordOld']!== "" )
		{
			if(mb_strlen($password)<8 || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&_-])[A-Za-z\d@$!%*?&_-]{8,}$/',$password))
			{
				$errors['password'] = "Password unzureichend. Anforderungen: min. 8 Zeichen, min. 1 Klein- und Großbuchstaben und Zahl, min. 1 Sonderzeichen (@$!%*?&_-)";
			}
	
			if($password !== $password_repeat)
			{
				$errors['password-ident'] = "Die Passworteingaben sind leider nicht identisch!";
			}
			//Checking ig the used Password is correct before doing any further in the DB
			$passwordOld = $_POST['passwordOld'];
			$UserID = getUserInformation($_SESSION['email']);
			$account= \protec\model\Account::findOne('accountID = ' . $UserID[0]['customerID']);
			$PWHash = $account->passwordHash;
			if (!password_verify($passwordOld , $PWHash))
			{
				$errors['passwordOld'] = "Ihr altes PW ist nicht korrekt, PW wurde nicht geändert!";
			}
		}
		if(mb_strlen($email)<4 || !filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			$errors['email'] = "Email entspricht nicht den Vorgaben";
		}
		if($telefon!=="")
		{
			if(!is_numeric($telefon))
			{
				$errors['fon'] = "Bitte geben Sie Ihre Telefonnummer ohne Sonderzeichen/Leerzeichen an";
			}
		}
		else
		{
			$telefon = null;
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
		if($address2!=="")
		{
			if(mb_strlen($address2)<2 || mb_strlen($address2)>60 )
			{
				$errors['additionalInfo'] = "Adresszusatz entspricht nicht den Anforderungen min. 2 max. 60 Zeichen";
			}
		}
		else
		{
			$address2 = null;
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
		
		

		//If there are no errors for all inputs the changes will be made
		if(count($errors)===0)
		{
			$db = $GLOBALS['db'];
			$customerTable = getUserInformation($_SESSION['email']);
		
			//SETUP ADDRESS ARRAY ->used to seperate the data from the other unnecessary data
			$addressArray['street'] = $streetInfo;
			$addressArray['streetNumber'] = $streetNo;
			$addressArray['city'] = $city;
			$addressArray['country'] = $country;
			$addressArray['additionalInformation'] = $address2;
			$addressArray['zipCode'] = $zipcode;
			$addressArray['phone'] = $telefon;

			//Build the WHERE-String for the SQL Statement to use in the findOne-method->this is used to search for the exact address given by user
			$searchString = "";
    		$connectionString = " AND ";

			foreach ($addressArray as $element => $value)
    		{
				if($value!="")
				{
					$searchString .= $element ." = " . "\"".$value."\"" . $connectionString ;
				}
    		}
			$searchStringTrimmed=  rtrim($searchString,$connectionString);
    		$allAddress = \protec\model\Address::findOne($searchStringTrimmed);
			
			//set AdressID from Database to Customer if Address already existing, else: insert the data inside the database, and give the created ID to the User
			if($allAddress !== null)
			{
				$connectedId = $allAddress->addressID;
			}
			else
			{
			$NewAddress = new \protec\model\Address(['addressID' => '', 'street' => $streetInfo , 'streetNumber' => $streetNo, 'zipCode' => $zipcode, 'city' => $city, 'additionalInformation' => $address2,'phone' => $telefon, 'country' => $country]);
			$NewAddress->insert();
			$connectedId = $db->lastInsertId();
			}

			//updates Customer
			$ToBeChangedAtCustomer = ["firstName= " . "\"" . $firstName . "\"" ,"lastName= " ."\"". $lastName ."\"", 'birthDate = '. "\"" . date('Y-m-d' , strtotime($birthDate)) . "\"", "addressID = " .$connectedId, "eMail = " ."\"" . "$email" . "\""]; //quotation needed
			$CustomerFromDataBase = \protec\model\Customer::findOne('eMail = '. "\"" . $_SESSION['email'] . "\"" );
			$CustomerFromDataBase->update($ToBeChangedAtCustomer, $customerTable[0]['customerID']);

			//updates Account
			$ToBeChangedAtAccount = ["username= " . "\"" . $email . "\""];
			$AccountFromDataBase = \protec\model\Account::findOne('username = '. "\"" . $_SESSION['email'] . "\"" );
			$AccountFromDataBase->update($ToBeChangedAtAccount, $customerTable[0]['customerID']);
			
			//updates Account Passwort
			if($_POST['passwordOld']!== "" )
			{
				$account= \protec\model\Account::findOne('accountID = ' . $CustomerFromDataBase->customerID);
				$toBeChangeAtAccountPW = ["passwordHash= " . "\"" . password_hash($password, PASSWORD_DEFAULT) . "\""];
				$AccountFromDataBase->update($toBeChangeAtAccountPW, $customerTable[0]['customerID']);
			
				$_SESSION['password'] = encryptPassword($password);
				
				//if there is a cookie stored then the password must be stored within the cookie (encrypted)
				if(isset($_COOKIE['password']))
				{
					setcookie('email','',-1,'/');
					setcookie('password','',-1,'/');
					$this->rememberMe($email, $password);
				}
			}
			//ResetSession with new Mail (in that spot here everything went fine, so there is no danger to set the Session)
			$_SESSION['email'] = $_POST['email'] ?? null;
			$success=true;
			$this->setParam('success', $success);
		}

	
		}

	}

    /**
     * checks for input form data to create a customer and the corresponding account for it
     * provides errors for wrong, missing or malformed data and already used emails
     */
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
		$firstName = $_POST['firstName'] ?? null;//
		$lastName = $_POST['lastName'] ?? null;// 
		$birthDate = $_POST['birthDate'] ?? null;
		$salutation = $_POST['Anrede'] ?? null; //

		$streetInfo= $_POST['streetInfo'] ?? null; //
		$streetNo= $_POST['streetNo'] ?? null;//
		$address2= $_POST['address2'] ?? null; 
		$zipcode= $_POST['zipcode'] ?? null;//
		$city= $_POST['city'] ?? null;//
		$country= $_POST['country'] ?? null;//
		
		
		
	
		//Überprüfung der Eingaben in den SignUp Forms wird per JS geprüft (zusätzlich!!! da es ja auch ohne gehen soll)
		//null Prüfung entfällt da required gesetzt wird im html form

		if(mb_strlen($firstName)<2 || mb_strlen($firstName)>46 || preg_match('/[0-9]/',$firstName))
		{
			$errors['firstName'] = "Vorname entspricht nicht den Anforderungen -> mind. 2 max. 46 Zeichen,  keine Zahlen oder Sonderzeichen";
		}
	
		if(mb_strlen($lastName)<2 || mb_strlen($firstName)>100 ||preg_match('/[0-9]/',$lastName))
		{
			$errors['lastName'] = "Name entspricht nicht den Anforderungen -> min. 2 max. 100 Zeichen, keine Zahlen oder Sonderzeichen";
		}
	
		if(mb_strlen($birthDate)<10 || mb_strlen($birthDate)>15 || !preg_match('/^\s*(3[01]|[12][0-9]|0?[1-9])\.(1[012]|0?[1-9])\.((?:19|20)\d{2})\s*$/',$birthDate))
		{
			$errors['birthDate'] = "Geburtsdatum fehlerhaft: Das ist kein gültiges Datumsformat. Bsp: 12. März 2020 = 12.03.2020";
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

		if($telefon!=="")
		{
			if(!is_numeric($telefon))
			{
			$errors['fon'] = "Bitte geben Sie Ihre Telefonnummer ohne Sonderzeichen/Leerzeichen an";
			}
		}
		if($telefon=="")
		{
			$telefon = null;
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
		if($address2!=="")
		{
			if(mb_strlen($address2)<2 || mb_strlen($address2)>60 )
			{
				$errors['addtitionalInfo'] = "Adresszusatz entspricht nicht den Anforderungen min. 2 max. 60 Zeichen";
			}
		}
		else
		{
			$address2 = null;
		}
		$this->setParam('errors', $errors);
		
		


		if(count($errors)===0)
		{
			//if there are no errors with all the entries above, start to check if there is already a customer using that Mail-Address, if not proceed with database-entry.
			$db = $GLOBALS['db'];
			$emailFromDataBase = \protec\model\Customer::findOne('eMail = '.$db->quote($email) );

			//check if Mailaddress already taken if not go ahead adding user
			if($emailFromDataBase !== null)
			{
				$errors['IsMailused'] = "Die Mailadresse kann nicht verwendet werden.";
			}
			else
			{
				//If all UserInput has been verified, insert the address and get the ID of that insert, but if this address is already inside the database just get the id.
				//SETUP ADDRESS ARRAY
				$addressArray['street'] = $streetInfo;
				$addressArray['streetNumber'] = $streetNo;
				$addressArray['city'] = $city;
				$addressArray['country'] = $country;
				$addressArray['additionalInformation'] = $address2;
				$addressArray['zipCode'] = $zipcode;
				$addressArray['phone'] = $telefon ?? null;
			
				//Build the WHERE-String for the SQL Statement to use in the findOne-method
				$searchString = "";
    			$connectionString = " AND ";

				foreach ($addressArray as $element => $value)
    			{
					if($value!="")
					{
						$searchString .= $element ." = " . "\"".$value."\"" . $connectionString ;
					}
    			}
				$searchStringEnd =  rtrim($searchString,$connectionString);
    			$allAddress = \protec\model\Address::findOne($searchStringEnd);
			
				//set MailAdressID from Database if Address already existing, else: insert the data inside the database, and give the created ID to the New User
				if($allAddress !== null)
				{
					$connectedId = $allAddress->addressID;
				}
				else
				{
					$NewAddress = new \protec\model\Address(['addressID' => '', 'street' => $streetInfo , 'streetNumber' => $streetNo, 'zipCode' => $zipcode, 'city' => $city, 'additionalInformation' => $address2,'phone' => $telefon, 'country' => $country]);
					$NewAddress->insert();
					$connectedId = $db->lastInsertId();
				}

				//Use the ID of the Address Insert to connect it to the NewUser, so we know now where he lives
				$NewUser = new \protec\model\Customer(['addressID' => $connectedId, 'eMail' => $email , 'firstName' => $firstName, 'lastName' => $lastName, 'birthDate' => date('Y-m-d', strtotime($birthDate))]);
				$NewUser->insert();

				//get new CustomerID From Database to set it for Account ID -> to connect the user to its account
				$givenCustomerID = protec\model\Customer::findOne('eMail = '.$db->quote($email));
				$newID = $givenCustomerID->customerID;
				$NewAccount = new \protec\model\Account(['accountID' => $newID, 'username' => $email , 'passwordHash' => password_hash($password, PASSWORD_DEFAULT)]);
				$NewAccount->insert();

				$success=true;
				$this->setParam('success', $success);
			}
			
			$this->setParam('errors', $errors);

			// if the creation and entry of the User is done successfully he will be redirected to the LoginPage:
			if($success) 
			{
				header( "refresh:2;url=index.php?c=accounts&a=login");
			}

			}
		}
		
	}
}