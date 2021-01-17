<?php


class PagesController extends \protec\core\Controller
{
	

	public function actionIndex()
	{
		$info='This is the Homepage. There will be a lot of fun to buy. Stay tuned.';
        $title='ProTec > Home';

        $this->setParam('title', $title);
		$this->setParam('info', $info);
	}

	public function actionLogin()
	{
		$title='ProTec > Login';
        $this->setParam('title', $title);
        
      
	    if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false)
		{
			if(isset($_POST['submit']))
			{
				$email    = $_POST['email'] ?? null;
                $password = $_POST['password'] ?? null;

                $errors['loginstatus'] = "LoginStatus = ".$_SESSION['loggedIn'];
                $errors['hashwert'] = "hash aus Pw generiert: " . password_hash($_POST['password'], PASSWORD_DEFAULT);
                
                
                //Debug
                $errors['email'] = "Email: " . $email;
                $errors['Password'] = "PW: " . $password;
                

                //Gibt es den Nutzer und ist das PW korrekt?
                //1. Prüfen ob Nutzer vorhanden    check
                //2. Herausbekommen der ID des Nutzers, wenn vorhanden
                //3. Mit ID nach Account suchen
                //4. Account Password mit Eingabe überprüfen
                $db = $GLOBALS['db'];

                $login = \protec\model\Customer::findOne('eMail = '.$db->quote($email));
                $loginID = $login->customerID;
                $errors['ID'] = "Customer-ID = " . $loginID;
                $errors['lastName'] = "Nachname des Nutzers = " . $login->lastName;
                
                if($login !== null)
                {
                    $errors['login'] = "E-Mail in Datenbank vorhanden";
                    $account= \protec\model\Account::findOne('accountID = ' . $loginID);
                    $PWHash = $account->passwordHash;
                    $errors['hash'] = "Hash des Nutzers: " . $PWHash; //Testanmeldung: Bigtommycool@web.de PW: geheimespasswort
                    if (password_verify($password , $PWHash))
                    {
                        $errors['Passwortüberprüfung'] = "Passwortstatus: korrekt";
                        $_SESSION['loggedIn']= true;
                        //header('Location: index.php');
                    }
                    else
                    {
                        $errors['Passwortüberprüfung'] = "Passwortstatus: nicht korrekt";
                        $_SESSION['loggedIn']= false;
                    }
                }
                else
                {
                    $errors['login'] = 'EMail existiert nicht! in Datenbank';
                }
                
                

			
			}
        }
        
       
        
        $this->setParam('errors', $errors);
		/*else WIEDER LESBAR MACHEN WENN TEST RICHTIG FUNKTionieren-----------------------------
		{
			header('Location: index.php');
		}*/
	}

	public function actionLogout()
	{
        $title='ProTec > Logout';
        $this->setParam('title', $title);
	    if($_SESSION['loggedIn'] === true)
		{
			$_SESSION['loggedIn'] = false;
		}

		header('Location: index.php?c=pages&a=login');
		
	}


	public function actionProfile()
	{
        $title='ProTec > Ihr Profil';
        $this->setParam('title', $title);
	    if($_SESSION['loggedIn'] === true)
		{

		}
		else
		{
			header('Location: index.php');
		}
	}


	public function actionCategoryRaspi()
    {
        $title='ProTec > RaspberryPi';
        $this->setParam('title', $title);
	}
	public function actionCategoryElectronic()
    {
        $title='ProTec > Elektronik';
        $this->setParam('title', $title);
	}
	public function actionCategoryComputer()
    {
        $title='ProTec > Computer';
        $this->setParam('title', $title);
	}
	public function actionCategoryNew()
    {
        $title='ProTec > Computer';
        $this->setParam('title', $title);
	}
	public function actionCategorySensors()
    {
        $title='ProTec > Computer';
        $this->setParam('title', $title);
    }
    public function actionSubcategory()
    {
        $category = $_GET['cat'];
        $subcategory = $_GET['subcat'];
        $prodIDs=[];
        $prodNames=[];
        $categoryToBeSearchedFor='category='.'"'.$category.'"';

        $products=protec\model\Product::find($categoryToBeSearchedFor);

        foreach($products as $key=>$value)
        {
            $prodIDs[$key]=$value['productID'];
            $prodNames[$key]=$value['prodName'];
        }



        $title='ProTec > '.$subcategory.' > '.$category;
        $this->setParam('title', $title);
        $this->setParam('products', $products);
        $this->setParam('prodIDs', $prodIDs);
        $this->setParam('prodNames', $prodNames);
        $this->setParam('category', $category);
    }




}