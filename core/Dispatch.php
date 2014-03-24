<?php
class Dispatch{
	private function __construct(){}
	
	public static function Dispatch($router){
		$classobj = $router->classobj;
		$method = $router->method;
		$paras = $router->paras;
		$classobj->setParas($paras);
		
		if (count($paras)>0){
			//call_user_func_array(array(对象，方法)，参数数组);
			call_user_func_array(array($classobj,$method), $paras);
		}
		else{
			$classobj->$method();
		}
	}
}