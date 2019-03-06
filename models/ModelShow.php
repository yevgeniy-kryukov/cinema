<?php

class ModelShow extends Model
{

    public static function getShowsAll()
    {
        $db = DataBase::getConnection();  
        $sql = "SELECT sh.id, sh.dateshow, to_char(sh.starttime, 'HH24:MI') AS starttime_disp, 
                    th.theatername, hl.hall_name, fm.title AS film_title
                FROM shm1.show AS sh, shm1.theaterhall AS hl, shm1.theater AS th, shm1.film AS fm
                WHERE (sh.theaterhall = hl.id) AND (hl.theater = th.id) AND (sh.film = fm.id)
                    AND (fm.playingnow = true)
                ORDER BY th.theatername, hl.hall_name, sh.dateshow DESC, sh.starttime DESC";

        $result = $db->query($sql);

        return $result->fetchAll();
    }

    public static function getShowsByFilmId($idFilm)
    {
        $db = DataBase::getConnection();  
        $sql = "SELECT sh.id, sh.dateshow, to_char(sh.starttime, 'HH24:MI') AS starttime_disp, 
                    th.theatername, hl.hall_name
                FROM shm1.show AS sh, shm1.theaterhall AS hl, shm1.theater AS th, shm1.film AS fm
                WHERE (sh.theaterhall = hl.id) AND (hl.theater = th.id)  AND (sh.film = fm.id)
                    AND (fm.playingnow = true) AND (dateshow >= current_date) AND (sh.film = :idFilm)
                ORDER BY th.theatername, hl.hall_name, sh.dateshow DESC, sh.starttime, sh.id";

        $result = $db->prepare($sql);
        $result->bindParam(':idFilm', $idFilm, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll();
    }

    public static function getTitleByFilmId($idFilm)
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

    public static function getShowData($idShow)
    {
        $db = DataBase::getConnection();
        $sql = "SELECT t1.id, t2.title AS filmtitle, to_char(t1.starttime,'HH24:MI') AS starttime_disp, t3.theatername,
                     t1.dateshow, t1.adultprice, t1.childprice, t4.hall_name, t4.id AS hallid, t2.id AS filmid
                FROM shm1.show AS t1, shm1.film AS t2, shm1.theater AS t3, shm1.theaterhall AS t4
                WHERE (t1.id = :idShow) AND (t1.film = t2.id) AND (t1.theaterhall = t4.id) AND (t4.theater = t3.id)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':idShow', $idShow, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
    }

    public static function updateShow($id, $film, $starttime, $dateshow, $theaterhall, $adultprice, $childprice)
    {        
        $db = DataBase::getConnection();
        $sql = "UPDATE shm1.show 
                SET film = :film, starttime = :starttime::time, dateshow = TO_DATE(:dateshow, 'yyyy-mm-dd'), 
                    theaterhall = :theaterhall, adultprice = :adultprice, childprice = :childprice
                WHERE id = :id";
                
        $result = $db->prepare($sql);
        $result->bindParam(':film', $film, PDO::PARAM_INT);
        $result->bindParam(':starttime', $starttime, PDO::PARAM_STR);
        $result->bindParam(':dateshow', $dateshow, PDO::PARAM_STR);
        $result->bindParam(':theaterhall', $theaterhall, PDO::PARAM_INT);
        $result->bindParam(':adultprice', $adultprice, PDO::PARAM_STR);
        $result->bindParam(':childprice', $childprice, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }

    public static function createShow($film, $starttime, $dateshow, $theaterhall, $adultprice, $childprice)
    {        
        $db = DataBase::getConnection();
        $sql = 'INSERT INTO shm1.show (film, starttime, dateshow, theaterhall, adultprice, childprice)
                VALUES (:film, :starttime, :dateshow, :theaterhall, :adultprice, :childprice)';
                
        $result = $db->prepare($sql);
        $result->bindParam(':film', $film, PDO::PARAM_INT);
        $result->bindParam(':starttime', $starttime, PDO::PARAM_STR);
        $result->bindParam(':dateshow', $dateshow, PDO::PARAM_STR);
        $result->bindParam(':theaterhall', $theaterhall, PDO::PARAM_INT);
        $result->bindParam(':adultprice', $adultprice, PDO::PARAM_STR);
        $result->bindParam(':childprice', $childprice, PDO::PARAM_STR);
        
        return $result->execute();
    }

}
