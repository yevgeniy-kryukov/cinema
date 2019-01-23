<?php

class ModelOrderItem extends Model
{

    public static function addOrderItem($idUser, $idShow, $idOrder, $aTickets, $cTickets)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT shm1.utils_addshow(:idUser, :idShow, :idOrder, :aTickets, :cTickets) As res';

        $result = $db->prepare($sql);
        $result->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $result->bindParam(':idShow', $idShow, PDO::PARAM_INT);
        $result->bindParam(':idOrder', $idOrder, PDO::PARAM_INT);
        $result->bindParam(':aTickets', $aTickets, PDO::PARAM_INT);
        $result->bindParam(':cTickets', $cTickets, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchColumn();
    }

    
    public static function deleteOrderItem($idItem)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT shm1.ticketitem_remove(:idItem) AS res';

        $result = $db->prepare($sql);
        $result->bindParam(':idItem', $idItem, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchColumn();
    }

    public static function getOrderItemData($idItem)
    {
        $db = DataBase::getConnection();
        $sql = "SELECT t1.id, t1.adulttickets, t1.childtickets, t3.title, to_char(t2.starttime, 'hh:mm') AS starttime_disp,
                    t4.theatername, t2.film
                FROM shm1.ticketitem AS t1, shm1.show AS t2, shm1.film AS t3, shm1.theater AS t4, shm1.theaterhall AS t5
                WHERE (t1.show = t2.id) AND (t2.film = t3.id) AND (t2.theaterhall = t5.id) AND (t5.theater = t4.id)
                    AND (t1.id = :idItem)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':idItem', $idItem, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
    }

}
