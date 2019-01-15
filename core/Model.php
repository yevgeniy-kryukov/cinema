<?php

class Model
{

    // Список всех категорий фильмов
    public function categoryList()
    {
        $resArr = array();
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.filmcategory_query_categoryname()');
        $resArr = pg_fetch_all($result);
        return $resArr;
    }
    
}