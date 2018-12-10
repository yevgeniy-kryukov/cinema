<?php
require_once("DataBase.php");
class FilmCategory 
{
    // Список всех категорий фильмов
    public static function CategoryName()
    {
        $result = DataBase::db_query(null, "SELECT * FROM shm1.filmcategory_query_categoryname()");
        return $result;
    }

    // Данные категории по id категории
    public static function CategoryInfo($pidcat, $link = null)
    {
        $result = DataBase::db_query($link, "SELECT * FROM shm1.filmcategory WHERE id = $1", array($pidcat));
        return $result;
    }
}

?>