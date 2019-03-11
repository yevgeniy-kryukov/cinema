<?php

namespace cinema\models;

class Model
{
    
    public static function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer 
        // with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public static function validateTime($time, $format = 'H:i')
    {
        $t = DateTime::createFromFormat($format, $time);
        return $t && $t->format($format) === $time;
    }
}