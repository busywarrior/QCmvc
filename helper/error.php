<?php
function showError($msg){
		exit(json_encode(array('status'=>false,'result'=>$msg)));
	}

function redirect($page){
	exit("<script>location.href='$page';</script>");
}

function viewNotFound($view=""){
	showError("QC System Error:	The view ".$view." is not found!");
}

function go404(){
	redirect("/404.php");
}

function modelNotFound(){
	showError("QC System Error:	Model is not found!");
}

function controllerNotFound(){
	showError("QC System Error:	Controller is not found!");
}

function methodNotFound(){
	showError("QC System Error:	Method is not found!");
}

function methodUncallable(){
	showError("QC System Error:	Method is not callable!");
}

function parametersErr(){
	showError("QC System Error:	Parameter's wrong!");
}

function ajax_parametersErr(){
	showError("QC System Error:	Ajax Parameter's wrong!");
}