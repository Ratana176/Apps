<?php

namespace App\Core;

class Route
{
    private static $requests = [];

    public static function register()
    {
        $url = $_SERVER['PATH_INFO'] ?? '/';

        print_r($url);
    }

    public static function get($url , $callback) 
    {
        self::$requests[$url] = $callback;
    }

}