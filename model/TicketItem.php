<?php
namespace cinema\model;

require_once("../util/DataBase.php");

class TicketItem 
{
    // Строки заказа - p1
    public static function showItem($p1)
    {
        $result = DataBase::dbQuery(null, "SELECT * FROM shm1.ticketitem_query_showitem($1)", array($p1));
        return $result;
    }

    // Категория последней строки заказа - p1
    public static function showItemLastCategory($p1, $link = null)
    {
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.ticketitem_query_lastcategory($1)", array($p1));
        return $result;
    }
}

?>