<?php

namespace App\Http\Controllers;

use App;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

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
            'company' => App\Company::all(),
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
            'company' => App\Company::all(),
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
            'user' => 'required',
            'pass' => 'required',
            'address' => 'required',
            'birthdate' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'middleName' => 'required',
            'email' => 'required',
            'position' => 'required',
            'phone' => 'required',
            'mobile' => 'required'
        ]);

        $user = new App\User;
        $contact = new App\Contact;
        $profile = new App\Profile;
        $employee = new App\Employee;

        $user->user = $request->user;
        $user->email = $request->email;
        $user->position = $request->position;
        $user->password = bcrypt($request->pass);

        $user->save();

        $contact->phone = $request->phone;
        $contact->mobile = $request->mobile;
        $contact->address = $request->address;
        $contact->email = $user->email;
        $contact->user_id = $user->id;

        $contact->save();

        $profile->fname = $request->firstName;
        $profile->age = 0;
        $profile->image = "";
        $profile->lname = $request->lastName;
        $profile->mname = $request->middleName;
        $profile->birtdate = $request->birthdate;
        $profile->user_id = $user->id;
        $profile->email = $user->email;

        $profile->save();

        if ($user->position != 'admin') {
            $employee->company_id = $request->company;
            $employee->department_id = $request->department;
            $employee->user_id = $user->id;
            $employee->save();
        }

        // Add role and permissions
        $user->assignRole($user->position);

        if ($user->position == 'admin') {
            $user->syncPermissions(Permission::all());
        } else if ($user->position == 'hr')
            $user->syncPermissions([
                'company_read',
                'employee_read', 'employee_write',
                'department_read', 'department_write',
            ]);

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
