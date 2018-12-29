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

    // Удалить строку заказа c id = p1
    public static function removeItem($p1, $link = null)
    {
        $res = 0;
        $result = DataBase::dbQuery($link, "DELETE FROM shm1.ticketitem WHERE id = $1", array($p1));
        if (pg_affected_rows($result) > 0) $res = 1;
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