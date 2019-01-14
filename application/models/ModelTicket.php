<?php

class ModelTicket extends Model
{
    // Информация о показе по его id
    public function infoShow($idShow, $link = null)
    {
        $row = null;
        $result = DataBase::dbQuery($link, 
                                    "SELECT t2.title AS filmtitle, to_char(starttime,'hh:mm') AS starttime_disp, t3.theatername 
                                    FROM shm1.show AS t1, shm1.film AS t2, shm1.theater AS t3   
                                    WHERE (t1.id = $1) AND (t1.film = t2.id) AND (t1.theater = t3.id)", 
                                    array($idShow)
                                );
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
        }
        return $row;
    }

    public function getIdOrder($idUser, $link = null)
    {
        $res = 0;
        $result = DataBase::dbQuery($link, 'SELECT shm1.utils_getorderid($1) As res', array($idUser));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result, 0);
            $res = $row['res'];
        }
        return $res;
    }

    public function addItem($idUser, $idShow, $idOrder, $aTickets, $cTickets, $link = null)
    {
        $res = 0;
        $result = DataBase::dbQuery($link, 'SELECT shm1.utils_addshow($1, $2, $3, $4, $5) As res', array($idUser, $idShow, $idOrder, $aTickets, $cTickets));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result, 0);
            $res = $row['res'];
        }
        return $res;
    }

}
