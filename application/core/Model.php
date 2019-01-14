<?php

class Model
{
    
    /*
        Модель обычно включает методы выборки данных, это могут быть:
            > методы нативных библиотек pgsql или mysql;
            > методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
            > методы ORM;
            > методы для работы с NoSQL;
            > и др.
    */

/* 	// метод выборки данных
    public function getData($params)
    {
        // todo
    } */

    // Список всех категорий фильмов
    public function categoryList($link = null)
    {
        $resArr = array();
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.filmcategory_query_categoryname()');
        $resArr = pg_fetch_all($result);
        return $resArr;
    }
    
}