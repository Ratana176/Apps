<?php

use App\Core\Route;

Route::get('/', 'HomeController@index');
Route::get('/1', 'HomeController@index');
Route::get('/4', 'HomeController@index');
Route::get('/3', 'HomeController@index');


/*

    $content ="<p>This is a sample text where {123456} and {7894560} ['These are samples']{145789}</p>";
    preg_match_all('/{(.*?)}/', $content, $matches);
    print_r(array_map('intval',$matches[1]));

*/