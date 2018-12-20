<?php
namespace cinema\model;

require_once("../util/DataBase.php");

class TicketOrder 
{
    // Информация о заказе с id =  porderid
    public static function showTicketOrder($porderid)
    {
        $result = DataBase::dbQuery(null, "SELECT * FROM shm1.ticketorder WHERE id = $1", array($porderid));
        return $result;
    }
}

?>