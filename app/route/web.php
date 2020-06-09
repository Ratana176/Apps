<?php

use App\Core\Route;

Route::get('/', 'CompanyController@index');
Route::post('/', 'CompanyController@index');

Route::get('/company', 'CompanyController@index');
Route::get('/company/create', 'CompanyController@create');
Route::get('/company/{id}/edit', 'CompanyController@edit');
Route::get('/company/{id}/delete', 'CompanyController@destroy');

/**
 * from error page
 */
Route::post('/company/{id}/edit', 'CompanyController@edit');
Route::post('/company', 'CompanyController@index');
Route::post('/company/create', 'CompanyController@create');

Route::put('/company/{id}', 'CompanyController@edit');




Route::get('/employee', 'EmployeeController@index');
Route::get('/employee/create', 'EmployeeController@create');
Route::get('/employee/{id}/edit', 'EmployeeController@edit');
Route::get('/employee/{id}', 'EmployeeController@destroy');

/**
 * from error page
 */
Route::post('/employee/create', 'CompanyController@create');
Route::post('/employee', 'EmployeeController@index');
Route::post('/employee/{id}/edit', 'EmployeeController@edit');

Route::put('/employee/{id}', 'EmployeeController@edit');