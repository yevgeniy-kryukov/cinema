<?php


// FRONT CONTROLLER

// general settings
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

// include files
define('ROOT', dirname(__FILE__));
require_once ROOT . '/config/db.php';
require_once ROOT . '/vendors/PHPMailer/Exception.php';
require_once ROOT . '/vendors/PHPMailer/SMTP.php';
require_once ROOT . '/vendors/PHPMailer/PHPMailer.php';
require_once ROOT . '/core/Autoload.php';

// call Router
$router = new Router();
$router->run();
