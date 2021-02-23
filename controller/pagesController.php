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

        $isCategoryFilterSet=false;
        $isPriceFilterSet=false;
        

        $resultArrayPrice=[];
        $resultArrayCategory=[];
        $errorMessage=[];

        //checking if a Filter is set
        foreach($_GET as $key => $value) 
        {
            if ($value=="on")
            {
                $isCategoryFilterSet=true;
            }
            if ($key=="minPrice" || $key=="maxPrice")
            {
                if($value>0 || $value!="")
                {
                $isPriceFilterSet=true;
                }
            }
        }
       
        //do the filtering for the Category->if element is in category list on which the checkbox is "checked" will be added to the resultarray
        if($isCategoryFilterSet)
        {
            foreach($products as $element)
            {
                if(!empty($_GET[$element->category]))
                {
                    array_push($resultArrayCategory,$element);
                }
            }
        }
        else
        {
            $resultArrayCategory=$products;
        }
        //if there is a entry in one of the price max or min field this is set true and the list will be filtered by the price entries
        if($isPriceFilterSet)
        {   
                 //Replace german "," by internatinal "." to make number-check, make numbers according to german system
                 $replaceMaxSeperator = str_replace(",",".",htmlspecialchars($_GET['maxPrice']));
                 $replaceMinSeperator = str_replace(",",".",htmlspecialchars($_GET['minPrice']));
            
            //check if one String was empty, set zero, because an empty string is not numeric
            if($_GET['maxPrice']=="")
            {
                $replaceMaxSeperator=0;
            }
            elseif($_GET['minPrice']=="")
            {
                $replaceMinSeperator=0;
            }

            //check if user-entry is a valid number, if not do not perform any filtering by price and give message to user
            if(is_numeric($replaceMaxSeperator) && is_numeric($replaceMinSeperator))
            {
                //make price entries to clean float value
                $maxPrice = floatval($replaceMaxSeperator);
                $minPrice = floatval($replaceMinSeperator);

                if($minPrice>0 && $maxPrice>0)
                {
                    foreach($products as $element)
                    {
                        $productPrice= getProductPriceByID($element->productID,false);

                        if($productPrice<=$maxPrice && $productPrice>=$minPrice)
                        {
                            array_push($resultArrayPrice,$element);
                        }
                    }
                }
                elseif($minPrice>0 && $maxPrice=="")
                {
                    foreach($products as $element)
                    {
                        $productPrice= getProductPriceByID($element->productID,false);

                        if($productPrice>=$minPrice)
                        {
                            array_push($resultArrayPrice,$element);
                        }
                    }
                }
                elseif($maxPrice>0 && $minPrice=="")
                {
                    foreach($products as $element)
                    {
                        $productPrice= getProductPriceByID($element->productID,false);

                        if($productPrice<=$maxPrice)
                        {
                            array_push($resultArrayPrice,$element);
                        }
                    }
                }
            }
            else
            {
                $resultArrayPrice=$products;
                $errorMessage['NotANumber']="Ungültige Zahl im Preisfilter";
            }
        }
        else
        {
            $resultArrayPrice=$products;
        }
            //merge the arrays by the elements occuring in both lists
            $superEndArray=[];
            foreach($products as $element) 
            {
                if(in_array($element,$resultArrayPrice) && in_array($element, $resultArrayCategory))
                {
                    array_push($superEndArray,$element);
                }
            }

            //create multidimensional array for later use in the sorting
            $productsAndTheirPrice=[];
            foreach ($superEndArray as $element)
            {
                $productToAdd=[];
                $productPrice= getProductPriceByID($element->productID,false);
                array_push($productToAdd,$element,$productPrice);
                array_push($productsAndTheirPrice,$productToAdd);
            }

            //Sortieren des Arrays nach Kundenwunsch anhand des Preises
            if(isset($_GET['sorting']))
            {
            if( $_GET['sorting']==='asc' || $_GET['sorting']==='desc')
            {
          
                $sortingDirection = "";
                if($_GET['sorting']==='asc')
                {
                    $sortingDirection = SORT_ASC;
                }
                elseif($_GET['sorting']==='desc')
                {
                    $sortingDirection = SORT_DESC;
                }
                $volume = array_column($productsAndTheirPrice, 1);
                array_multisort($volume, $sortingDirection, $productsAndTheirPrice);
            }
            }

            $this->setParam('products', $products);
            $this->setParam('filteredProducts', $productsAndTheirPrice);
            $this->setParam('errorMessage', $errorMessage);
        }
	}

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
        $title='ProTec > Neu';
        $this->setParam('title', $title);

        $newProducts = protec\model\Product::getNewest(5);
        
        $this->setParam('newProducts', $newProducts);

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