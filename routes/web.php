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

Auth::routes(['except' => 'register']);

// admin routes
Route::group(['middleware' => ['auth', 'role:admin|hr']], function() {

	Route::middleware(['permission:employee_read'])->group(function() {
		Route::get('/employee', 'EmployeeController@index')->name('employee');
	});
	
	Route::middleware(['permission:employee_write'])->group(function() {
		Route::get('/employee/add', 'EmployeeController@create');
		Route::post('/employee/keep', 'EmployeeController@store');
	});

	Route::middleware(['permission:company_read'])->group(function() {
		Route::get('/company', 'CompanyController@index');
	});
	
	Route::middleware(['permission:department_write'])->group(function() {
		Route::get('/company/{id}', 'CompanyController@show');
		Route::post('/company/{company}/department' , 'DepartmentController@store');
	});
	

});

Route::middleware(['auth'])->group(function () {

	Route::resource('/dtr', 'DateTimeRecordController');
	Route::post('/dtr/view' , 'DateTimeRecordController@viewFile');

	Route::get('/', 'HomeController@index');

});









