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

	if (count(App\Company::all()) > 0 && count(App\Department::all()) > 0 && App\Positions::where('state', '=', '0')->count() > 0) {

		// Employee View
		Route::group(['middleware' => ['permission:employee_View']], function () {
			Route::get('view-employee', 'EmployeeController@viewEmployee');
			Route::get('get-employee', 'EmployeeController@getEmployee');
			Route::get('/employee', 'EmployeeController@index')->name('employee');

			Route::get("/selectDepartment", "EmployeeController@selectDepartment");
			Route::get("/showEmployee", "EmployeeController@showEmployee");
			Route::get('/user/misc/status/{id}', 'ProfileController@update_status');
		});

		// Employee Create
		Route::group(['middleware' => ['permission:employee_Create']], function () {
			Route::get('/employee/add', 'EmployeeController@create')->name('addEmployee');
			Route::post('/employee/keep', 'EmployeeController@store');
		});

		// Employee Modify
		Route::group(['middleware' => ['permission:employee_Modify']], function () {
			Route::get('/manage/{id}', 'EmployeeController@edit');
			Route::post('/employee/{id}', 'EmployeeController@update');
		});

		// Employee Delete
		Route::group(['middleware' => ['permission:employee_Delete']], function () {
			Route::delete('/employee/{id}', 'EmployeeController@destroy');
		});
		
	}

	// Company View
	Route::group(['middleware' => ['permission:company_View']], function () {
		Route::get('/company', 'CompanyController@index');
	});

	// Company Create
	Route::group(['middleware' => ['permission:company_Create']], function () {
		Route::post('/company', 'CompanyController@store');
	});

	// Company Modify
	Route::group(['middleware' => ['permission:company_Modify']], function () {

	});

	// Company Delete
	Route::group(['middleware' => ['permission:company_Delete']], function () {

	});

	
	// Department View
	Route::group(['middleware' => ['permission:department_View']], function () {
		Route::get('/company/{id}', 'CompanyController@show');
	});

	// Department Create
	Route::group(['middleware' => ['permission:department_Create']], function () {
		Route::post('/company/{company}/department' , 'DepartmentController@store');
	});
	
	// Department Modify
	Route::group(['middleware' => ['permission:department_Modify']], function () {
		Route::get('/department/{id}', 'DepartmentController@edit');
	});

	// Department Delete
	Route::group(['middleware' => ['permission:department_Delete']], function () {

	});

	// DTR Create
	Route::group(['middleware' => ['permission:dtr_Create']], function () {
		Route::get('/dtr/create', 'DateTimeRecordController@create');
		Route::post('/dtr/view' , 'DateTimeRecordController@viewFile');
		Route::post('/dtr', 'DateTimeRecordController@store');
	});

	// DTR View
	Route::group(['middleware' => ['permission:dtr_View']], function () {
		Route::get("/selectDate", "DateTimeRecordController@selectDate");
		Route::get('/dtr/{dtr}', "DateTimeRecordController@show");
		Route::get("/dtr-records", "DateTimeRecordController@records");
		Route::get('/dtr', 'DateTimeRecordController@index');
	});

	// DTR Modify
	Route::group(['middleware' => ['permission:dtr_Modify']], function () {
		Route::get("/dtr/{dtr}/edit", "DateTimeRecordController@edit");
		Route::put("/dtr/{dtr}", "DateTimeRecordController@update");
	});

	// DTR Delete
	Route::group(['middleware' => ['permission:dtr_Delete']], function () {
		Route::delete('/dtr/{dtr}', "DateTimeRecordController@destroy");
	});

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

	// public
	Route::get('/', 'HomeController@index')->name('dashboard');
	Route::get("/profile/{user}", "ProfileController@public_index");
	
 	Route::get("/editprofile", "ProfileController@edit")->name('editprofile');
	Route::post("/editprofile", "ProfileController@update");
	Route::get('/profile', 'ProfileController@index')->name('profile');
  Route::match(['put', 'update'], '/editprofile/chpasswd', 'ProfileController@chpasswd');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
});



