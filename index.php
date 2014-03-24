<?php
define('APP', dirname(__FILE__));//app 结对路劲
define('APP_REL', str_replace(DIRECTORY_SEPARATOR, '/', str_replace($_SERVER['DOCUMENT_ROOT'], '', APP)));//app 相对路劲

require_once APP.DIRECTORY_SEPARATOR.'config.php';

$load = Loader::getInstance();

$load->loadHelper('error');
$load->loadHelper('utils');

$router = Router::getInstance();

$router ->set_default_controller('Welcome');

$router->route();

Dispatch::Dispatch($router);