<?php
namespace cinema\model;

use cinema\util\DataBase;

class TicketItem 
{
    // Строки заказа c id = p1
    public static function showItems($p1, $link = null)
    {
        $rows = array();
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.ticketitem_query_showitem($1)", array($p1));
        if (pg_num_rows($result) > 0) $rows = pg_fetch_all($result);
        return $rows;
    }

    //.
    public static function addItem($puserid, $pshowid, $porderid, $patickets, $pctickets, $link = null)
    {
        $res = 0;
        $result = DataBase::dbQuery($link, "SELECT shm1.utils_addshow($1, $2, $3, $4, $5) As res", array($puserid, $pshowid, $porderid, $patickets, $pctickets));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result, 0);
            $res = $row["res"];
        }
        return $res;
    }

    // Удалить строку заказа c id = p1
    public static function removeItem($p1, $link = null)
    {
        $res = -101;
        $result = DataBase::dbQuery($link, "SELECT shm1.ticketitem_remove($1) AS res", array($p1));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
            $res = $row["res"];
        }
        return $res;
    }

    // Категория последней строки заказа с id = p1
    public static function showItemLastCategory($p1, $link = null)
    {
        $resCat = "";
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.ticketitem_query_lastcategory($1)", array($p1));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
            $resCat = $row["category"];
        }
        return $resCat;
    }
}

?>