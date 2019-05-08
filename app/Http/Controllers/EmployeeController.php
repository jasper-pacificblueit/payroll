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

    public function selectDepartment(Request $request) {
        $data = App\Department::all()->where('company_id' , '=' , $request->input('q'));
        return view('employee_contents.selectDepartment' , compact('data'));
    }

     public function showEmployee(Request $request) {
        $data = App\Employee::all()->where('department_id' , '=' , $request->input('q'));
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
            'age' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'middleName' => 'required',


            'email' => 'required',
            'position' => 'required',
            'mobile' => 'required',

            'hourly_rate' => 'required',
        ]);

        if (auth()->user()->position_id == $request->position_id)
            return back();

        $user = new App\User;
        $contact = new App\Contact;
        $profile = new App\Profile;
        $employee = new App\Employee;

        $user->user = $request->user;
        $user->email = $request->email;
        $user->position_id = $request->position;
        $user->password = bcrypt($request->pass);
        $user->save();

        $contact->mobile = $request->mobile;
        $contact->address = $request->address;
        $contact->email = $user->email;
        $contact->user_id = $user->id;
        $contact->save();

        $profile->fname = $request->firstName;
        $profile->gender = $request->gender;
        $profile->age = $request->age;
        $profile->image = json_encode([
            'data' => "/img/landing/avatar_anonymous.png",
            'path' => "/img/landing/avatar_anonymous.png",
        ]);
        $profile->lname = $request->lastName;
        $profile->mname = $request->middleName;
        $profile->birthdate = (new Carbon($request->birthdate))->toDateTimeString();
        $profile->user_id = $user->id;
        $profile->save();
            
        if ($user->position_id != 1) {
            $employee->company_id = $request->company;
            $employee->department_id = $request->department;
            $employee->user_id = $user->id;
            $employee->bio_id = $request->bio;
            $employee->save();

            $rates = new App\Rate;

            $rates->employee_id = $employee->id;
            $rates->hourly = $request->hourly_rate;
            $rates->save();
        }

        $perms = [];

        foreach (['department', 'employee', 'company', 'positions'] as $perm)
            foreach (['Create', 'View', 'Modify', 'Delete'] as $op)
                if (request($perm . '_' . $op) == 'true') array_push($perms, $perm . '_' . $op);


        $user->syncPermissions($perms);

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
    public function edit(Request $request, $id)
    {
        return view('employee_contents.manage_employee')->with([
            'user' => App\User::find($id),
        ]);
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
        $json = json_decode($request->getContent());

        $user = App\User::findOrFail($id);
        $em = App\Employee::where('user_id', $id)->first();

        $em->bio_id = ($json->bio == '--' ? 0 : $json->bio);
        $em->department_id = $json->department;

        $user->save();
        $em->save();

        return json_encode($json);
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

    public function getEmployee(Request $request) {
        $data = Employee::with('getProfile')->find($request->input('id'));
        return response()->json($data);
    }

}
