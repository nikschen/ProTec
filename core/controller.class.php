<?php

namespace protec\core;

class Controller
{

	private $actionName = null; 
	private $controllerName = null; 

	protected $viewParams = []; //parameters for related Views

	public function __construct($action = null, $controllerName = null)
	{
		$this->_action         = $action;
		$this->_controllerName = $controllerName;
	}

	public function renderHTML()
	{
		// generate view by callend controller name and called action name
		$viewPath = $this->viewPath($this->_controllerName, $this->_action);

		// flat the assoc array to variables so that the correct names availible in our view rending
		extract($this->_params);

		// can not be used as key in params and will overwritten here as safety
		$body = '';

		if(file_exists($viewPath))
		{
			// new paper for include !! meanse clean output which can be used to store the view
			// into an variable for better layout handling!
			ob_start();
			{
				include $viewPath;
			}
			$body = ob_get_clean();
		}

		include __DIR__.'/../views/layout.php';
		
	}

	protected function viewPath($controllerName, $action)
	{
		return __DIR__.'/../views/'.$controllerName.'/'.$action.'.php';
	}
}