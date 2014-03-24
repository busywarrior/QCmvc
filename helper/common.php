<?php
function is_ajax(){
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) and strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function is_auth(){
	if (!empty($_SESSION['id'])){
		return true;
	}
	else return false;
}

function response($content){
	if(is_ajax() && $content){
		$data = is_array($content)? $content: array($content);
		exit(json_encode($content));
	}
	exit($content);
}