<?php

class ModelOrder extends Model
{

    public static function getUserOrders($idUser)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT * FROM shm1.ticketorder WHERE userapp = :idUser ORDER BY complete, order_date DESC, id DESC';
        
        $result = $db->prepare($sql);
        $result->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll();
    }

    public static function getOrderData($idOrder)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT * FROM shm1.ticketorder WHERE id = :idOrder';

        $result = $db->prepare($sql);
        $result->bindParam(':idOrder', $idOrder, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
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

    public static function getOrderItems($idOrder)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT * FROM shm1.ticketorder_query_showitems(:idOrder)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':idOrder', $idOrder, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll();
    }

    public static function getOrderItemData($idItem)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT * FROM shm1.ticketitem_query_showitem(:idItem)';
        
        $result = $db->prepare($sql);
        $result->bindParam(':idItem', $idItem, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
    }

    public static function completeOrder($idOrder)
    {
        $db = DataBase::getConnection();
        $sql = 'SELECT shm1.utils_completeorder(:idOrder) As res';
        
        $result = $db->prepare($sql);
        $result->bindParam(':idOrder', $idOrder, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchColumn();
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
        $result->bindParam(':idOrder', $idOrder, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchColumn();
    }
}
