<?php
class Router{
	public static $instance;
	
	var $class;
	var $classobj;
	var $method;
	var $paras;
	
	var $default_controller;
	
	var $QC_TYPE='mvc';
	
	private function __construct(){
		
	}
	public static function getInstance(){
		if (self::$instance == null) {
			self::$instance = new Router();
		}
		return self::$instance;
	}
	
	public function route(){
		$uri = $_SERVER["REQUEST_URI"];
		$data = explode('/',$uri);
		$this->QC_TYPE = $_POST['qc_type'];
		
		if (!empty($data[2])){
			//$index = $data[0];
			$class = $data[2]."Controller";
			
			if (!empty($data[3]))
				$method = $data[3];
			else $method = "index";
		}
		else{//go to the default page
			$class = $this->default_controller."Controller";
			$method = "index";
		}
		
		$this->class = $class;
		$this->method = $method;
		
		//firstly find out whether the file exists
		
		if (!file_exists("controller".DIRECTORY_SEPARATOR."{$class}.php"))Error::controllerNotFound();
		//secondly find out whether the class exists
		if (!class_exists($class))Error::controllerNotFound();
		
		$classobj = $this->classobj = new $class(); 
		
		if (!method_exists($classobj, $method))Error::methodNotFound();
		
		if (!is_callable(array($classobj,$method)))Error::methodUncallable();
		
		$param_arr = array();
		
		if ($this->QC_TYPE == 'ajax'){
			//be compatible with:
			//1.	ajax request;
			//2.	fileupload request;
			if ($_POST['json']){
				$json = $_POST['json'];
				
				if (is_object($json)){
					$jsonarr = json_decode($json,true);
				}
				elseif (is_array($json)){
					$jsonarr = $json;
				}
				elseif (is_string($json)){
					$jsonarr = json_decode(json_encode($jsonarr),true);
				}
				$param_arr = $jsonarr;
			}
		}
		else {
			//be compatible only with:	normal mvc request
			if (count($data) > 4){
				if ((count($data)-4)%2 != 0) Error::parametersErr();
				for ($i=4; $i<count($data); $i+=2){
					
					$item = array($data[$i]=>$data[$i+1]);
					
					$param_arr = array_merge($param_arr,$item);
				}
			}
		}
		
		$this->paras = $param_arr;
	}
	
	function set_default_controller($controller){
		$this->default_controller = $controller;
	}
}