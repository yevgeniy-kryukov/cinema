<?php   
require_once "../autoloader.php";

use cinema\security\UserApp;
use cinema\util\Main;

$fn = Main::requestGet("fn");
$err = "";
if ($fn == "") { $err = "No function name!"; }
if ($err != "") { echo $err; }
else {
    switch($fn) {
        case "signIn":
            echo UserApp::signIn(Main::requestGet("email"), Main::sessionGet("pw"));
            break;
        default:
            echo "Not found function " . $fn . "!";
            break;
    }
}
?>