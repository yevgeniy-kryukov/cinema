<?php 
/**
 * Class for working with the database
 * 
 * @author    Yevgeniy Kryukov <evgkrukov@gmail.com>
 * @copyright 2018 - 2019 Yevgeniy Kryukov
 */

//namespace cinema\util;

/**
 * Class for working with the database
 * 
 */
class DataBase
{
    /**
     * Сonnect to the database
     * 
     * @return $link resource
     */
    public static function dbConnect() 
    {
        $paramsPath = ROOT . '/config/db.php';
        $params = include($paramsPath);
        
        $link = pg_connect(
            "host=" . $params['dbhost']
            ." port=" . $params['dbport']
            ." dbname=" . $params['dbname']
            ." user=" . $params['dbuser']
            ." password=" . $params['dbpass']
        );
        if (!$link) {
            exit("An error occurred while connecting to database\n");
        } else {
            $stat = pg_connection_status($link);
            if ($stat === PGSQL_CONNECTION_BAD) { 
                exit("Database connection lost\n"); 
            }
        }
        return $link;
    }

    /**
     * Execute database query
     * 
     * @param resource   $link  database connection
     * @param string     $squery query text
     * @param array|null $apar   query parameters as an array
     * 
     * @return $result resource
     */
    public static function dbQuery($link, $squery, $apar = null) 
    {
        if ($apar == null) {
            $result = pg_query($link, $squery); 
        } else {
            $result = pg_query_params($link, $squery, $apar);
        }
        if (!$result) {
            exit("Error executing query to database");
        }
        return $result;
    }

}

?>