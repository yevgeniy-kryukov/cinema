<?php


function autoloadApp($class)
{
    $array_paths = array(
        '/components/',
        '/controllers/',
        '/models/',
        '/views/',
    );
    foreach ($array_paths as $path) {
        $path = ROOT . $path . $class . '.php';
        if (is_file($path)) {
            include_once $path;
        }
    }
}

spl_autoload_register('autoloadApp');