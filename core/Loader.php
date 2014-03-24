<?php
class Loader{
	private static $load;
	
	public $objs = null;
	
	private function __construct(){}
	
	public static function getInstance(){
		if (self::$load == null){
			self::$load = new Loader();
		}
		return self::$load;
	}
	
	//For Library, Helper modules
	private function load($module,$class){
		try {
			if ($this->$class == null){
				$dir = APP.DIRECTORY_SEPARATOR.$module;
				$filenames = scandir($dir);
				
				$flag = false; //classs does not exist;
				
				foreach ($filenames as $filename){
					$k = strtolower($class);
					if ($filename == $class.".php" && class_exists($class)){//need auto autoload, Filename is uppercase, and the class is uppercase as well
						
						if (!array_key_exists($k, $this->objs) || empty($this->objs[$k])){
							$instance = new $class();
							$this->objs[$k] = & $instance;
						}
						$flag = true;
					}
				}
			}
			else $flag=true;
		}
		catch (Exception $e){
			exit("QC System Error: ".$e->getMessage());
		}
		
		if (!$flag) {
			exit("QC System Error: The module ".$class.'/'.$module." does not exist. ");
		}
	}
	
	public function loadHelper($help){
		require_once APP.DIRECTORY_SEPARATOR.'helper'.DIRECTORY_SEPARATOR.$help.'.php';
	}
	
	public function loadLibrary($class){
		self::load('library', $class);
	}
	
	public function isLoaded($module, $class){
		if ($this->$class == null)return true;
		return false;
	}
}