<?php
    require_once("model/Utils.php");
    require_once("model/UtilsMain.php");

    $fn = UtilsMain::request_get("fn");
    $err = "";
    if ($fn == "") { $err = "No function name!"; }
    if ($err != "") { echo $err; }
    else {
        switch($fn) {
            case "AddShow":
                echo Utils::AddShow(UtilsMain::request_get("showid"), UtilsMain::session_get("Order", -1));
                break;
            default:
                echo "Not found function " . $fn . "!";
                break;
        }
    }
?>