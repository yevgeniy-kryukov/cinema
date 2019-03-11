<?php

namespace cinema\models;

use cinema\components\DataBase;
use cinema\models\Model;

class ModelOrder extends Model
{

    public static function getUserOrders($idUser)
    {
        $db = DataBase::getConnection();
        $sql = "SELECT id,  total, (CASE WHEN complete = true THEN 'yes' ELSE 'no' END) AS complete_yn, order_date 
                FROM shm1.ticketorder 
                WHERE userapp = :idUser 
                ORDER BY complete, order_date DESC, id DESC";
        
        $result = $db->prepare($sql);
        $result->bindParam(':idUser', $idUser, \PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll();
    }

    public static function getOrderData($idOrder)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT * FROM shm1.ticketorder WHERE id = :idOrder';

        $result = $db->prepare($sql);
        $result->bindParam(':idOrder', $idOrder, \PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
    }

    public static function getOrderItems($idOrder)
    {
        $db = DataBase::getConnection();
        $sql = "SELECT t1.id, t1.adulttickets, t1.childtickets, t3.title, to_char(t2.starttime, 'HH24:MI') AS starttime_disp,
                    t4.theatername, t2.film
                FROM shm1.ticketitem AS t1, shm1.show AS t2, shm1.film AS t3, shm1.theater AS t4, shm1.theaterhall AS t5
                WHERE (t1.show = t2.id) AND (t2.film = t3.id) AND (t2.theaterhall = t5.id) AND (t5.theater = t4.id)
                    AND (t1.ticketorder = :idOrder)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':idOrder', $idOrder, \PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll();
    }

    public static function completeOrder($idOrder)
    {
        $res = 1;

        $db = DataBase::getConnection();

        $db->beginTransaction();

        $sql = 'SELECT titem.adulttickets, titem.childtickets, show.film
                FROM shm1.ticketitem As titem, shm1.show As show 
                WHERE (titem.show = show.film) AND (ticketorder = :idOrder)';
        $result = $db->prepare($sql);
        $result->bindParam(':idOrder', $idOrder, \PDO::PARAM_INT);
        $result->execute();

        foreach ($result->fetchAll() as $item) {
            $sql = 'UPDATE shm1.film SET ticketssold = ticketssold + :tickets WHERE id = :idFilm';
            $result = $db->prepare($sql);
            $result->bindParam(':tickets', $item['adulttickets'] + $item['childtickets'], \PDO::PARAM_INT);
            $result->bindParam(':idFilm', $item['film'], \PDO::PARAM_INT);
            if (!$result->execute()) {
                $res = -1;
                break;
            }
        }

        if ($res == 1) {
            $sql = 'UPDATE shm1.ticketorder SET complete = true WHERE id = :idOrder';
            $result = $db->prepare($sql);
            $result->bindParam(':idOrder', $idOrder, \PDO::PARAM_INT);
            if (!$result->execute()) $res = -2;
        }

        if ($res == 1) {
            $db->commit();
        } else {
            $db->rollBack();
        }

        return $res;
    }

    public static function getCategoryLastOrderItem($idOrder)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT t3.category 
                FROM shm1.ticketitem AS t1, shm1.show AS t2, shm1.film AS t3
                WHERE (t1.show = t2.id) AND (t2.film = t3.id) AND (t1.ticketorder = :idOrder)
                ORDER BY t1.id DESC 
                LIMIT 1;';
        
        $result = $db->prepare($sql);
        $result->bindParam(':idOrder', $idOrder, \PDO::PARAM_INT);
        $result->execute();

        return $result->fetchColumn();
    }

    public static function getIdOrder($idUser)
    {
        $idOrder = 0;

        $db = DataBase::getConnection();

        $sql = 'SELECT id FROM shm1.ticketorder WHERE (complete = false) AND (userapp = :idUser)';
        $result = $db->prepare($sql);
        $result->bindParam(':idUser', $idUser, \PDO::PARAM_INT);
        $result->execute();

        $resultFetch = $result->fetchColumn();

        if ($resultFetch === false) {
            $sql = 'INSERT INTO shm1.ticketorder (total, complete, userapp) VALUES (0, false, :idUser)';
            $result = $db->prepare($sql);
            $result->bindParam(':idUser', $idUser, \PDO::PARAM_INT);
            if ($result->execute()) {
                $idOrder = $db->lastInsertId('shm1.ticketorder_id_seq');
            }
        } else {
            $idOrder = $resultFetch;
        }

        return $idOrder;
    }
}
