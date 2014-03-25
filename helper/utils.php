<?php
//不兼容内容编辑
function parse($key){
	if (preg_match('/^([0-9a-zA-Z\_\.\@\-\=])+$/i', $key, $matches)){
		return $matches[0];
	}
}
//严格过滤
function post($key){
	if (isset($_POST[$key])){
		return parse($_POST[$key]);
	}
}
//严格过滤
function request($key){
	if (isset($_REQUEST[$key])){
		return parse($_REQUEST[$key]);
	}
}