<?php

session_start();

// all require stuff to work!!
require_once 'init/database.php';
require_once 'init/imports.php';

foreach(glob('models/*.php') as $modelclass) //including all present models
{
    require_once $modelclass;
}

// query params with 'c' means controller and 'a' means action
// controller is alwayse the controller of the views
// and the action is alwayse the method of the controller, which has be called before render HTML

// check controller name is given? if not use 'pages' as default!
$controllerName = $_GET['c'] ?? 'pages';

// check action name is given? if not use 'index' as default!
$actionName = $_GET['a'] ?? 'index';

// generate the correct controller path and check file exists?
$controllerPath = __DIR__.'/controller/'.$controllerName.'Controller.php';

if(file_exists($controllerPath))
{
	include_once $controllerPath;

	// example of included controller name is PagesController in default
	$controllerClassName = '\\app\\controller\\'.ucfirst($controllerName).'Controller';

	// is the class name a valid name in our context?
	if(class_exists($controllerClassName))
	{
		// generate the controller as an object from the class name
		$controllerInstance = new $controllerClassName($actionName, $controllerName);

		// check index action is availible
		$actionMethodName = 'action'.ucfirst($actionName);

		if(method_exists($controllerInstance, $actionMethodName))
		{
			// call the action method and render HTML !!!
			$controllerInstance->{$actionMethodName}();
			$controllerInstance->renderHTML();
		}
		else
		{
			echo "Methode existiert nicht";
			//header('Location: error404.php?c=errors&a=error404');
		}
	}
	else
	{
		echo "Klasse existiert nicht";
		//header('Location: error404.php?c=errors&a=error404');
	}
}
else
{
	echo "Datei existiert nicht";
	//header('Location: error404.php?c=errors&a=error404');
}