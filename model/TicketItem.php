<?php
require_once("DataBase.php");
class TicketItem 
{
    // Строки заказа - p1
    public static function ShowItem($p1)
    {
        $result = DataBase::db_query(null, "SELECT * FROM shm1.ticketitem_query_showitem($1)", array($p1));
        return $result;
    }

    // Категория последней строки заказа - p1
    public static function ShowItemLastCategory($p1, $link = null)
    {
        $result = DataBase::db_query($link, "SELECT * FROM shm1.ticketitem_query_lastcategory($1)", array($p1));
        return $result;
    }
}

?>