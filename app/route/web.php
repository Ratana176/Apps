<?php

use App\Core\Route;

Route::get('/', 'HomeController@index');
Route::get('/1', 'HomeController@index');

Route::post('/post', 'HomeController@post');
Route::post('/p', 'HomeController@post');
Route::post('/about', 'HomeController@post');

Route::put('/put', 'HomeController@put');
Route::put('/pt', 'HomeController@put');

Route::delete('/del', 'HomeController@delete');
Route::delete('/d', 'HomeController@delete');


/*

    $content ="<p>This is a sample text where {123456} and {7894560} ['These are samples']{145789}</p>";
    preg_match_all('/{(.*?)}/', $content, $matches);
    print_r(array_map('intval',$matches[1]));

*/