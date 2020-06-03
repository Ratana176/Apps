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
        return array_reduce(array_keys($post), function($init, $key) use ($post) {
            $init[$key] = Request::sanitize($post[$key]);
            return $init;
        }, []);
    }

    public static function generateInputForError($data = [], $backUrl = '')
    {
        $inputs = array_reduce(array_keys($data), function($init, $key) use($data) {
            $init .= Dom::input(['type' => 'hidden', 'name' => $key, 'value' => $data[$key]]);
            return $init;
        }, '');

        $inputs .= Dom::input(['type' => 'submit', 'value' => 'Go back', 'class' => '']);

        return html_entity_decode(Dom::form(['action' => $backUrl, 'method' => 'POST'], $inputs));
    }

}