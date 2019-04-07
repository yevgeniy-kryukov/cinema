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

    public static function getTheaterPrice($idTheater)
    {
        $db = DataBase::getConnection();  
        $sql = "SELECT adultprice, childprice FROM shm1.theater WHERE id = :idTheater";

        $result = $db->prepare($sql);
        $result->bindParam(':idTheater', $idTheater, \PDO::PARAM_INT);
        $result->execute();

        return $result->fetch(\PDO::FETCH_ASSOC);
    }

}
