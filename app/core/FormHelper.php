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
        return Dom::input(['type' => 'hidden', 'id' => '@csrf_token', 'name' => '@csrf_token', 'value' => self::generateToken()]);
    }


    public static function postValue($post)
    {
        return array_reduce(array_keys($post), function($init, $key) use ($post) {
            $init[$key] = Request::sanitize($post[$key]);
            return $init;
        }, []);
    }

    /**
     * Generate hidden input for info page and error page.
     * @param array $data the data that need to pass to the page
     * @param array $backUrl the url that need to go back and the title of button
     * @param string $type the type of error or info
     * @return string dom of hidden input and form
     */
    public static function generateHiddenInput($data = [], $backUrl = [], $type = 'info')
    {
        $inputs = array_reduce(array_keys($data), function($init, $key) use($data) {
            $init .= Dom::input(['type' => 'hidden', 'name' => $key, 'value' => $data[$key]]);
            return $init;
        }, '');
        if ($type == 'error')
            $inputs .= Dom::input(['type' => 'hidden', 'name' => '@ErrorPage', 'value' => '1']);
        else
            $inputs .= Dom::input(['type' => 'hidden', 'name' => '@InfoPage', 'value' => '1']);

        $inputs .= Dom::input(['type' => 'submit', 'value' => $backUrl['button_title'], 'class' => 'btn-md']);

        return html_entity_decode(Dom::form(['action' => relativePath($backUrl['url']), 'method' => 'POST'], $inputs));
    }

}