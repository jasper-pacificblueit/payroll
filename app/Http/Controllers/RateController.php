<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Deduction;
class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function deductions(Request $request)
    {
      
        if(isset($request->editDeduction)){
            $editDeduction = $request->editDeduction;
        }
        else{
            $editDeduction = false; 
        
        }
        
        return view('rate_contents.index' , compact('editDeduction'));
    }
    public function addDeductions(Request $request)
    {
       $addDeduction = new Deduction;

       $addDeduction->name = $request->name;
       $addDeduction->type = $request->type;
       $addDeduction->formula_type = $request->formula_type;
       $addDeduction->amount = $request->amount;
       $addDeduction->status = 'Active';
       
       $addDeduction->save();
       
       
       
       return redirect('/deductions');
    }
    
    public function index()
    {
        if(isset($request->editDeduction)){
            $editDeduction = $request->editDeduction;
        }
        else{
            $editDeduction = false;
        
        }
        return view('rate_contents.index' , compact('editDeduction'));
    }

    public function earnings()
    {
        if(isset($request->editDeduction)){
            $editDeduction = $request->editDeduction;
        }
        else{
            $editDeduction = false;
        
        }
        
        return view('rate_contents.index' , compact('editDeduction'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        //
    }
}
