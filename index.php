<?php

session_start();

require_once 'init/database.php';
require_once 'init/imports.php';

foreach(glob('models/*.php') as $modelclass) //including all present models
{
    require_once $modelclass;
}

// checks for presence of wanted controller; if not present, uses pages controller as default
$controllerName = $_GET['c'] ?? 'pages';

// checks for presence of wanted action; if not present, uses index action as default
$actionName = $_GET['a'] ?? 'index';

// generate path for base controller file
$controllerPath = __DIR__.'/controller/'.$controllerName.'Controller.php';

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
			$controllerInstance->renderHTML();
		}
		else
		{
			header('Location: error404.php?c=errors&a=error404');
		}
	}
	else
	{
		header('Location: error404.php?c=errors&a=error404');
	}
}
else
{
	header('Location: error404.php?c=errors&a=error404');
}