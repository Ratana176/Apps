<?php

namespace App\Core;

class Application
{
    protected $request;

    public function __construct()
    {
        $this->_set_reporting();
        $this->request = new Request();
    }

    private function _set_reporting()
    {
        if (DEBUG) {
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
        }
    }

    public function registerRoute()
    {
        Route::register($this->request);
    }

    /*
        $message it is a array that need 2 keys (title, data) it will display as content message
        $data is the array of value to generate input.
        $backUrl the url to return back to the last page.
    */
    public static function errorView($message, $data = [], $backUrl = [])
    {
        (new View)->messageRenderView("messages.error", ['title' => $message['title'], 'data' => $message['data']], $data,  $backUrl);
    }

    /*
        $message it is a array that need 2 keys (title, data) it will display as content message
        $data is the array of value to generate input.
        $backUrl the url to return back to the last page.
    */
    public static function infoView($message, $data = [], $backUrl = [])
    {
        (new View)->messageRenderView("messages.info", ['title' => $message['title'], 'data' => $message['data']], $data,  $backUrl);
    }

}