<?php

namespace cinema\models;

use cinema\components\DataBase;
use cinema\models\Model;

class ModelFilm extends Model
{

    public static function getListFilms()
    {
        $db = DataBase::getConnection();  
        $sql = "SELECT film.id, film.title, cat.categoryname, 
                    (CASE WHEN film.playingnow = true THEN 'yes' ELSE 'no' END)  As playingnow_yn
                FROM shm1.film AS film, shm1.filmcategory AS cat
                WHERE film.category = cat.id
                ORDER BY film.playingnow DESC, film.title";

        $result = $db->query($sql);

        return $result->fetchAll();
    }

    public static function getFilmById($id)
    {
        $db = DataBase::getConnection();  
        $sql = "SELECT film.id, film.title, cat.categoryname, 
                    (CASE WHEN film.playingnow = true THEN 'yes' ELSE 'no' END)  As playingnow_yn,
                    film.description, film.length, film.rating, film.ticketssold, film.category
                FROM shm1.film AS film, shm1.filmcategory AS cat
                WHERE film.category = cat.id AND film.id = :id";

        $result = $db->prepare($sql);
        $result->bindParam('id', $id, \PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
    }

    public static function updateFilmById($id, $title, $description, $category, $length, $rating, $playingNow)
    {        
        $db = DataBase::getConnection();
        $sql = 'UPDATE shm1.film 
                SET title = :title, description = :description, category = :category, 
                    length = :length, rating = :rating, playingnow = :playingnow
                WHERE id = :id';
                
        $result = $db->prepare($sql);
        $result->bindParam(':title', $title, \PDO::PARAM_STR);
        $result->bindParam(':description', $description, \PDO::PARAM_STR);
        $result->bindParam(':category', $category, \PDO::PARAM_INT);
        $result->bindParam(':length', $length, \PDO::PARAM_INT);
        $result->bindParam(':rating', $rating, \PDO::PARAM_STR);
        $result->bindParam(':playingnow', $playingNow, \PDO::PARAM_BOOL);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);

        return $result->execute();
    }

    public static function createFilm($title, $description, $category, $length, $rating, $playingNow)
    {        
        $db = DataBase::getConnection();
        $sql = 'INSERT INTO shm1.film (title, description, category, length, rating, playingnow)
                VALUES (:title, :description, :category, :length, :rating, :playingnow)';
                
        $result = $db->prepare($sql);
        $result->bindParam(':title', $title, \PDO::PARAM_STR);
        $result->bindParam(':description', $description, \PDO::PARAM_STR);
        $result->bindParam(':category', $category, \PDO::PARAM_INT);
        $result->bindParam(':length', $length, \PDO::PARAM_INT);
        $result->bindParam(':rating', $rating, \PDO::PARAM_STR);
        $result->bindParam(':playingnow', $playingNow, \PDO::PARAM_BOOL);
        
        if ($result->execute()) {
            return $db->lastInsertId('shm1.film_id_seq');
        }

        return 0;
    }

    public static function getPosterURI($id)
    {
        $config = include(ROOT . '/config/uploads.php');
        $path = $config['posters'];

        $pathToImage = $path . $id . '.jpg';
        if (file_exists(ROOT . $pathToImage)) {
            return $pathToImage;
        }
     
        return $config['no-poster'];
    }

}
