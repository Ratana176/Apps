<?php

use App\Core\{Application, Request};

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

function errorView($message, $data = [], $backUrl, $type = 'error')
{
    Application::errorView($message, $data, $backUrl, $type);
}

function method($type)
{
    return (new Request())->method($type);
}