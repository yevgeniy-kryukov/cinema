<?php 

namespace cinema\components;

class Html 
{

    public static function encode($string)
    {
        return htmlspecialchars($string, ENT_QUOTES);
    }

}
?>