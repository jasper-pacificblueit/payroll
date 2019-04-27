<?php

namespace App\Http\Controllers;

use App;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

use App\Employee;

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

    public function selectDepartment(Request $request){
        
        $data = \App\Department::all()->where('company_id' , '=' , $request->input('q'));
         
       
 
        return view('employee_contents.selectDepartment' , compact('data'));
     }

     public function showEmployee(Request $request){
        
        $data = \App\Employee::all()->where('department_id' , '=' , $request->input('q'));
         
       
 
        return view('employee_contents.EmployeeTable' , compact('data'));
     }

  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee_contents.index')->with([
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

        if (auth()->user()->position == $request->position)
            return redirect()->route('employee.add');

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
        $profile->gender = $request->gender;
        $profile->age = 0;
        $profile->image = json_encode([
            'data' => "/img/landing/avatar_anonymous.png",
            'path' => "/img/landing/avatar_anonymous.png",
        ]);
        
        $profile->lname = $request->lastName;
        $profile->mname = $request->middleName;
        $profile->birthdate = (new Carbon($request->birthdate))->toDateTimeString();
        $profile->user_id = $user->id;

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
                'dtr_read', 'dtr_write',
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
    public function update(Request $request, $id)
    {
        $user = App\User::findOrFail($id);

        // position
        $user->position = $request->position;

        $user->removeRole($user->position);
        $user->revokePermissionTo($user->getAllPermissions());

        $user->assignRole($request->position);

        if ($user->hasRole('hr'))
            $user->syncPermissions([
                'company_read',
                'employee_read', 'employee_write',
                'department_read', 'department_write',
                'dtr_read', 'dtr_write',
            ]);


        // department
        $employee = App\Employee::where('user_id', $id)->first();
        $employee->department_id = $request->chdep;

        if (App\Employee::where('bio_id', '=', $request->bio)->first()) {

            $user->save();
            $employee->save();

            return back()->withErrors([
                'bio_id_conflict' => $request->bio . " is already used!",
            ]);
        }

        $employee->bio_id = $request->bio;

        $user->save();
        $employee->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id) {
        App\User::destroy($id);
    }

    public function viewEmployee(Request $request) {
        return view('sample');
    }

    public function getEmployee(Request $request){
        $data = Employee::with('getProfile')->find($request->input('id'));
        return response()->json($data);
    }
}
