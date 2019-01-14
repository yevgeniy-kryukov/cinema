<?php

class ModelOrder extends Model
{
    // Список всех заказов пользователя с id = $idUser
    public function showUserOrders($idUser, $link = null)
    {
        $rows = array();
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
    public function showTicketOrder($idOrder, $link = null)
    {
        $row = null;
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.ticketorder WHERE id = $1', array($idOrder));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
        }
        return $row;
    }

    // Удалить строку заказа c id = $orderItemId
    public function deleteItem($orderItemId, $link = null)
    {
        $res = -101;
        $result = DataBase::dbQuery($link, 'SELECT shm1.ticketitem_remove($1) AS res', array($orderItemId));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
            $res = $row['res'];
        }
        return $res;
    }

    // Возвращает данные всех cтрок заказа c id = $idOrder
    public function showAllItems($idOrder, $link = null)
    {
        $rows = array();
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.ticketorder_query_showitems($1)', array($idOrder));
        if (pg_num_rows($result) > 0) $rows = pg_fetch_all($result);
        return $rows;
    }

    // Возвращает данные строки заказа c id = $itemOrderId
    public function showOneItem($itemOrderId, $link = null)
    {
        $row = null;
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.ticketitem_query_showitem($1)', array($itemOrderId));
        if (pg_num_rows($result) > 0) $row = pg_fetch_array($result);
        return $row;
    }

    public function completeOrder($idOrder, $link = null)
    {
        $res = 0;
        $result = DataBase::dbQuery($link, 'SELECT shm1.utils_completeorder($1) As res', array($idOrder));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result, 0);
            $res = $row['res'];
        }
        return $res;
    }

    // Категория последней строки заказа с id = $idOrder
    public function showItemLastCategory($idOrder, $link = null)
    {
        $resCat = '';
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.ticketitem_query_lastcategory($1)', array($idOrder));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
            $resCat = $row['category'];
        }
        return $resCat;
    }
}
