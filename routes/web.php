<?php

/*
|--------------------------------------------------------------------------
| () Web Routes
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

	Route::get('/employee', 'EmployeeController@index')->name('employee');
	
	Route::get('/employee/add', 'EmployeeController@create');
	Route::post('/employee/keep', 'EmployeeController@store');

	Route::resource('company', 'CompanyController');


	Route::resource('dtr', 'DateTimeRecordController');
	Route::post('dtr/view' , 'DateTimeRecordController@records');


	Route::post('/company/{company}/department' , 'DepartmentController@store');



	Route::view('/profile', 'employee_contents.profile');
});







