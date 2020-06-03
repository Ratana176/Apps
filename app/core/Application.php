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
        $data is the array of value to generate input.
        $backUrl the url to return back to the last page.
        $callback let you customize your own function instead.
        $statusCode represent to file of view
    */
    public static function error($data = [], $backUrl = '', $callback = null, $statusCode = 404)
    {
        if ( $callback == null) {
            (new View)->renderError("error.$statusCode", $data, $backUrl);
        } else {
            $callback($statusCode);
        }
    }
}