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

}
