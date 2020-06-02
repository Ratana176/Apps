<?php

function autoload ($name) {
    $class = new ${'App\\Core\\'} . $name;
    print_r($class);
}

spl_autoload_register('autoload');