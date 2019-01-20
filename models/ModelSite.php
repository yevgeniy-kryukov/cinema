<?php

class ModelSite extends Model
{  

    /**
     * Returns list films
     */
    public static function getListFilms($idCat, $rat)
    {
        $db = DataBase::getConnection();  
        $sql = 'SELECT * FROM shm1.film_query_films(:idCat, :rat)';

        $result = $db->prepare($sql);
        $result->bindParam(':idCat', $idCat, PDO::PARAM_INT);
        $result->bindParam(':rat', $rat, PDO::PARAM_STR);
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
            $result->bindParam(':idCat', $idCat, PDO::PARAM_INT);
            $result->execute();

            $catName = $result->fetchColumn();
        }

        return $catName;
    }

}
