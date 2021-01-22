<?php
session:session_save_path(__DIR__.DIRECTORY_SEPARATOR.'data');



require_once 'init/database.php';
require_once 'init/imports.php';
require_once 'init/staticPaths.php';



foreach(glob('models/*.php') as $modelclass) //including all present models
{
	require_once $modelclass;
}

// checks for presence of wanted controller; if not present, uses pages controller as default
$controllerName = $_GET['c'] ?? 'pages';

// checks for presence of wanted action; if not present, uses index action as default
$actionName = $_GET['a'] ?? 'index';

// generate path for base controller file
$controllerPath = CONTROLLERPATH.$controllerName.'Controller.php';


session_start();
if(!ISSET($_SESSION['productBasket']))
{
    $_SESSION['productBasket']=array();
}


//$data = new Customer;
//$Customer= Customer::findOne();
//;
//
//$data = $this->findOne();
//print_r($data);
//exit(0);




if(file_exists($controllerPath))
{
	include_once $controllerPath;

	// example of included controller name is PagesController in default
	$controllerClassName = ucfirst($controllerName).'Controller';


	// is the class name a valid name in our context?
	if(class_exists($controllerClassName))
	{
		// create instance of the wanted controller to work with
		$controllerInstance = new $controllerClassName($actionName, $controllerName);

		// fetches the wanted method
		$actionMethodName = 'action'.ucfirst($actionName);
		
		if(method_exists($controllerInstance, $actionMethodName))
		{
		
			// calls the wanted method and the controller defined HTML render method
			$controllerInstance->{$actionMethodName}();
			
		}
		else
		{
			header('Location: index.php?c=errors&a=error404');
		}
	}
	else
	{
		header('Location: index.php?c=errors&a=error404');
	}
}
else
{
	header('Location: index.php?c=errors&a=error404');
}

		
		$controllerInstance->renderHTML();

	
