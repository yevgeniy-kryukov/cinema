<?php

class ModelShow extends Model
{

    public static function getShowsAll()
    {
        $db = DataBase::getConnection();  
        $sql = "SELECT sh.id, sh.dateshow, to_char(sh.starttime, 'hh:mm') AS starttime_disp, 
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
        $sql = "SELECT sh.id, sh.dateshow, to_char(sh.starttime, 'hh:mm') AS starttime_disp, 
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
        $sql = "SELECT t2.title AS filmtitle, to_char(t1.starttime,'hh:mm') AS starttime_disp, t3.theatername 
                FROM shm1.show AS t1, shm1.film AS t2, shm1.theater AS t3, shm1.theaterhall AS t4
                WHERE (t1.id = :idShow) AND (t1.film = t2.id) AND (t1.theaterhall = t4.id) AND (t4.theater = t3.id)";
        
        $result = $db->prepare($sql);
        $result->bindParam(':idShow', $idShow, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
    }

}
