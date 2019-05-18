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
            $row = Payroll::orderBy('id' , 'DESC')->count();
           if($row > 0){
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
        $payrollDate = \App\Payroll::orderBy('id' , 'DESC')->first();
        
        if(isset($request->selectDate)){
            $payroll_id = $request->selectDate;
        }
        else{
            $row = Payroll::orderBy('id' , 'DESC')->count();
           if($row > 0){
             $payroll_id = $payrollDate->id;
           }
           else{
             $payroll_id = NULL;
           }
        }
        return view('payroll_contents.index' , compact('payroll_id'));
    }

    public function payrollDate(Request $request){
        $start = $request->start;
        $end = $request->end;
        
        

        return view('payroll_contents.viewPayrollbody' , compact('start' , 'end' ));
     }

     public function checkPayroll(Request $request){
       $payroll_id = $request->payroll_id;

        return view('payroll_contents.historyBody' , compact('payroll_id'));
     }

     

    public function makePayroll(Request $request)
    {

      
        
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
        // dd($request->netpay);

        foreach ($request->employees as $employee) {
                $earnings = [];      
                $deductions = [];
                // $jsonEarnings = json_encode($request->addedItemDeductionAmount[13]);
                
              

                $earnings["basic"] = $request->basic[$employee];
                $earnings["overtime"] = $request->overtime[$employee];
                $earnings["holiday"] = $request->holiday[$employee];
                if(isset($request->addedItemAmount[$employee])){
                    $earnings["additional_earnings"] = $request->addedItemAmount[$employee];
                }
                else{
                    $earnings["additional_earnings"] = NULL;
                }
                

                $deductions["late"] = $request->late[$employee];
                $deductions["undertime"] = $request->undertime[$employee];
                $deductions["statutory"] = $request->statutory[$employee];
              
                if(isset($request->addedItemDeductionAmount[$employee])){
                    $deductions["additional_deductions"] = $request->addedItemDeductionAmount[$employee];
                }
                else{
                    $deductions["additional_deductions"] = NULL;
                }
                $encode_earnings = json_encode($earnings);
                $encode_deductions= json_encode($deductions);
                
                //dd($encode_earnings , $encode_deductions);
                
                $payslip = new \App\Payslips;

                $payslip->employee_id = $employee;
                $payslip->start = date("Y-m-d" , strtotime($request->start));
                $payslip->end = date("Y-m-d" , strtotime($request->end));
                $payslip->earnings = $encode_earnings;
                $payslip->deductions = $encode_deductions;
                $payslip->total_income = $request->total_income[$employee];
                $payslip->total_deduction = $request->total_deduction[$employee];
                $payslip->net_pay = $request->netpay[$employee];
                
                
                $payslip->save();
                

        
        }

        $addPayroll = new \App\Payroll;

        $addPayroll->start = date("Y-m-d" , strtotime($request->start));
        $addPayroll->end = date("Y-m-d" , strtotime($request->end));
        $addPayroll->save();


        return redirect('/payroll');


        // $attendances = \App\DateTimeRecord::all()->where('date', '>=' , date("Y-m-d" , strtotime($request->start)) ,'AND', 'date' , '<=' , date("Y-m-d", strtotime($request->end)));
        

      
        // if(count($attendances) > 0 && count($request->employee)){
        //     $payroll = new Payroll;
        //     $payroll->start = date("Y-m-d", strtotime($request->start));
        //     $payroll->end = date("Y-m-d", strtotime($request->end));
        //     $payroll->save();
        // }
        // else{
        //     $status = 'danger';
        // }
      
        // $payrollDate = \App\Payroll::orderBy('id' , 'DESC')->first();
        
        // if(isset($request->selectDate)){
        //     $payroll_id = $request->selectDate;
        // }
        // else{
        //    if(count($payrollDate) > 0){
        //      $payroll_id = $payrollDate->id;
        //    }
        //    else{
        //      $payroll_id = NULL;
        //    }
        // }
        // return view('payroll_contents.index' ,compact('payroll_id' , 'status'));
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
