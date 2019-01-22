<?php

class ModelShow extends Model
{

    /**
     * Returns film shows by film id 
     */
    public static function showTimes($idFilm)
    {
        $db = DataBase::getConnection();  
        $sql = "SELECT id, to_char(starttime,'hh:mm') AS starttime_disp, 
                    (SELECT theatername FROM shm1.theater WHERE id = t1.theater) AS theatername
                FROM shm1.show AS t1
                WHERE film = :idFilm
                ORDER BY starttime, theater";

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
