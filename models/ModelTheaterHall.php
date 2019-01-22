<?php

class ModelTheaterHall extends Model
{

    public static function getListTheaterHalls()
    {
        $db = DataBase::getConnection();  
        $sql = 'SELECT the.theatername, hall.id, hall.hall_name, hall.seats_number 
                FROM shm1.theaterhall AS hall, shm1.theater As the
                WHERE hall.theater = the.id
                ORDER BY the.theatername, hall.hall_name';

        $result = $db->query($sql);

        return $result->fetchAll();
    }

}
