<?php

namespace App\Config;


// mysql, mariadb

return [
    'db_dsn' => 'mysql',
    'db_host' => '127.0.0.1',
    'db_user' => 'root',
    'db_name' => 'apps',
    'db_password' => '',
    'db_port' => '3306',
    'db_charset' => 'utf8mb4'
];



// Postgres
/*
return [
    'db_dsn' => 'pgsql',
    'db_host' => '127.0.0.1',
    'db_user' => 'root',
    'db_name' => 'apps',
    'db_password' => '',
    'db_port' => '5432'
];
*/


// SQL Server
/*
return [
    'db_dsn' => 'sqlsrv',
    'db_host' => '127.0.0.1',
    'db_user' => 'root',
    'db_name' => 'apps',
    'db_password' => '',
];
*/