<?php   
require_once "../autoloader.php";

use cinema\model\Utils;
use cinema\util\Main;

$fn = Main::requestGet("fn");
$err = "";
if ($fn == "") { $err = "No function name!"; }
if ($err != "") { echo $err; }
else {
    switch($fn) {
        case "addShow":
            echo Utils::addShow(Main::requestGet("showID"), Main::sessionGet("orderID", -1), null, Main::requestGet("adultTickets"), Main::requestGet("childTickets"));
            break;
        default:
            echo "Not found function " . $fn . "!";
            break;
    }
}
?>