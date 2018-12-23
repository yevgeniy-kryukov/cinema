<?php 
namespace cinema\util;

/**
 * DataBase
 * 
 */
class DataBase
{
    /**
     * Поключаемся к БД 
     * 
     * @return $link resource
     */
    public static function dbConnect() 
    {
        $link = pg_connect(
            "host=".DBHOST
            ." port=".DBPORT
            ." dbname=".DBNAME
            ." user=".DBUSER
            ." password=".DBPASS
        );
        if (!$link) {
            exit("An error occurred while connecting to PostgreSQL\n");
        } else {
            $stat = pg_connection_status($link);
            if ($stat === PGSQL_CONNECTION_BAD) { 
                exit("PostgreSQL connection lost\n"); 
            }
        }
        return $link;
    }

    /**
     * Выполняем запрос к БД
     * 
     * @param resource   $link1  database connection
     * @param string     $squery query text
     * @param array|null $apar   query parameters as an array
     * 
     * @return $result resource
     */
    public static function dbQuery($link1, $squery, $apar = null) 
    {
        if ($link1 == null) { 
            $link = self::dbConnect(); 
        } else { 
            $link = $link1; 
        }
        if ($apar == null) {
            $result = pg_query($link, $squery); 
        } else {
            $result = pg_query_params($link, $squery, $apar);
        }
        if (!$result) {
            exit("Error executing query to PostgreSQL");
        }
        if ($link1 == null) { 
            pg_close($link); 
        }
        return $result;
    }

}

?>