<?php   
require_once "../autoloader.php";

use cinema\model\{TicketOrder, TicketItem};
use cinema\util\Main;

$fn = Main::requestGet("fn");
$err = "";
if ($fn == "") { $err = "No function name!"; }
if ($err != "") { echo $err; }
else {
    switch($fn) {
        case "getOrderID":
            echo TicketOrder::getOrderID(Main::sessionGet("userID"));
            break;
        case "addItem":
            echo TicketItem::addItem(Main::sessionGet("userID"), Main::requestGet("showID"), Main::requestGet("orderID"),
                                 Main::requestGet("adultTickets"), Main::requestGet("childTickets"));
            break;
        default:
            echo "Not found function " . $fn . "!";
            break;
    }
}
?>