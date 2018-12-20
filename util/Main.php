<?php
namespace cinema\util;

class Main 
{
    public static function requestGet($name, $defval = "") 
    {
        return isset($_GET[$name]) ? $_GET[$name] : $defval;
    }

    public static function requestPost($name, $defval = "") 
    {
        return isset($_POST[$name]) ? $_POST[$name] : $defval;
    }

    public static function sessionGet($name, $defval = "") 
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : $defval;
    }

    public static function sessionData($name, $val) 
    {
        $_SESSION[$name] = $val;
    }
    
    public static function requestGetCookie($name, $defval = "") 
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : $defval;
    }
    
    public static function responseSetCookie($name, $val = "", $expires = 0, $path = "") 
    {
        return setcookie($name, $val, $expires, $path);
    }
}

?>