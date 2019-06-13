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

Route::fallback(function () {
	return view('errors.404');
});

Route::middleware(['guest'])->group(function() {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
});

Route::group(['middleware' => ['auth']], function() {

	try {

	if (count(App\Company::all()) > 0 && count(App\Department::all()) > 0 && App\Positions::where('state', '=', '0')->count() > 0) {

		// Employee View
		Route::group(['middleware' => ['permission:employee_View']], function () {
			Route::get('view-employee', 'EmployeeController@viewEmployee');
			Route::get('get-employee', 'EmployeeController@getEmployee');
			Route::get('/employee', 'EmployeeController@index')->name('employee');

			Route::get("/showEmployee", "EmployeeController@showEmployee");
			Route::get('/user/misc/status/{id}', 'ProfileController@update_status');
		});

		// Employee Create
		Route::group(['middleware' => ['permission:employee_Create']], function () {
			Route::get('/employee/add', 'EmployeeController@create')->name('addEmployee');
			Route::post('/employee/keep', 'EmployeeController@store');

			Route::get("/employee/add/schedules/{id}/{type?}/{req_type?}", function ($id, $type = '', $req_type = 'option') {

				switch ($req_type) {
				case 'option':
					return view('schedule_contents.schedules')->with([
						'schedules' => App\Department::find($id)->schedules,
					]);
					break;
				case 'json':
				 return json_encode(App\Schedule::where('department_id', $id)->where('type', $type)->first());
				}
				

			});

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
		Route::put("/company/{id}", "CompanyController@update");
	});

	// Company Delete
	Route::group(['middleware' => ['permission:company_Delete']], function () {
		Route::delete("/company/{id}", "CompanyController@destroy");
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

	if (count(App\Company::all()) > 0 || count(App\Employee::all()) > 0) {
		// DTR create
		Route::group(['middleware' => ['permission:dtr_Create']], function () {
			Route::get('/dtr/create', 'DateTimeRecordController@create');
			Route::post('/dtr', 'DateTimeRecordController@store');
		});

		// DTR View
		Route::group(['middleware' => ['permission:dtr_View']], function () {
			Route::post('/dtr/view' , 'DateTimeRecordController@viewFile');
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

		// Payroll Create
		Route::group(["middleware" => ["permission:payroll_Create"]], function () {
			Route::post('/payroll/makePayroll', 'PayrollController@makePayroll');
			Route::post("/payroll", "PayrollController@store");
		});

		// Payroll View
		Route::group(["middleware" => ["permission:payroll_View"]], function () {
			Route::get('/payroll/create/payrollDate', 'PayrollController@payrollDate');
			Route::get("/payroll/create", "PayrollController@create");
			Route::post('/viewPayroll', 'PayrollController@viewPayroll');
			Route::get("/payroll/{payroll}", "PayrollController@show");
			Route::get("/payroll", "PayrollController@index");
			Route::get("/checkPayroll", "PayrollController@checkPayroll");
			
		});

		// Payroll Delete
		Route::group(["middleware" => ["permission:payroll_Delete"]], function () {
			Route::delete("/payroll/{payroll}", "PayrollController@destroy");
		});
		
		// Payroll Modify
		Route::group(["middleware" => ["permission:payroll_Modify"]], function () {
			Route::get("/payroll/{payroll}/edit", "PayrollController@edit");
			Route::match(["put", "patch"], "/payroll/{payroll}", "PayrollController@update");
		});
	}

	} catch (Exception $e) {};

	// Position Create
	Route::group(["middleware" => ["permission:position_Create"]], function () {
		Route::get("/positions/create", "PositionsController@create");
		Route::post("/positions", "PositionsController@store");
	});

	// Position View
	Route::group(["middleware" => ["permission:position_View"]], function () {
		Route::get("/positions/{position}", "PositionsController@show");
		Route::get("/positions", "PositionsController@index");
	});

	// Position Delete
	Route::group(["middleware" => ["permission:position_Delete"]], function () {
		Route::delete("/positions/{position}", "PositionsController@destroy");
	});

	// Position Modify
	Route::group(["middleware" => ["permission:position_Modify"]], function () {
		Route::get("/positions/{position}/edit", "PositionsController@edit");
		Route::match(["put", "patch"], "/positions/{position}", "PositionsController@update");
	});

	// Rate View
	Route::group(["middleware" => ["permission:rate_View"]], function () {
		Route::get("/rates", "RateController@index");

		Route::get("/rates/employeelist/{type}/{id}", function ($type, $id) {
			return view('rate_contents.employeelist')->with([
				'type' => $type,
				'employees' => App\Employee::where("department_id", "=", $id)->get(),
			]);
		});
	});

	Route::group(["middleware" => ["permission:rate_Modify"]], function () {
		Route::put("/rates/modify/{id}", "RateController@update");
	});

	// Deduction View
	Route::group(["middleware" => ["permission:deduction_View"]], function () {
		Route::get("/deductions", "RateController@deductions");

		Route::get("/rates/employeelist/{type}/{id}", function ($type, $id) {
			return view('rate_contents.employeelist')->with([
				'type' => $type,
				'employees' => App\Employee::where("department_id", "=", $id)->get(),
			]);
		});
	});

	// Deduction Create
	Route::group(["middleware" => ["permission:deduction_Create"]], function () {
		Route::post("/addDeductions", "RateController@addDeductions");
	});

	// Deduction Modify
	Route::group(["middleware" => ["permission:deduction_Modify"]], function () {
		Route::put("/deductions/{id}", "DeductionController@update");
		Route::get("/deductions/modal/{id}", function ($id) {
			return view("rate_contents.deductionsModal")->with([

					'employee' => App\Employee::find($id),

			]);
		});
	});

	// Earning View
	Route::group(["middleware" => ["permission:earning_View"]], function () {
		Route::get("/earnings", "RateController@earnings");
		Route::get("/earnings/modal/{id}", function($id) {

			return view("rate_contents.earningsModal")->with([

				'employee' => App\Employee::find($id),

			]);

		});

	});

	// Earning Modify Create
	Route::group(["middleware" => ["permission:earning_Create", "permission:earning_Modify"]], function () {
		Route::post("/earnings/{id}", function ($id) {

			$earnings = App\Employee::find($id)->earnings;
			$json = json_decode(request()->getContent());

			$earnings->status = $json->status;
			$earnings->earnings = json_encode($json->earnings);
			$earnings->save();

			return json_encode($json);
		});
	});

	Route::group(["middleware" => ["permission:schedule_View"]], function () {
		Route::get("/schedules", "ScheduleController@index");
		Route::view("/schedules/data", "schedule_contents.data");
	});

	Route::group(["middleware" => ["permission:schedule_Modify"]], function () {
		Route::put("/schedules/{id}", "ScheduleController@update");
	});

	Route::group(["middleware" => ["permission:schedule_Delete"]], function () {
		Route::delete("/schedules/{id}", "ScheduleController@destroy");
	});

	Route::group(["middleware" => ["permission:schedule_Create"]], function () {
		Route::post("/schedules", "ScheduleController@store");
	});

	Route::get("/selectDepartment", "EmployeeController@selectDepartment");
	Route::post("/settings/app/{id}", "SettingsController@update");
	Route::get("/settings/app", "SettingsController@index");
	Route::get("/settings/user", "SettingsController@index");
	Route::post("/settings/app/reset", "SettingsController@reset");
	
	// public
	Route::get('/', 'HomeController@index')->name('dashboard');
	Route::get("/profile/{user}", "ProfileController@public_index");
 	Route::get("/editprofile", "ProfileController@edit")->name('editprofile');
	Route::post("/editprofile", "ProfileController@update");
	Route::get('/profile', 'ProfileController@index')->name('profile');
  Route::match(['put', 'update'], '/editprofile/chpasswd', 'ProfileController@chpasswd');
	Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


	Route::get("/getServerTime", function () {
		return json_encode([
			"carbon" => new Carbon\Carbon(),
			"timestamp" => strtotime((new DateTime())->format("Y-m-d H:i:s")),
		]);
	});

});

