<?php
class UtilsMain 
{
    public static function request_get($name,$defval="") {
        return isset($_GET[$name]) ? $_GET[$name] : $defval;
    }
    public static function request_post($name,$defval="") {
        return isset($_POST[$name]) ? $_POST[$name] : $defval;
    }
    public static function session_get($name,$defval="") {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : $defval;
    }
    public static function session_data($name,$val) {
        $_SESSION[$name] = $val;
    }
    public static function request_get_cookie($name,$defval="") {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : $defval;
    }
    public static function response_set_cookie($name,$val="",$expires=0,$path="") {
        return setcookie($name,$val,$expires,$path);
    }
}

?>