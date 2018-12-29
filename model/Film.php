<?php
namespace cinema\model;

use cinema\util\DataBase;

class Film 
{
    // Топ фильмов по продажам, с фильтром по категории и рейтингу
    public static function topFilms($pcat, $prat, $link = null)
    {
        $resArr = array();
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.film_query_top_films($1, $2)", array($pcat, $prat));
        if (pg_num_rows($result) > 0) {
            $resArr = pg_fetch_all($result);
        }
        return $resArr;
    }

    // Возвращает название фильма по его id
    public static function titleFilm($pidfilm, $link = null)
    {
        $title = "";
        $result = DataBase::dbQuery($link, "SELECT title FROM shm1.film WHERE id = $1", array($pidfilm));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
            $title = $row["title"];
        }
        return $title;
    }
}

?>