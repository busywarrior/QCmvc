<?php
class Error{
	public function __construct(){
		
	}
	
	public function showError($msg){
		exit(json_decode(array(status=>false,'result'=>$msg)));
	}
	
	public function redirect($page){
		exit("<script>location.href='$page';</script>");
	}
	
	public function viewNotFound($view=""){
		self::showError("QC System Error:	The view ".$view." is not found!");
	}
	
	public function go404(){
		redirect("/404.php");
	}
	
	public function modelNotFound(){
		self::showError("QC System Error:	Model is not found!");
	}
	
	public function controllerNotFound(){
		self::showError("QC System Error:	Controller is not found!");
	}
	
	public function methodNotFound(){
		self::showError("QC System Error:	Method is not found!");
	}
	
	public function methodUncallable(){
		self::showError("QC System Error:	Method is not callable!");
	}
	
	public function parametersErr(){
		self::showError("QC System Error:	Parameter's wrong!");
	}
	
	public function ajax_parametersErr(){
		self::showError("QC System Error:	Ajax Parameter's wrong!");
	}
}