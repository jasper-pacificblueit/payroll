<?php

namespace App\Http\Controllers;

use App\Department;
use App\Company;

use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {

        $request->validate([
            'dep' => 'required',
        ], [

            'dep.required' => json_encode([
                'type' => 'error',
                'title' => 'Department name error',
                'body' => 'A department must have a name.',
            ]),

        ]);

        if (Department::where('name', '=', $request->dep)->count() > 0)
            return back()->withErrors(json_encode([

                'type' => 'error',
                'title' => 'Department already exists!',
                'body' => 'A department must have a unique name.',

            ]));

        Department::create([
            'company_id' => $company->id,
            'dep' => ucwords(request('dep'))
        ]);
        
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        return view('company_contents.managedep')->with([
            'dep' => Department::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        //
    }
}
