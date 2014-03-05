<?php
require_once 'config.php';

$load = Loader::getInstance();

$load->loadHelper('Error');
$load->loadHelper('Url');
$load->loadHelper('Mysql');

$router = Router::getInstance();

$router ->set_default_controller('Welcome');

$router->route();

Dispatch::Dispatch($router);