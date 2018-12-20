<?php
namespace cinema\model;

require_once("../util/DataBase.php");

use cinema\util\DataBase;

class Film 
{
    // Топ фильмов по продажам, с фильтром по категории и рейтингу
    public static function topFilms($pcat, $prat, $link = null)
    {
        $resArr = array();
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.film_query_top_films($1, $2)", array($pcat, $prat));
        $resArr = pg_fetch_all($result);
        return $resArr;
    }

    //.
    public static function infoFilm($pidfilm, $link = null)
    {
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.film WHERE id = $1", array($pidfilm));
        return $result;
    }
}

?>