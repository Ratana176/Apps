<?php

namespace App\Core;

class Locale
{
    private static $_supportLanguage = ['en', 'fr'];

    public static function getLocale()
    {
        if (!Session::exist('@lang')) return FALLBACK_LOCALE;
        return Session::get('@lang');
    }


    public static function setLocale($language)
    {
        if (!in_array($language, self::$_supportLanguage)) return false;
       return Session::set('@lang', $language);
    }


    public static function isLocale($language)
    {
        return self::getLocale() == $language;
    }


    public static function lang($messageLanguage)
    {
        $messages = explode('.', $messageLanguage);
        $file_message = $messages[0];
        $variable_message = $messages[1];
        $message_arr = self::requireMessage($file_message);

        return $message_arr[$variable_message] ?? '';
    }


    private static function requireMessage($file_message)
    {
        $path = ROOT . DS . 'app' . DS . 'lang' . DS . self::getLocale() . DS . $file_message . '.php';

        if (file_exists($path)) {
            return require_once($path);
        }

        return [];
    }


    public static function translate($messageLanguage, $format = [])
    {
        return array_reduce(array_keys($format), function ($init, $key) use($messageLanguage, $format){
            return str_replace(':'. $key, $format[$key], self::lang($messageLanguage));
        });
    }
}