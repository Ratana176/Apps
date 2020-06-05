<?php

use App\Core\Route;

Route::get('/', 'HomeController@index');
Route::get('/{test}/value', 'HomeController@testValue');
Route::get('/rest', 'getHomeController@rest');
Route::get('/{rest}', 'dynamic@rest');

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


/*

    $content ="<p>This is a sample text where {123456} and {7894560} ['These are samples']{145789}</p>";
    preg_match_all('/{(.*?)}/', $content, $matches);
    print_r(array_map('intval',$matches[1]));

*/