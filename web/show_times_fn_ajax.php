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
            case "addShow":
                echo Utils::addShow(UtilsMain::requestGet("showid"), UtilsMain::sessionGet("Order", -1));
                break;
            default:
                echo "Not found function " . $fn . "!";
                break;
        }
    }
?>