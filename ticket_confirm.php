<?php
    namespace Cinema;
    
    require_once("model/DataBase.php");
    require_once("model/Utils.php");
    require_once("model/UtilsMain.php");
    require_once("model/TicketItem.php");

    $link = DataBase::dbConnect();
    $OrderId = UtilsMain::sessionGet("Order");
    if ($OrderId != "") { 
         $result = TicketItem::showItemLastCategory($OrderId, $link);
         if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
            $Category = $row["category"];
            UtilsMain::responseSetCookie("CacheCinemaLastCategory", $Category, time()+60*60*24*7, "/");
         }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ticket Confirm</title>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head>
<body bgcolor="#FFFFFF">
    <?php
        if ($OrderId != ""){
            $res = Utils::completeOrder($OrderId, $link);
            if ($res == 1) {
                echo "Your order was processed successfully. ";
                echo "Thank you for using PHP Cinema!<br><br>";
                if (UtilsMain::requestPost("OrderEmail") != "") {
                    echo Utils::sendEmail(UtilsMain::requestPost("OrderEmail"));
                    echo "Your tickets have been ordered.";
                 } 
            } else {
                echo "Error $res at the completion of the order. $OrderId";
            }
        } else {
            echo "Your order expired before it was completed.";
        }
    ?>
</body>
</html>
<?php pg_close($link); ?>
