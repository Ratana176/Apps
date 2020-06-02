<?php

define ('DS', DIRECTORY_SEPARATOR);

require_once('app' . DS . 'config' . DS . 'autoload.php');
require_once('app' . DS . 'config' . DS . 'app.php');
require_once('app' . DS . 'config' . DS . 'database.php');

Route::get('/{}', 'HomeController@index');