<?php

namespace App\Config;

/*
    To call the class automatically.
*/

spl_autoload_register(function ($name) {
    /*
        \ sign is the namespace seperator
    */
    $class_array = explode('\\', $name);

    /*
        To push the last one from array.
        The last value of the array is the class's name
    */
    $class_name = array_pop($class_array);

    /*
        To concate string to become the relative path of the project.
    */
    $relative_path = strtolower(implode(DS, $class_array));

    /*
        Join relative path with root path to make it easy to include
    */
    $full_path = ROOT . DS . $relative_path . DS . $class_name . '.php';
    
    if (file_exists($full_path)) {
        require_once $full_path;
    } else {
        errorog("The class {$class_name} is not exist!");
    }
});

session_start();

require_once('app.php');
require_once('database.php');
require_once(ROOT . DS . 'app' . DS . 'libs' . DS . 'helper.php');
require_once(ROOT . DS . 'app' . DS . 'route' . DS . 'web.php');