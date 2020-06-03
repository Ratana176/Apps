<?php
namespace App\Core;

/**
* Form Helper class
*/
class FormHelper
{
    
    public static function generateToken()
    {
        $token = base64_encode(openssl_random_pseudo_bytes(32));
        Session::set('csrf_token', $token);
        return $token;
    }

    public static function checkToken($token)
    {
        return (Session::exist('csrf_token') && Session::get('csrf_token') == $token);
    }

    public static function tokenInput()
    {
        return Dom::input(['type' => 'hidden', 'id' => 'csrf_token', 'name' => 'csrf_token', 'value' => self::generateToken()]);
    }

    public static function postValue($post)
    {
        return array_reduce(array_keys($post), function($init, $key) use ($post){
            $init[$key] = Input::sanitize($post[$key]);
            return $init;
        }, []);
    }

}