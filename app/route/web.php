<?php

use App\Core\Route;

Route::get('/', 'HomeController@index');
Route::get('/1', 'HomeController@index');
Route::get('/4', 'HomeController@index');
Route::get('/3', 'HomeController@index');

Route::post('/test', 'HomeController@index');
Route::post('/bkaka', 'HomeController@index');
Route::post('/about', 'HomeController@index');

Route::put('/sdfsdf', 'HomeController@index');
Route::put('/sdddd', 'HomeController@index');

Route::delete('/erer', 'HomeController@index');
Route::delete('/sdf', 'HomeController@index');
Route::delete('/eeee', 'HomeController@index');
Route::delete('/qqqq', 'HomeController@index');
Route::delete('/wwww', 'HomeController@index');


/*

    $content ="<p>This is a sample text where {123456} and {7894560} ['These are samples']{145789}</p>";
    preg_match_all('/{(.*?)}/', $content, $matches);
    print_r(array_map('intval',$matches[1]));

*/