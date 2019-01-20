<?php

class ModelTicket extends Model
{

    /**
     * Returns info about show by id
     */
    public static function getShowData($idShow)
    {
        $db = DataBase::getConnection();
        $sql = "SELECT t2.title AS filmtitle, to_char(starttime,'hh:mm') AS starttime_disp, t3.theatername 
                FROM shm1.show AS t1, shm1.film AS t2, shm1.theater AS t3   
                WHERE (t1.id = :idShow) AND (t1.film = t2.id) AND (t1.theater = t3.id)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':idShow', $idShow, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Returns order id
     */
    public static function getIdOrder($idUser)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT shm1.utils_getorderid(:idUser) As res';

        $result = $db->prepare($sql);
        $result->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchColumn();
    }

    /**
     * Adds an order item and returns the result of execution.
     */
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

}
