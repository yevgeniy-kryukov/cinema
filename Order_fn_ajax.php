<?php
    require_once("model/Utils.php");
    require_once("model/UtilsMain.php");

    $fn = UtilsMain::request_get("fn");
    $err = "";
    if ($fn == "") { $err = "No function name!"; }
    if ($err != "") { echo $err; }
    else {
        switch($fn) {
            case "ChangeQuantity":
                echo Utils::ChangeQuantity( UtilsMain::request_get("pitemid"), 
                                    UtilsMain::request_get("ptickettype"), 
                                    UtilsMain::request_get("pnewquantity") );
                break;
            default:
                echo "Not found function " . $fn . "!";
                break;
        }
    }
?>