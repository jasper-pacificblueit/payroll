<?php

namespace App\Http\Controllers;

use App\Rate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Deduction;
use App\Employee;
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
    public function update(Request $request, $id)
    {
        $rates = json_decode($request->getContent());
        $emrate = Employee::find($id)->rates;

        $emrate->monthly = (float)implode("", explode(",", $rates->monthly));
        $emrate->holiday = (float)implode("", explode(",", $rates->holiday));
        $emrate->hourly = (float)implode("", explode(",", $rates->hourly));
        $emrate->nightdiff = (float)implode("", explode(",", $rates->nightdiff));
        $emrate->overtime = (float)implode("", explode(",", $rates->ot));
        $emrate->save();

        return json_encode([

            'monthly' => number_format($emrate->monthly, 2),
            'holiday' => number_format($emrate->holiday, 2),
            'hourly' => number_format($emrate->hourly, 2),
            'nightdiff' => number_format($emrate->nightdiff, 2),
            'overtime' => number_format($emrate->overtime, 2),

        ]);
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
