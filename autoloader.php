<?php
function autoloadConfig()
{
    $base_dir = __DIR__."/";
    include_once $base_dir . "config/db.php"; 
}

function autoloadCinema($class) 
{
    // project-specific namespace prefix
    $prefix = 'cinema\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__."/";

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        include_once $file;
    }
}

function autoloadVendor($class) 
{
    // project-specific namespace prefix
    $prefix = 'PHPMailer\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__."/vendor/";

    // does the class use the namespace prefix?
        $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        include_once $file;
    }
}

spl_autoload_register("autoloadConfig");
spl_autoload_register("autoloadCinema");
spl_autoload_register("autoloadVendor");
?>