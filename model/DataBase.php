<?php 
namespace Cinema\Model;

require("config.php"); 

class DataBase 
{
    // Поключаемся к БД
    public static function dbConnect() 
    {
        return pg_connect("host=".DBHOST." port=".DBPORT." dbname=".DBNAME." user=".DBUSER." password=".DBPASS);
    }

    // Выполняем запрос к БД
    public static function dbQuery($link1,$squery,$apar = null ) 
    {
        if ($link1 == null) $link = self::dbConnect(); else $link = $link1;
        if ($apar == null) $result = pg_query( $link, $squery ); else $result = pg_query_params( $link, $squery, $apar );
        if ($link1 == null) pg_close($link);
        return $result;
    }

}

?>