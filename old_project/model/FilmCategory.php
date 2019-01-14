<?php
namespace cinema\model;

use cinema\util\DataBase;

class FilmCategory 
{
    // Список всех категорий фильмов
    public static function categoryList($link = null)
    {
        $resArr = array();
        $result = DataBase::dbQuery($link, "SELECT * FROM shm1.filmcategory_query_categoryname()");
        $resArr = pg_fetch_all($result);
        return $resArr;
    }

    // Имя категории по ее id
    public static function categoryName($pidcat, $link = null)
    {
        $catName = "";
        $result = DataBase::dbQuery($link, "SELECT categoryname FROM shm1.filmcategory WHERE id = $1", array($pidcat));
        if (pg_num_rows($result) > 0) {
            $rowCat = pg_fetch_array($result);
            $catName = $rowCat["categoryname"];
        }
        return $catName;
    }
}

?>