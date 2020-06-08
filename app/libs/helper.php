<?php

use App\Core\{Application, Request, Locale};

function errorLog($message)
{
    print_r($message);
}

function uagentVersion()
{
    $uagent = $_SERVER['HTTP_USER_AGENT'];
    $regx = '/\/[a-zA-Z0-9.]+/';
    $new_uagent = preg_replace($regx, '', $uagent);
    return $new_uagent;
}

function errorView($message, $data = [], $backUrl = [])
{
    Application::errorView($message, $data, $backUrl);
}

function method($type)
{
    return (new Request())->method($type);
}

function dd($message, $die = true)
{
    echo '<pre>';
    print_r($message);
    if ($die) die();
}

function lang($messageVariable)
{
    return Locale::lang($messageVariable);
}

function translate($messageVariable, $format = [])
{
    return Locale::translate($messageVariable, $format);
}