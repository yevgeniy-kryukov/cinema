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
        case "signOut":
            echo UserApp::signOut();
            break;
        default:
            echo "Not found function " . $fn . "!";
            break;
    }
}
?>