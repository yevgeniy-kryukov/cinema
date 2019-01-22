<?php

class ModelFilm extends Model
{

    public static function getListFilms()
    {
        $db = DataBase::getConnection();  
        $sql = "SELECT film.id, film.title, cat.categoryname, 
                    (CASE WHEN film.playingnow = true THEN 'yes' ELSE 'no' END)  As playingnow_yn
                FROM shm1.film AS film, shm1.filmcategory AS cat
                WHERE film.category = cat.id
                ORDER BY film.playingnow DESC";

        $result = $db->query($sql);

        return $result->fetchAll();
    }

}
