<?php

function autoloadApp($class) 
{
    $prefix = 'cinema\\';
    $base_dir = ROOT . '/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        include_once $file;
    }
}

spl_autoload_register('autoloadApp');