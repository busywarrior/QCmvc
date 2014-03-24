<?php
class PDO{
	static $pdo = null;
	
	private function __construct(){
		
	}
	
	function getpdo(){
		if (null == $pdo){
			self::$pdo = new PDO();
		}
		return self::$pdo;
	}
	
	//TODO other functions
}