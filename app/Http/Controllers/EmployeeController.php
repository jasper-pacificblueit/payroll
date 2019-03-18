<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use App\User;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee_contents.index')->with([
            'company' => Company::all(),
            'employee' => Employee::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee_contents.add')->with([
            'company' => Company::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'middleName' => 'required',
            'email' => 'required',
            'position' => 'required',
            'phone' => 'required',
            'mobile' => 'required'
        ]);

        $employee = new Employee;

        $employee->firstname = $request->firstName;
        $employee->lastname = $request->lastName;
        $employee->middlename = $request->middleName;
        $employee->email = $request->email;
        $employee->position = $request->position;
        $employee->phone = $request->phone;
        $employee->mobile = $request->mobile;
        $employee->company_id = $request->company;
        $employee->department_id = $request->department;
        $employee->user_id = User::where('email', $request->email)->first()['id'];

        $employee->save();

        return redirect()->route('employee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
