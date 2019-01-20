<?php

class ModelShow extends Model
{

    /**
     * Returns film shows by film id 
     */
    public static function showTimes($idFilm)
    {
        $db = DataBase::getConnection();  
        $sql = 'SELECT * FROM shm1.show_query_showtimes(:idFilm)';

        $result = $db->prepare($sql);
        $result->bindParam(':idFilm', $idFilm, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll();
    }

    /**
     * Returns name film by id
     */
    public static function titleFilm($idFilm)
    {
        $title = '';
        
        $db = DataBase::getConnection();
        $sql = 'SELECT title FROM shm1.film WHERE id = :idFilm';

        $result = $db->prepare($sql);
        $result->bindParam(':idFilm', $idFilm, PDO::PARAM_INT);
        $result->execute();

        $title = $result->fetchColumn();

        return $title;
    }

}
