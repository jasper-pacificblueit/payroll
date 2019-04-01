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

Route::middleware(['guest'])->group(function() {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
});

// admin routes
Route::group(['middleware' => ['auth', 'role:admin|hr']], function() {

	Route::middleware(['permission:employee_read'])->group(function() {
		Route::get('/employee', 'EmployeeController@index')->name('employee');
	});
	
	Route::middleware(['permission:employee_write'])->group(function() {
		Route::get('/employee/add', 'EmployeeController@create')->name('employee.add');
		Route::post('/employee/keep', 'EmployeeController@store');
		Route::match(['put', 'patch'], '/employee/{id}', 'EmployeeController@update');
	});

	Route::middleware(['permission:company_read'])->group(function() {
		Route::get('/company', 'CompanyController@index');
	});

	Route::middleware(['permission:company_write'])->group(function() {
		Route::post('/company', 'CompanyController@store');
	});
	
	Route::middleware(['permission:department_write'])->group(function() {
		Route::get('/company/{id}', 'CompanyController@show');
		Route::post('/company/{company}/department' , 'DepartmentController@store');
	});

	Route::middleware(['permission:dtr_read|dtr_write'])->group(function() {
		Route::resource('/dtr', 'DateTimeRecordController');
		Route::post('/dtr/view' , 'DateTimeRecordController@viewFile');
<<<<<<< HEAD
		Route::get("/dtr-records", "DateTimeRecordController@records");
=======
		Route::get('/dtr-records' , 'DateTimeRecordController@records');
>>>>>>> f900b4dc08cc533532d5b11376f1ac33b564a733
	});
	
});

Route::middleware(['auth'])->group(function () {

	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

	Route::get("/editprofile", "ProfileController@edit");
	Route::post("/editprofile", "ProfileController@update");
<<<<<<< HEAD
	
	Route::get('/', 'HomeController@index');
	Route::get('/', 'HomeController@index')->name('dashboard');
	
	Route::get('/', 'HomeController@index')->name('dashboard');
	
});



=======
	
	Route::get('/', 'HomeController@index')->name('dashboard');
>>>>>>> f900b4dc08cc533532d5b11376f1ac33b564a733

  Route::view('/profile', 'employee_contents.profile')->name('profile');

});




