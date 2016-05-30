<?php
// use in development mode
error_reporting(E_ALL);

date_default_timezone_set('Europe/Bucharest');
define('ROOT_PATH', dirname(realpath(__FILE__)));
define('APP_PATH',ROOT_PATH.'/App');
define('CONFIG_PATH',APP_PATH.'/Config');

require_once 'vendor/autoload.php';

$app = new Core\Own;