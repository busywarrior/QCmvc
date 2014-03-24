<?php
class Controller{
	public static $instance;
	
	var $paras;
	var $model;
	
	protected function __construct(){
		$load = Loader::getInstance();
		
		if ($load->objs){
			foreach ($load->objs as $k=>$v){
				$this->$k = $v;
			}
		}
		$router = Router::$instance;
	}
	
	public static function getInstance(){
		if (self::$instance == null){
			self::$instance = new Controller();
		}
		return self::$instance;
	}
	
	function loadModel(){
		$modelName = get_class($this);
		$modelName = str_replace('Controller', 'Model', $modelName);
		
		if (!file_exists(APP.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.$modelName.'.php'))modelNotFound();
		
		//save model into a static model array
		if (!array_key_exists($modelName, $this->models) || empty($this->models[$modelName])){
			$model = new $modelName();
			$this->model->$modelName = $model;
		}
		
		return $this->model->$modelName;
	}
	
	function loadView($viewName = ""){		
		if (empty($viewName) || !file_exists(APP.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.$viewName.'.php')){
			viewNotFound($viewName);
		}
		else {
			require_once $viewName.'.php';
		}
	}
	
	function setParas($paras){
		$this->paras = $paras;
	}
}