<?php

use App\Core\Route;

Route::get('/', 'HomeController@index');
Route::get('/1', 'HomeController@index');
Route::get('/4', 'HomeController@index');
Route::get('/3', 'HomeController@index');