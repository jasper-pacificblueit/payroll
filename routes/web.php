<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/employee', 'EmployeeController@index');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/company', 'CompanyController@index');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/employee/add', 'EmployeeController@create');
});