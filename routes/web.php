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

	if (count(App\Company::all()) > 0 && count(App\Department::all()) > 0)
		Route::middleware(['permission:employee_read'])->group(function() {
			Route::get('view-employee', 'EmployeeController@viewEmployee');
			Route::get('get-employee', 'EmployeeController@getEmployee');
			Route::get('/employee', 'EmployeeController@index')->name('employee');
		});

	if (count(App\Company::all()) > 0 && count(App\Department::all()) > 0)
		Route::middleware(['permission:employee_write'])->group(function() {
			Route::get('/employee/add', 'EmployeeController@create')->name('addEmployee');
			Route::post('/employee/keep', 'EmployeeController@store');
			Route::match(['put', 'patch'], '/employee/{id}', 'EmployeeController@update');
			Route::delete('/employee/{id}', 'EmployeeController@destroy');
			Route::get('/manage/{id}', 'EmployeeController@edit');
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
		
		Route::get("/dtr-records", "DateTimeRecordController@records");
		Route::get("/selectDate", "DateTimeRecordController@selectDate");
		
		Route::get("/selectDepartment", "EmployeeController@selectDepartment");
		Route::get("/showEmployee", "EmployeeController@showEmployee");
		Route::get("/employee/add", "EmployeeController@create");
		
		Route::resource('/payroll', 'PayrollController');
		Route::post('/payroll/makePayroll', 'PayrollController@makePayroll');
		Route::post('/viewPayroll', 'PayrollController@viewPayroll');
		
		Route::get("/holiday", "PayrollController@holiday");

		Route::get("/rates", "RateController@index");
		
		Route::resource('/positions', 'PositionsController');
	});

	
	
	
});

Route::middleware(['auth'])->group(function () {

	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

	Route::get("/editprofile", "ProfileController@edit")->name('editprofile');
	Route::post("/editprofile", "ProfileController@update");
	
	Route::get('/', 'HomeController@index')->name('dashboard');

  Route::get('/profile', 'ProfileController@index')->name('profile');
  Route::match(['put', 'update'], '/editprofile/chpasswd', 'ProfileController@chpasswd');

});




