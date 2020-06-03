<?php

namespace App\Core;

class Session
{
    public static function exist($name)
    {
        return isset($_SESSION[$name]);
    }

    public static function get($name)
    {
        return $_SESSION[$name] ?? null;
    }

    public static function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public static function delete($name)
    {
        if (self::exist($name))
        {
            unset($_SESSION[$name]);
        }
    }
}