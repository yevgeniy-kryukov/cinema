<?php

namespace cinema\models;

use cinema\components\DataBase;
use cinema\models\Model;

class ModelFilmCategory extends Model
{

    /**
     * Returns category list
     */
    public static function categoryList()
    {
        $db = DataBase::getConnection();  
        $sql = 'SELECT * FROM shm1.filmcategory ORDER BY categoryname';

        $result = $db->query($sql);

        return $result->fetchAll();
    }
}