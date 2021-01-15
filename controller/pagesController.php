<?php


class PagesController extends \protec\core\Controller
{
	

	public function actionIndex()
	{
		$myValue = 'This is the Index page. If Martin did it right, you won\'t see me in the final version.';
		$info='This is the Homepage. There will be a lot of fun to buy. Stay tuned.';
        $title='ProTec > Home';

        $this->setParam('title', $title);
		$this->setParam('myValue',$myValue);
		$this->setParam('info',$info);
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
        $title='ProTec > Logout';
        $this->setParam('title', $title);
	    if($_SESSION['loggedIn'] === true)
		{
			$_SESSION['loggedIn'] = false;
		}

		header('Location: index.php');
		exit();
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

	public function actionPaymentAndShippingDetails()
	{
        $title='ProTec > Versand- und Zahlungsbedingungen';
        $this->setParam('title', $title);
	}

	public function actionRightOfWithdrawal()
	{
        $title='ProTec > Widerrufsrecht';
        $this->setParam('title', $title);
	}
    public function actionPrivacyGuidelines()
    {
        $title='ProTec > Datenschutz';
        $this->setParam('title', $title);
    }
    public function actionAgb()
    {
        $title='ProTec > AGB';
        $this->setParam('title', $title);
    }
    public function actionImpressum()
    {
        $title='ProTec > Impressum';
        $this->setParam('title', $title);
    }
	public function actionCustomerpromotion()
    {
        $title='ProTec > CustomerPromotion';
        $this->setParam('title', $title);
	}
	
	public function actionTrustpoints()
    {
        $title='ProTec > Treuepunkte';
        $this->setParam('title', $title);
	}
	
	public function actionBusinessdiscount()
    {
        $title='ProTec > Geschäftskundenrabatte';
        $this->setParam('title', $title);
	}

    public function actionJobs()
    {
        $title='ProTec > Jobs';
        $this->setParam('title', $title);
    }

	
	public function actionNewsletter()
    {
        $title='ProTec > Newsletter';
        $this->setParam('title', $title);
	}
	public function actionContactForm()
    {
        $title='ProTec > Kontaktformular';
        $this->setParam('title', $title);
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
    public function actionSubcategoryCables()
    {
        $prodID=[];
        $prodNames=[];
        $products=protec\model\Product::find('category="Kabel"');
        foreach($products as  $productID=>$products['productID'])
        {
            array_push($prodID,$productID);
        }
//        foreach($products as  $prodName => $products['prodName'])
//        {
//            array_push($prodNames,$prodName);
//        }

        $arrayInhalt="<pre>$products<pre>";

        $title='ProTec > Elektronik > Kabel';
        $this->setParam('title', $title);
        $this->setParam('products', $products);
        $this->setParam('prodID', $prodID);
        $this->setParam('prodNames', $prodNames);
        $this->setParam('arrayInhalt', $arrayInhalt);
    }




}