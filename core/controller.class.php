<?php

namespace protec\core;

class Controller
{

	private $actionName = null; 
	private $controllerName = null; 

	protected $viewParams = []; //parameters for related Views
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

		// can not be used as key in params and will overwritten here as safety
		$body = '';
		if(!file_exists($viewPath))
		{
			// redirect to error page 404 because not found
			header('Location: index.php?c=errors&a=error404');
			exit(0);
		}

        include 'views/pages/head.php';
		include 'views/pages/header.php';
		include $viewPath;
		include 'views/pages/footer.php';
		
		
	}

	protected function viewPath($controllerName, $actionName)
	{
		return __DIR__.'/../views/'.$controllerName.'/'.$actionName.'.php';
	}

	protected function setParam($key, $value= null)
	{
		$this->viewParams[$key] =$value;
	}

	public function __destruct()
	{
		$this->controllerName=null;
		$this->actionName=null;
		$this->viewParams=null;

	}
}