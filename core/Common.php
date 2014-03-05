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

//注: 仅允许POST请求, 其他请求无效
if (!function_exists('post_check')){
	function post_check($post)
    {
    	if (!get_magic_quotes_gpc()) // 判断magic_quotes_gpc是否为打开     
    	{
    		$post = addslashes($post); // 进行magic_quotes_gpc没有打开的情况对提交数据的过滤     
    	}
    	$post = str_replace("_", "\_", $post); // 把 '_'过滤掉 
    	$post = str_replace("%", "\%", $post); // 把' % '过滤掉     
    	$post = nl2br($post); // 回车转换
    	$post= htmlspecialchars($post); // html标记转换
    	return $post;
    }
}