<?php
require_once("DataBase.php");
class Film 
{
    // Топ фильмов по продажам, с фильтром по категории - p1
    public static function TopCategory($p1, $link = null)
    {
        $result = DataBase::db_query($link, "SELECT * FROM shm1.film_query_top_category($1)", array($p1));
        return $result;
        
    }

    // Топ фильмов по продажам
    public static function TopFilms($link = null)
    {
        $result = DataBase::db_query($link, "SELECT * FROM shm1.film_query_top_films()");
        return $result;
    }

    // Список фильмов с фильтром по категории и рейтингу
    public static function ListFilms($pcat, $prat, $link = null)
    {
        $qr = "SELECT tx1.id, tx1.description, tx1.length, tx1.rating, tx1.title, tx2.categoryname 
                FROM shm1.film AS tx1, shm1.filmcategory AS tx2
                WHERE (tx1.category = tx2.id) AND (tx1.playingnow = true)";
        if ($pcat != "*") $qr = $qr . " AND (tx1.category = " . $pcat . ")";
        if ($prat != "*") $qr = $qr . " AND (tx1.rating = '" . $prat . "')";
        $result = DataBase::db_query($link, $qr);
        return $result;
    }

    //.
    public static function InfoFilm($pidfilm, $link = null)
    {
        $result = DataBase::db_query($link, "SELECT * FROM shm1.film WHERE id = $1", array($pidfilm));
        return $result;
    }
}

?>