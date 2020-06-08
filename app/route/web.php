<?php

use App\Core\Route;

Route::get('/', 'HomeController@index');
Route::get('/home/index', 'HomeController@testLangue');

Route::post('/post', 'homesdsd@post');
Route::post('/', 'HomeController@post');
Route::post('/{about}', 'sddf@post');
Route::post('/about', 'testpost@post');



Route::put('/2', 'HomeController@put2');
Route::put('/1', 'HomeController@put1');
Route::put('/{pt}', 'HomeController@put2');
Route::put('/res/{putfunc}/{putfunc3}', function($test, $v){
    echo 'value: '.$test . ', '.$v;
});

Route::delete('/del', 'HomeController@delete');
Route::delete('/d', 'delete222@delete');
Route::delete('/', 'test@delete');