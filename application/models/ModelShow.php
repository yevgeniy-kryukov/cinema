<?php

class ModelShow extends Model
{

    // Список показов в театрах фильма по его id
    public function showTimes($idFilm, $link = null)
    {
        $resArr = array();
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.show_query_showtimes($1)", array($idFilm));
        if (pg_num_rows($result) > 0) {
            $resArr = pg_fetch_all($result);
        }
        return $resArr;
    }

    // Возвращает название фильма по его id
    public function titleFilm($idFilm, $link = null)
    {
        $title = "";
        $result = DataBase::dbQuery($link, "SELECT title FROM shm1.film WHERE id = $1", array($idFilm));
        if (pg_num_rows($result) > 0) {
            $row = pg_fetch_array($result);
            $title = $row["title"];
        }
        return $title;
    }

}
