<?php 
/**
 * Class for working with the database
 * 
 * @author    Yevgeniy Kryukov <evgkrukov@gmail.com>
 * @copyright 2018 - 2019 Yevgeniy Kryukov
 */

class DataBase
{


    /**
     * Connects to database and returns PDO object
     */
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/db.php';
        $params = include($paramsPath);
      
        $dsn = "pgsql:host={$params['dbhost']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['dbuser'], $params['dbpass']);

        $db->exec("set names utf8");

        return $db;
    }

}

?>