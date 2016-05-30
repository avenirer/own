<?php
// use in development mode
//error_reporting(E_ALL);

//define('ROOT_PATH', dirname(realpath(__FILE__)));
//define('APP_PATH',ROOT_PATH.'/App');

require_once 'vendor/autoload.php';

$app = new Core\Own;
$app->serve();