<?php
if (!function_exists('example')){
	function example(){
		
	}
}

if (!function_exists('__autoload')){
	function __autoload($class){
		require_once $class.'.php';
	}
}

if (!function_exists('init')){
	function init(){
		set_include_path(get_include_path().PATH_SEPARATOR .'core');
		set_include_path(get_include_path().PATH_SEPARATOR .'helper');
		set_include_path(get_include_path().PATH_SEPARATOR .'helper/db');
		set_include_path(get_include_path().PATH_SEPARATOR .'library');
		set_include_path(get_include_path().PATH_SEPARATOR .'modle');
		set_include_path(get_include_path().PATH_SEPARATOR .'controller');
		set_include_path(get_include_path().PATH_SEPARATOR .'view');
	}
}


if (!function_exists('safe_config')){
	function safe_config(){
		if (ini_get('register_globals'))
			ini_set('register_globals', 'Off');
	}
}
 
if (!function_exists('post_check')){
	function post_check($post)
    {
    	if (!get_magic_quotes_gpc())  
    	{
    		$post = addslashes($post); 
    	}
    	$post = str_replace("_", "\_", $post);
    	$post = str_replace("%", "\%", $post); 
    	$post = nl2br($post); 
    	$post= htmlspecialchars($post);
    	return $post;
    }
}