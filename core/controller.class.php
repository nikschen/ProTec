<?php

namespace protec\core;

class Controller
{

	private $actionName = null; 
	private $controllerName = null; 

	protected $viewParams = []; //parameters for related Views

	public function __construct($actionName = null, $controllerName = null)
	{
		$this->actionName     = $actionName;
		$this->controllerName = $controllerName;
	}

	public function renderHTML()
	{
		
		// get viewpath via name of the controller and wanted action
		$viewPath = $this->viewPath($this->controllerName, $this->actionName);

		extract($this->viewParams); //Import variables into the current symbol table from an array
		
		// can not be used as key in params and will overwritten here as safety
		$body = '';

		if(file_exists($viewPath))
		{
			ob_start();
			{
				include $viewPath;
			}
			$body = ob_get_clean();
		}

		include __DIR__.'/../views/pages/index.php';
		
	}

	protected function viewPath($controllerName, $actionName)
	{
		return __DIR__.'/../views/'.$controllerName.'/'.$actionName.'.php';
	}
}