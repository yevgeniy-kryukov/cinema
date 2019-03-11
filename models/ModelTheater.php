<?php

namespace cinema\models;

use cinema\components\DataBase;
use cinema\models\Model;

class ModelTheater extends Model
{

    public static function getListTheaters()
    {
        $db = DataBase::getConnection();  
        $sql = "SELECT * FROM shm1.theater";

        $result = $db->query($sql);

        return $result->fetchAll();
    }

}
