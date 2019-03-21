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

// admin routes
Route::group(['middleware' => ['auth', 'role:admin|hr']], function() {

	Route::get('/employee', 'EmployeeController@index')->name('employee');
	

	Route::get('/employee/add', 'EmployeeController@create');
	Route::post('/employee/keep', 'EmployeeController@store');

	Route::resource('company', 'CompanyController');

	Route::resource('dtr', 'DateTimeRecordController');
	Route::post('dtr/view' , 'DateTimeRecordController@viewFile');


	Route::post('/company/{company}/department' , 'DepartmentController@store');


	Route::view('/profile', 'employee_contents.profile');

});

Route::middleware(['auth'])->group(function () {

	Route::get('/', 'HomeController@index');

});







