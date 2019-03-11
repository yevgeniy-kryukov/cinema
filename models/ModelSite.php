<?php

namespace cinema\models;

use cinema\components\DataBase;
use cinema\models\Model;

class ModelSite extends Model
{  

    /**
     * Returns list films
     */
    public static function getListFilms($idCat, $rat)
    {
        $db = DataBase::getConnection();  
        $sql = "SELECT t1.id, t1.description, t1.length, t1.rating, t1.title, t2.categoryname
                FROM shm1.film AS t1, shm1.filmcategory AS t2
                WHERE (t1.category = t2.id) AND (t1.playingnow = true)";
        if ($idCat != '*') $sql = $sql . " AND (t1.category = :idCat)";
        if ($rat != '*') $sql = $sql . " AND (t1.rating = :rat)";
        $sql = $sql . " ORDER BY t1.ticketssold DESC";

        $result = $db->prepare($sql);
        if ($idCat != '*') $result->bindParam(':idCat', $idCat, \PDO::PARAM_INT);
        if ($rat != '*') $result->bindParam(':rat', $rat, \PDO::PARAM_STR);
        $result->execute();

        return $result->fetchAll();
    } 

    /**
     * Returns category name by id
     */
    public static function getCategoryNameById($idCat)
    {
        $catName = '';
        
        if ($idCat != '*') {
            $db = DataBase::getConnection();
            $sql = 'SELECT categoryname FROM shm1.filmcategory WHERE id = :idCat';

            $result = $db->prepare($sql);
            $result->bindParam(':idCat', $idCat, \PDO::PARAM_INT);
            $result->execute();

            $catName = $result->fetchColumn();
        }

        return $catName;
    }

}
