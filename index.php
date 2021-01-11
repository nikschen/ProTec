<?php
session:session_save_path(__DIR__.DIRECTORY_SEPARATOR.'data');
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




//Basis Debuggin START ***************************************************************
print_r("ControllerPath: " . $controllerPath ." <br> ");
print_r("ControllerName: " .$controllerName . "<br>");
print_r("actionName: ". $actionName . "<br>");
//exit(1);

//Basis Debuggin END***************************************************************



if(file_exists($controllerPath))
{
	include_once $controllerPath;

	// example of included controller name is PagesController in default
	$controllerClassName = ucfirst($controllerName).'Controller';

	print_r("className: ". $controllerClassName . "<br>");
	//exit(1);

	// is the class name a valid name in our context?
	if(class_exists($controllerClassName))
	{
		// create instance of the wanted controller to work with
		$controllerInstance = new $controllerClassName($actionName, $controllerName);
		print_r($controllerInstance);
		//exit(1);
		// fetches the wanted method
		$actionMethodName = 'action'.ucfirst($actionName);
		print_r("actionMethodName: ". $actionMethodName . "<br>");
		
		if(method_exists($controllerInstance, $actionMethodName))
		{
		print_r("method exists " . $actionMethodName . "<br>");
			
		
			// calls the wanted method and the controller defined HTML render method
			//$controllerInstance->{$actionMethodName}();
			//exit(1);
			$controllerInstance->renderHTML();
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ProTec</title>
</head>
<body>
	<?php 
		include 'views/pages/header.php';
	
		$controller->renderHTML();
	
		include 'views/pages/footer.php';
	?>

	
</body>
</html>
