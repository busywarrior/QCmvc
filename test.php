<?php
 

class Loader2{
	
	var $a = "test"; 
	
	public static $load = null;

	private function __construct(){
		
	}
	
	static function getLoader(){
		if (self::$load == null)
			self::$load = new Loader();
		return self::$load;
	}
	
	private function __autoload($object){
		require_once "{$object}.php";
	}
	
	public function getType(){
		echo get_class($this);
	}
}

class La extends Loader2 {
	public function __construct(){}
}

class Test{
	public function __construct(){
		//$this->load = & Loader::getLoader();
		
		$l = new La();
		$l->getType();
	}
}

$t = new Test();