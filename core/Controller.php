<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/config.php';

class Controller{
	public static $instance;
	
	var $paras;
	var $models = array();
	
	var $QC_TYPE;
	
	protected function __construct(){
		$load = Loader::getInstance();
		
		foreach ($load->objs as $k=>$v){
			$this->$k = $v;
		}
		
		$router = Router::$instance;
		
		$this->QC_TYPE = $router->QC_TYPE;//get the QC request type, so the controller can handel it.
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
		
		if (!file_exists('model'.DIRECTORY_SEPARATOR.$modelName.'.php'))Error::modelNotFound();
		
		//save model into a static model array
		if (!array_key_exists($modelName, $this->models) || empty($this->models[$modelName])){
			$model = new $modelName();
			$this->models[$modelName] = $model;
		}
		
		$model = $this->models[$modelName];
		
		return $model;
	}
	
	function loadView($viewName = ""){
		if (empty($viewName)){
			$viewName = get_class($this);
			$viewName = str_replace('Controller', '', $viewName);
		}
		if (empty($viewName) || !file_exists('view'.DIRECTORY_SEPARATOR.$viewName.'.php')){
			Error::viewNotFound($viewName);
		}
		else {
			//require_once $_SERVER['DOCUMENT_ROOT'].'/view/'.$viewName.'.php';
			require_once $viewName.'.php';
		}
	}
	
	function setParas($paras){
		$this->paras = $paras;
	}
	
	function isAjax(){
		return $this->QC_TYPE == 'ajax'? true : false;
	}
}