<?php


class PagesController extends \protec\core\Controller
{
	

	public function actionIndex()
	{

        $title='ProTec > Home';
        $this->setParam('title', $title);
	}

    public function actionSearch()
	{

        $title='ProTec > Searching';
        $this->setParam('title', $title);
        if(isset($_GET['searchString']) && $_GET['searchString'] !== "")
        {
        $searchString = $_GET['searchString'];
        $products = \protec\model\Product::find("prodName LIKE " . "\"%" . $searchString ."%\"");

        $categoriesInSearch=[];
        foreach($products as $element)
        {
           if(in_array($element->category,$categoriesInSearch)){}else{array_push($categoriesInSearch,$element->category);} 
        }
        //Debug START
        echo "<br><br><br><br><br><br>";
        echo "<pre style=color:white;>";
        print_r($categoriesInSearch);
        echo "</pre>";
        echo "<pre style=color:white;>";

        $isCategoryFilterSet=false;
        foreach($_GET as $key => $value) //added the counting of on
        {
            if ($value=="on")
            {
                print("Show: " . $key) . "<br>";
                $isCategoryFilterSet=true;
            }
        }
        echo "</pre>";
        //

        if($isCategoryFilterSet)
        {
            $resultArrayCategory=[];
            foreach($products as $element)
            {
                if(!empty($_GET[$element->category]))
                {
                    echo "<pre style=color:white;>";
                    echo "Should print this product: " . $element->prodName;
                    echo "</pre>";
                    array_push($resultArrayCategory,$element);
                }
            }
        }
        else
        {
            echo "<pre style=color:white;>";
            echo "CategoryFilter is not set";
            echo "</pre>";
        }






        $this->setParam('products', $products);
        if(!$isCategoryFilterSet)
        {
            $resultArrayCategory=$products;
        }
        $this->setParam('filteredProducts', $resultArrayCategory);
        }
        
        





        //echo $_POST['searchString'];
        
        

	}

	public function actionLogin()
	{
		$title='ProTec > Login';
        $this->setParam('title', $title);
        $success = false;

	    if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] === false)
		{
            //empty POST und dann alles aus dem Cookie reinknallen in anmeldung und bäm angemeldet
			if(isset($_POST['submit']))
			{
				$email    = $_POST['email'] ?? null;
                $password = $_POST['password'] ?? null;
                $rememberMe = $_POST['Remember'] ?? null;

                //Debug
                //$errors['loginstatus'] = "LoginStatus = ".$_SESSION['loggedIn'];
               // $errors['hashwert'] = "hash aus Pw generiert: " . password_hash($_POST['password'], PASSWORD_DEFAULT);
               // $errors['email'] = "Email: " . $email;
               // $errors['Password'] = "PW: " . $password;
               // $errors['rememberMe'] = "Status RememberME: " . $rememberMe;

                //check in database if email is known 
                $db = $GLOBALS['db'];
                $login = \protec\model\Customer::findOne('eMail = '.$db->quote($email));

                
                
                //if there is a user found with that mail, start to check whether the pw is correct
                if($login !== null)
                {
                    //$errors['login'] = "E-Mail in Datenbank vorhanden";
                    //get specific Info on user for showing that he is logged in as
                    $loginID = $login->customerID;

                    $account= \protec\model\Account::findOne('accountID = ' . $loginID);
                    $PWHash = $account->passwordHash;
                    //$errors['hash'] = "Hash des Nutzers: " . $PWHash; //Testanmeldung: Bigtommycool@web.de PW: geheimespasswort
                    //compare given password with the stored in database
                    if (password_verify($password , $PWHash))
                    {
                        $loginFirstName= $login->firstName;
                        $loginLastName= $login->lastName;
                        //Debug Elements
                        //$errors['ID'] = "Customer-ID = " . $loginID;
                        //$errors['lastName'] = "Nachname des Nutzers = " . $login->lastName;
                        //$errors['Passwortüberprüfung'] = "Passwortstatus: korrekt";
                        //Set the login Status as true for the session, save the mail and the encrypted PW for later use within the Session
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
                     //header('Location: index.php');
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
        setcookie('email','',-1,'/');
        setcookie('password','',-1,'/');
        unset($_SESSION['username']);
        session_destroy();
		header('Location: index.php?c=pages&a=index');
	}


	public function actionProfile() //liegt nun unter Accounts evtl. hier nicht mehr nötig
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
        $categoryToBeSearchedFor='category='.'"'.$category.'"';

        $products=protec\model\Product::find($categoryToBeSearchedFor);

        $title='ProTec > '.$subcategory.' > '.$category;
        $this->setParam('title', $title);
        $this->setParam('products', $products);
        $this->setParam('category', $category);
    }






}