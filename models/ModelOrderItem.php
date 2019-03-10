<?php

class ModelOrderItem extends Model
{

    public static function addOrderItem($idShow, $idOrder, $aTickets, $cTickets)
    {
        $tot = 0;
		$price = [];
        $res = 0;
    
        $db = DataBase::getConnection();

        $db->beginTransaction();

        $sql = 'SELECT id FROM shm1.ticketitem WHERE (ticketorder = :idOrder) AND (show = :idShow)';
        $result = $db->prepare($sql);
        $result->bindParam(':idOrder', $idOrder, PDO::PARAM_INT);
        $result->bindParam(':idShow', $idShow, PDO::PARAM_INT);
        $result->execute();

        if ($result->fetchColumn() === false) {
            $sql = 'SELECT adultprice, childprice FROM shm1.show WHERE id = :idShow';
            $result = $db->prepare($sql);
            $result->bindParam(':idShow', $idShow, PDO::PARAM_INT);
            $result->execute(); 
            $price = $result->fetch();  

            if ($price !== false) {
                $sql = 'INSERT INTO shm1.ticketitem (adulttickets, childtickets, show, ticketorder) 
				        VALUES (:aTickets, :cTickets, :idShow, :idOrder)';
                $result = $db->prepare($sql);
                $result->bindParam(':aTickets', $aTickets, PDO::PARAM_STR);
                $result->bindParam(':cTickets', $cTickets, PDO::PARAM_STR);
                $result->bindParam(':idShow', $idShow, PDO::PARAM_INT);
                $result->bindParam(':idOrder', $idOrder, PDO::PARAM_INT);

                if ($result->execute()) {
                    $tot = ($aTickets * $price['adultprice']) + ($cTickets * $price['childprice']);

                    $sql = 'UPDATE shm1.ticketorder SET total = total + :tot WHERE id = :idOrder';
                    $result = $db->prepare($sql);
                    $result->bindParam(':tot', $tot, PDO::PARAM_STR);
                    $result->bindParam(':idOrder', $idOrder, PDO::PARAM_INT);

                    if ($result->execute()) {
                        $res = 1;
                    } else {
                        $res = -4;
                    }
                } else {
                    $res = -3;
                }

            } else {
                $res = -2;
            }
        } else {
            $res = -5;
        }

        if ($res == 1) {
            $db->commit();
        } else {
            $db->rollBack();
        }

        return $res;
    }


    public function changeQuantity($idItem, $ticketType, $newQuantity)
    {
        $res = 1;

        $db = DataBase::getConnection();

        $db->beginTransaction();

        $sql = 'SELECT titem.adulttickets, titem.childtickets, show.adultprice, show.childprice, titem.ticketorder 
                FROM shm1.ticketitem AS titem, shm1.show AS show
                WHERE (titem.show = show.id) AND (titem.id = :idItem)';
        $result = $db->prepare($sql);
        $result->bindParam(':idItem', $idItem, PDO::PARAM_INT);
        $result->execute();   

        $resultFetch = $result->fetch();

        if ($ticketType == 1) {
            $sql = 'UPDATE shm1.ticketitem SET adulttickets = :newQuantity WHERE id = :idItem';
            $calc = ($newQuantity - $resultFetch['adulttickets']) * $resultFetch['adultprice'];
        } else {
            $sql = 'UPDATE shm1.ticketitem SET childtickets = :newQuantity WHERE id = :idItem';
            $calc = ($newQuantity - $resultFetch['childtickets']) * $resultFetch['childprice'];
        }

        $result = $db->prepare($sql);
        $result->bindParam(':newQuantity', $newQuantity, PDO::PARAM_INT);
        $result->bindParam(':idItem', $idItem, PDO::PARAM_INT);
        if (!$result->execute()) $res = 0;
        
        $sql2 = 'UPDATE shm1.ticketorder SET total = total + :calc WHERE id = :idOrder';
        $result = $db->prepare($sql2);
        $result->bindParam(':calc', $calc, PDO::PARAM_STR);
        $result->bindParam(':idOrder', $resultFetch['ticketorder'], PDO::PARAM_INT);
        if (!$result->execute()) $res = -1;

        if ($res == 1) {
            $db->commit();
        } else {
            $db->rollBack();
        }

        return $res;
    }
    
    
    public static function deleteOrderItem($idItem)
    {
        $res = 1;

        $db = DataBase::getConnection();

        $db->beginTransaction();

        if (self::changeQuantity($idItem, 1, 0) == 1) {
            if (self::changeQuantity($idItem, 2, 0) == 1) {
                $sql = 'DELETE FROM shm1.ticketitem WHERE id = :idItem';
                $result = $db->prepare($sql);
                $result->bindParam(':idItem', $idItem, PDO::PARAM_INT);
                if (!$result->execute()) $res = -2;
            } else {
                $res = -1;
            }
        } else {
            $res = 0;
        }

        if ($res == 1) {
            $db->commit();
        } else {
            $db->rollBack();
        }

        return $res;
    }

    public static function getOrderItemData($idItem)
    {
        $db = DataBase::getConnection();
        $sql = "SELECT t1.id, t1.adulttickets, t1.childtickets, t3.title, to_char(t2.starttime, 'HH24:MI') AS starttime_disp,
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
