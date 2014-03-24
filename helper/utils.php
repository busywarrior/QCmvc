<?php
//不兼容内容编辑
function parse($key){
	if (preg_match('/^([0-9a-zA-Z_.@])+$/i', $key, $matches)){
		return $matches[0];
	}
}
//严格过滤
function post($key){
	if ($_POST[$key]){
		return parse($key);
	}
}
//严格过滤
function request($key){
	if ($_REQUEST[$key]){
		return parse($key);
	}
}