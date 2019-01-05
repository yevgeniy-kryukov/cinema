<?php   
require_once "../autoloader.php";

use cinema\util\Main;
use cinema\model\{TicketOrder, TicketItem, Utils};

$fn = Main::requestGet("fn");
$err = "";
if ($fn == "") { $err = "No function name!"; }
if ($err != "") { echo $err; }
else {
    switch($fn) {
        case "changeQuantity":
            echo Utils::changeQuantity(Main::requestGet("pitemid"), Main::requestGet("ptickettype"), Main::requestGet("pnewquantity"));
            break;
        case "removeItem":
            echo TicketItem::removeItem(Main::requestGet("pitemid"));
            break;
        case "completeOrder":
            echo TicketOrder::completeOrder(Main::requestGet("porderid"));
            break;
        default:
            echo "Not found function " . $fn . "!";
            break;
    }
}
?>