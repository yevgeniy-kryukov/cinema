<?php

class ModelSite extends Model
{   
    // Топ фильмов по продажам, с фильтром по категории и рейтингу
    public function topFilms($pidcat, $prat)
    {
        $resArr = array();
        $link = DataBase::dbConnect();
        $result = DataBase::dbQuery($link, 'SELECT * FROM shm1.film_query_top_films($1, $2)', array($pidcat, $prat));
        if (pg_num_rows($result) > 0) {
            $resArr = pg_fetch_all($result);
        }
        return $resArr;
    }

    // Имя категории по ее id
    public function categoryName($pidcat)
    {
        $catName = '';
        if ($pidcat != '*') {
            $link = DataBase::dbConnect();
            $result = DataBase::dbQuery($link, 'SELECT categoryname FROM shm1.filmcategory WHERE id = $1', array($pidcat));
            if (pg_num_rows($result) > 0) {
                $rowCat = pg_fetch_array($result);
                $catName = $rowCat['categoryname'];
            }
        }
        return $catName;
    }

}
