<?php
require_once("DataBase.php");
class Show 
{
    // Список времени с театром на фильм - p1
    public static function ShowTimes($p1, $link = null)
    {
        $result = DataBase::db_query($link, "SELECT * FROM shm1.show_query_showtimes($1)", array($p1));
        return $result;
    }
}

?>