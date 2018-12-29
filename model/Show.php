<?php
namespace cinema\model;

use cinema\util\DataBase;

class Show 
{
    // Список показов в театрах фильма по его id
    public static function showTimes($idFilm, $link = null)
    {
        $resArr = array();
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.show_query_showtimes($1)", array($idFilm));
        if (pg_num_rows($result) > 0) {
            $resArr = pg_fetch_all($result);
        }
        return $resArr;
    }

    // Информация о показе по его id
    public static function infoShow($idShow, $link = null)
    {
        $resArr = array();
        $result = DataBase::dbQuery($link, 
                                    "SELECT t2.title AS filmtitle, to_char(starttime,'hh:mm') AS starttime_disp, t3.theatername 
                                    FROM shm1.show AS t1, shm1.film AS t2, shm1.theater AS t3   
                                    WHERE (t1.id = $1) AND (t1.film = t2.id) AND (t1.theater = t3.id)", 
                                    array($idShow)
                                );
        if (pg_num_rows($result) > 0) {
            $resArr = pg_fetch_array($result);
        }
        return $resArr;
    }
}

?>