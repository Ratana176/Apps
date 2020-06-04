<?php

namespace App\Config;

return [
    'db_dsn' => 'mysql', // value: mysql, pgsql, sqlsrv
    'db_host' => '127.0.0.1',
    'db_user' => 'root',
    'db_name' => '',
    'db_password' => '',
    'db_port' => '3306', // doesn't effect with SQL Server.
    'db_charset' => 'utf8mb4' // only mysql
];