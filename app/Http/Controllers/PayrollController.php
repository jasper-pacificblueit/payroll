<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payroll;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function holiday()
    {
        return view('payroll_contents.index');
    }


    public function index(Request $request)
    {
        $payrollDate = \App\Payroll::orderBy('id' , 'DESC')->first();
        
        if(isset($request->selectDate)){
            $payroll_id = $request->selectDate;
        }
        else{
           if(count($payrollDate) > 0){
             $payroll_id = $payrollDate->id;
           }
           else{
             $payroll_id = NULL;
           }
        }

        return view('payroll_contents.index' , compact('payroll_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    public function makePayroll(Request $request)
    {
        $payroll = new Payroll;
        $payroll->start = date("Y-m-d", strtotime($request->start));
        $payroll->end = date("Y-m-d", strtotime($request->end));
        $payroll->save();
        return redirect('payroll');
    }

    public function viewPayroll(Request $request)
    {
       return view('payroll_contents.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
