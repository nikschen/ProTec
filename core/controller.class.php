<?php

namespace protec\core;

class Controller
{

	private $actionName = null; 
	private $controllerName = null; 

	protected $viewParams = []; //parameters for related Views
    public $title='ProTec';
	public $success = false;

	public function __construct($actionName = null, $controllerName = null)
	{
		$this->actionName     = $actionName;
		$this->controllerName = $controllerName;
	}

	public function renderHTML()
	{
		

		$viewPath = $this->viewPath($this->controllerName, $this->actionName);
		extract($this->viewParams); //Import variables into the current symbol table from an array

        if(isset($_SESSION['productBasket']))
        {
            $amountOfBasketEntries=count($_SESSION['productBasket']);
        }
        else
        {
            $amountOfBasketEntries=0;
        }
        $this->setParam('amountOfBasketEntries',$amountOfBasketEntries);

		// can not be used as key in params and will overwritten here as safety
		$body = '';
		if(!file_exists($viewPath))
		{
			// redirect to error page 404 because not found
			header('Location: index.php?c=errors&a=error404');
			exit(0);
		}
        include VIEWSPATH.'pages/head.php';
		include VIEWSPATH.'pages/header.php';
		include $viewPath;
		include VIEWSPATH.'pages/footer.php';
		
		
	}

	protected function viewPath($controllerName, $actionName)
	{
		return VIEWSPATH.$controllerName.'/'.$actionName.'.php';
	}

	protected function setParam($key, $value= null)
	{
		$this->viewParams[$key] =$value;
	}

	function rememberMe($email, $password)
	{
    $duration = time() + 3600*24*30;
    setcookie('email', $email, $duration, '/');
    setcookie('password', \encryptPassword($password), $duration, '/'); 
    
	}




	public function __destruct()
	{
		$this->controllerName=null;
		$this->actionName=null;
		$this->viewParams=null;

	}
}