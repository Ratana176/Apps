<?php

namespace App\Core;

class Application
{

    public function __construct()
    {
        $this->_set_reporting();
    }

    private function _set_reporting()
    {
        if (DEBUG){
            error_reporting(E_ALL);
        } else {
            error_reporting(0);
        }
    }

    public function registerRoute()
    {
        Route::register();
    }
}