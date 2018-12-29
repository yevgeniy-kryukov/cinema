<?php
namespace cinema\model;

use cinema\util\DataBase;

class TicketOrder 
{
    // Информация о заказе с id =  porderid
    public static function showTicketOrder($porderid, $link = null)
    {
        $row = array();
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.ticketorder WHERE id = $1", array($porderid));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
        }
        return $row;
    }
}

?>