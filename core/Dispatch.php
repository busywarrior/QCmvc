<?php
class Dispatch{
	private function __construct(){}
	
	public static function Dispatch($router){
		
		$classobj = $router->classobj;
		$method = $router->method;
		$paras = $router->paras;
		
		
		$classobj->setParas($paras);
		$get_return=$classobj->$method();  
	}
}