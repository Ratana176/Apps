<?php

use App\Core\Application;

define ('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once('app' . DS . 'config' . DS . 'autoload.php');

$app = new Application();
$app->registerRoute();