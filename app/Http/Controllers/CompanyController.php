<?php

namespace App\Http\Controllers;

use App\Company;
use App\Department;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::orderBy('id' , 'asc') -> paginate(5);

        return view('company_contents.index' , compact('companies'));
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
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'address' => 'required',
        ], [
            'name.required' => json_encode([
                'type' => 'warning',
                'title' => 'Company name error',
                'body' => 'A company must have a valid (non-empty) name.',
            ]),
            'address.required' => json_encode([
                'type' => 'warning',
                'title' => 'Company address error',
                'body' => 'A company must have a valid location (non-empty address).',
            ]),

        ]);

        if (Company::where("name", '=', $request->name)->count() > 0)
            return back()->withErrors(json_encode([

                'type' => 'error',
                'title' => 'Company already exists!',
                'body' => 'A company must have a unique name.',

            ]));

        $company = new Company();
        $company->name = request('name');
        $company->address = request('address');
        $company->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return view('company_contents.show' , compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $req = json_decode($request->getContent());

        $company = Company::find($id);

        $company->name = $req->name == "" ? $company->name : $req->name;
        $company->address = $req->address == "" ? $company->address : $req->address;
        $company->save();

        return json_encode($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if ($company->employees->count() > 0) return back()->withErrors(json_encode([

            'type' => 'error',
            'title' => 'Deletion unsuccessful!',
            'body' => 'Cannot delete a company, having an employees!',
            
        ]));

        Company::destroy($company->id);
        return redirect("/company")->with([]);
    }
}
