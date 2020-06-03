<?php

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

