<?php 
require("config.php"); 

class DataBase 
{

    public static function db_connect() {
        return pg_connect("host=".DBHOST." port=".DBPORT." dbname=".DBNAME." user=".DBUSER." password=".DBPASS);
    }


    public static function db_query($link1,$squery,$apar = null ) {
        if ($link1 == null) $link = self::db_connect(); else $link = $link1;
        if ($apar == null) $result = pg_query( $link, $squery ); else $result = pg_query_params( $link, $squery, $apar );
        if ($link1 == null) pg_close($link);
        return $result;
    }

}

?>