<?php

use cinema\components\Router;

// FRONT CONTROLLER

// general settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// include files
define('ROOT', dirname(__FILE__));
require_once ROOT . '/vendor/autoload.php';
require_once ROOT . '/components/autoload.php';


$router = new Router();
$router->run();
