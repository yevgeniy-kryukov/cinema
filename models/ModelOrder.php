<?php

class ModelOrder extends Model
{
    // Список всех заказов пользователя с id = $idUser
    public static function showUserOrders($idUser)
    {
        $rows = array();
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 
                                    'SELECT * FROM shm1.ticketorder WHERE userapp = $1 
                                    ORDER BY complete, order_date DESC, id DESC', 
                                    array($idUser));
        if (pg_num_rows($result) > 0) {
            $rows = pg_fetch_all($result);
        }
        return $rows;
    }

    // Информация о заказе с id =  $idOrder
    public static function showTicketOrder($idOrder)
    {
        $row = null;
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.ticketorder WHERE id = $1', array($idOrder));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
        }
        return $row;
    }

    // Удалить строку заказа c id = $orderItemId
    public static function deleteItem($orderItemId)
    {
        $res = -101;
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 'SELECT shm1.ticketitem_remove($1) AS res', array($orderItemId));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
            $res = $row['res'];
        }
        return $res;
    }

    // Возвращает данные всех cтрок заказа c id = $idOrder
    public static function showAllItems($idOrder)
    {
        $rows = array();
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.ticketorder_query_showitems($1)', array($idOrder));
        if (pg_num_rows($result) > 0) $rows = pg_fetch_all($result);
        return $rows;
    }

    // Возвращает данные строки заказа c id = $itemOrderId
    public static function showOneItem($itemOrderId)
    {
        $row = null;
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.ticketitem_query_showitem($1)', array($itemOrderId));
        if (pg_num_rows($result) > 0) $row = pg_fetch_array($result);
        return $row;
    }

    public static function completeOrder($idOrder)
    {
        $res = 0;
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 'SELECT shm1.utils_completeorder($1) As res', array($idOrder));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result, 0);
            $res = $row['res'];
        }
        return $res;
    }

    // Категория последней строки заказа с id = $idOrder
    public static function showItemLastCategory($idOrder)
    {
        $resCat = '';
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.ticketitem_query_lastcategory($1)', array($idOrder));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
            $resCat = $row['category'];
        }
        return $resCat;
    }
}
