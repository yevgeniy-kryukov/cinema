<?php
    namespace Cinema;
    
    require_once("model/Utils.php");
    require_once("model/UtilsMain.php");

    $fn = UtilsMain::requestGet("fn");
    $err = "";
    if ($fn == "") { $err = "No function name!"; }
    if ($err != "") { echo $err; }
    else {
        switch($fn) {
            case "changeQuantity":
                echo Utils::changeQuantity( UtilsMain::requestGet("pitemid"), 
                                    UtilsMain::requestGet("ptickettype"), 
                                    UtilsMain::requestGet("pnewquantity") );
                break;
            default:
                echo "Not found function " . $fn . "!";
                break;
        }
    }
?>