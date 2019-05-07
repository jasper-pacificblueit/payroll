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

Route::group(['middleware' => ['auth']], function() {

	if (count(App\Company::all()) > 0 && count(App\Department::all()) > 0)
		Route::middleware(['auth'])->group(function() {
			Route::get('view-employee', 'EmployeeController@viewEmployee');
			Route::get('get-employee', 'EmployeeController@getEmployee');
			Route::get('/employee', 'EmployeeController@index')->name('employee');
		});

	if (count(App\Company::all()) > 0 && count(App\Department::all()) > 0)
		Route::middleware(['auth'])->group(function() {
			Route::get('/employee/add', 'EmployeeController@create')->name('addEmployee');
			Route::post('/employee/keep', 'EmployeeController@store');
			Route::post('/employee/{id}', 'EmployeeController@update');
			Route::delete('/employee/{id}', 'EmployeeController@destroy');
			Route::get('/manage/{id}', 'EmployeeController@edit');
		});

	Route::get('/company', 'CompanyController@index');
	Route::post('/company', 'CompanyController@store');
	
	Route::get('/company/{id}', 'CompanyController@show');
	Route::post('/company/{company}/department' , 'DepartmentController@store');
	Route::get('/department/{id}', 'DepartmentController@edit');

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
	Route::get('/payroll/create/payrollDate', 'PayrollController@payrollDate');

	Route::get("/holiday", "PayrollController@holiday");

	Route::get("/rates", "RateController@index");
	Route::get("/deductions", "RateController@deductions");
	Route::get("/earnings", "RateController@earnings");
	Route::post("/addDeductions", "RateController@addDeductions");
	
	Route::resource('/positions', 'PositionsController');

	Route::get('/', 'HomeController@index')->name('dashboard');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

	Route::get("/profile/{user}", "ProfileController@public_index");

	Route::get("/editprofile", "ProfileController@edit")->name('editprofile');
	Route::post("/editprofile", "ProfileController@update");
	
	
  Route::get('/profile', 'ProfileController@index')->name('profile');
  Route::match(['put', 'update'], '/editprofile/chpasswd', 'ProfileController@chpasswd');
  Route::get('/user/misc/status/{id}', 'ProfileController@update_status');

	
	
});



