<?php
class Url{
	public function __construct(){
		
	}
	
	public function parseUrl(){
		return $_SERVER["REQUEST_URI"];
	}
	
}