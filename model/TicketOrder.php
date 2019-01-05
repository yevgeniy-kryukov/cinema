<?php
namespace cinema\model;

use cinema\util\{DataBase, Main};
use cinema\model\{TicketItem, Utils};

class TicketOrder 
{
    // Информация о заказе с id =  $porderid
    public static function showTicketOrder($porderid, $link = null)
    {
        $row = array();
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.ticketorder WHERE id = $1", array($porderid));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
        }
        return $row;
    }

    // Список всех заказов пользователя с id = $puserid
    public static function showUserOrders($puserid, $link = null)
    {
        $rows = array();
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.ticketorder WHERE userapp = $1 ORDER BY complete, order_date DESC, id DESC", array($puserid));
        if (pg_num_rows($result) > 0) {
            $rows = pg_fetch_all($result);
        }
        return $rows;
    }

    //.
    public static function getOrderID($puserid)
    {
        $res = 0;
        $result = DataBase::dbQuery(null, "SELECT shm1.utils_getorderid($1) As res", array($puserid));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result, 0);
            $res = $row["res"];
        }
        return $res;
    }

    public static function completeOrder($porderid, $link = null)
    {
        $res = 0;
        if ($link == null) $link1 = DataBase::dbConnect(); 
        else  $link1 = $link;
        $result = DataBase::dbQuery($link1, "SELECT shm1.utils_completeorder($1) As res", array($porderid));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result, 0);
            $res = $row["res"];
        }
        if ($res > 0) {
            Utils::sendEmail(Main::sessionGet("userEmail"));
            $lastCatID = TicketItem::showItemLastCategory($porderid, $link1);
            Main::responseSetCookie("cinemaLastCategory", $lastCatID, time() + 60 * 60 * 24 * 7, "/");
        }
        if ($link == null) pg_close($link1);
        return $res;
    }
}
?>