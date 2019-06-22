@php( $employees = \App\Employee::all()->where("department_id", "=", $dep))
<?php
$startDate = date("Y-m-d" , strtotime($start));
$endDate = date("Y-m-d" , strtotime($end));
?>

@foreach ($employees as $employee)
    <?php
        $EmployeeRate = App\Rate::getHourlyRate($employee->id);
        $EmployeeOvertime = $employee->rates->overtime;
        $EmployeeHoliday = $employee->rates->holiday;
        
        
        $EmployeeTotalHours = App\DateTimeRecord::getTotalHours($startDate , $endDate , $employee->user_id);
    
        
        $EmployeeTotalLate = App\DateTimeRecord::getTotalLate($employee->schedule , $startDate , $endDate , $employee->user_id);
        $EmployeeTotalOvertime = App\DateTimeRecord::getOvertime($employee->schedule , $startDate , $endDate , $employee->user_id);
        $EmployeeTotalUndertime = App\DateTimeRecord::getTotalUndertime($startDate , $endDate , $employee->user_id);
        
        //Deductions
        // $EmployeeDeductions = App\Rate::getDeductions($employee->id);
        // $DeductionsRates = json_decode($EmployeeDeductions); 
        $EmployeeLate = $employee->deductions->late;
        $EmployeeUndertime = $employee->deductions->undertime;
        
        $EmployeeDeductions = $employee->deductions->deductions;
        $DeductionsRates = json_decode($EmployeeDeductions);
        $EmployeeLateDeductions = App\Payroll::CalculateLate($EmployeeTotalLate , $EmployeeLate);        
        $EmployeeUndertimeDeductions = App\Payroll::CalculateUndertime($EmployeeTotalUndertime , $EmployeeUndertime);        
        
        //Earnings
        $Basic = App\Payroll::getBasic($EmployeeRate , $EmployeeTotalHours);
        $Overtime = App\Payroll::getOvertime($EmployeeOvertime , $EmployeeTotalOvertime);
        $Holiday = 0;


        $TotalEarnings = App\Payroll::getEarnings($Basic , $Overtime , $Holiday);
        


        $TotalDeductions = App\Payroll::getDeductions($DeductionsRates , $EmployeeLateDeductions , $EmployeeUndertimeDeductions);
        $NetPay =  App\Payroll::NetPay($TotalEarnings , $TotalDeductions);
     ?>
    
    @php( $attendances = \App\DateTimeRecord::where('user_id' , $employee->user_id)->whereBetween('date' , [$startDate , $endDate])->get())
    <tr>

        <td>{{ $employee->bio_id ? $employee->bio_id : $employee->user_id + 1000 }}</td>
        <td>{{ App\Profile::getFullName($employee->user_id) }} <input type="text" name="employees[]" value="{{$employee->id}}" hidden></td>
       
        <td><span id="TotalIncomeDispOut-{{$employee->user_id}}"> ₱ {{number_format($TotalEarnings , 2)}} </span></td>
        <td><span id="TotalDeductionDispOut-{{$employee->user_id}}"> ₱ {{number_format($TotalDeductions , 2)}} </span></td>
        <td><span id="TotalNetPayDispOut-{{$employee->user_id}}"> ₱ {{number_format($NetPay , 2)}} </span></td>
        <td id="excludedcolumn">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details-{{$employee->user_id}}">Details</button>


            <div class="modal inmodal fade" id="details-{{$employee->user_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div class="modal-header" style="padding: 10px">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            </div>
                            <div class="modal-body">
                               <div class="row">
                                   <h4 style="margin-left: 11px">Information</h4>
                                   <br>
                                   <div class="col-lg-4">
                                        <span>Employee : <label>{{App\Profile::getFullName($employee->user_id)}}</label></span>
                                   </div>
                                   <div class="col-lg-4">
                                        <span>Department : {{$employee->getDepartment->name}}</span>
                                   </div>
                                   <div class="col-lg-4">
                                        <span>Position : {{$employee->user->position()->title}}</span>
                                   </div>
                                   
                               </div>
                               
                               <hr>
                               <div class="row">
                                
                                   <div class="col-lg-3">
                                        <span>Hourly : ₱ {{number_format($EmployeeRate , 2)}}</span>
                                   </div>
                                   <div class="col-lg-3">
                                        <span>Overtime : ₱ {{number_format($EmployeeOvertime , 2)}}</span>
                                   </div>
                                   <div class="col-lg-3">
                                        <span>Holiday : ₱ {{number_format($EmployeeHoliday , 2)}}</span>
                                   </div>
                                   <div class="col-lg-3">
                                        <span>L\U : ₱ {{number_format($EmployeeLate , 2)}} \ {{number_format($EmployeeUndertime , 2)}}</span>
                                   </div>
                                  
                                 
                                   
                               </div>
                               <hr>
                               <div class="row">
                                 
                                   <div class="col-lg-6">
                                        <h4>Income</h4>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="list-group" id="ulIncome">
                                                    
                                                    <span id="DisplayIncome-{{$employee->user_id}}">
                                                        <li class="list-group-item">
                                                            <span>Basic</span>
                                                            <span class="pull-right"> ₱ {{number_format($Basic , 2)}} <input class="IncomeClass-{{$employee->id}}" type="text" value="{{round($Basic , 2)}}" hidden name="basic[{{$employee->id}}]"></span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span>Overtime</span>
                                                            <span class="pull-right"> ₱ {{number_format($Overtime , 2)}} <input class="IncomeClass-{{$employee->id}}" type="text" value="{{round($Overtime , 2)}}" hidden name="overtime[{{$employee->id}}]"></span>
                                                                
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span>Holiday</span>
                                                            <span class="pull-right"> ₱ {{number_format($employee->rates->holiday, 2)}} <input class="IncomeClass-{{$employee->id}}" type="text" value="{{round($employee->rates->holiday, 2)}}" hidden name="holiday[{{$employee->id}}]"></span>
                                                        </li>
                                                    
                                                    
                                                    </span>
                                                    <span id='income-{{$employee->id}}'>
                                                    </span>
                                                
                                                {{-- <div id="addIncomeItem">
                                                    <li class="list-group-item" >
                                                        <input type="text" id="description" style="border:0;border-bottom:solid 1px #CCC;outline:none;background:transparent" placeholder="Description..">
                                                        <span class="pull-right">₱ <input id='amount' type="text" style="border:0;border-bottom:solid 1px #CCC;outline:none;background:transparent" placeholder="Amount.."></span>
                                                    </li>
                                                </div> --}}
                                                <li class="list-group-item">
                                                <span><input type="button" class="btn btn-default btn-xs" onclick="addIncome({{$employee->id}})" id="addIncomeBtn-{{ $employee->id }}" value="Add Income"></span>
                                                    <span class="pull-right"></span>
                                                </li>
                                                <li class="list-group-item">
                                                        <strong style="color:green">Total Income</strong>
                                                        <span class="pull-right" id="TotalIncomeDisp-{{$employee->id}}"> ₱ {{number_format($TotalEarnings , 2)}} </span><span><input type="text" id="TotalIncome-{{$employee->id}}" value="{{$TotalEarnings}}" style="border:0; background:transparent;text-align:right;" hidden name="total_income[{{$employee->id}}]"></span>
                                                </li>
                                               
                                            </ul>
                                            </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <h4>Deductions</h4>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <ul class="list-group">
                                                    <span id="DisplayDeduction-{{$employee->id}}">
                                                     <li class="list-group-item">
                                                        <span>Late</span>
                                                        <span class="pull-right"> ₱ {{$EmployeeLateDeductions}}  <input class="DeductionClass-{{$employee->id}}" type="text" value="{{$EmployeeLateDeductions}}" hidden name="late[{{$employee->id}}]"></span>
                                                     </li>
                                                     <li class="list-group-item">
                                                        <span>Undertime</span>
                                                        <span class="pull-right"> ₱ {{number_format($EmployeeUndertimeDeductions , 2)}} <input class="DeductionClass-{{$employee->id}}" type="text" value="0" hidden name="undertime[{{$employee->id}}]"></span>
                                                     </li>

                                                    @foreach ($DeductionsRates->statutory as $name => $deductions)
                                                        <li class="list-group-item">
                                                            <span>{{$name}}</span>
                                                            <span class="pull-right"> ₱ {{$deductions}} </span>
                                                        </li>
                                                        <input class="DeductionClass-{{$employee->id}}" type="text" value="{{round($deductions , 2)}}" hidden name="statutory[{{$employee->id}}][{{$name}}]">
                                                    @endforeach
                                                    

                                                    </span>
                                                    <span id="deduction-{{$employee->id}}">

                                                    </span>
                                                    <li class="list-group-item">
                                                        <input type="button" class="btn btn-default btn-xs" onclick="addDeduction({{$employee->id}})" id="addDeductionBtn-{{ $employee->id }}" value="Add Deductions"></span>
                                                        <span class="pull-right"></span>
                                                    </li>
                                                

                                                    <li class="list-group-item">
                                                            <strong style="color:red">Total Deduction</strong>
                                                            <span class="pull-right" id="TotalDeductionDisp-{{$employee->id}}"> ₱ {{number_format($TotalDeductions , 2)}} </span><span><input type="text" id="TotalDeduction-{{$employee->id}}" value="{{$TotalDeductions}}" hidden name="total_deduction[{{$employee->id}}]"></span>
                                                    </li>

                                                    <li class="list-group-item">
                                                            <strong style="color:green">Net Pay</strong>
                                                            <span class="pull-right" id="TotalNetPayDisp-{{$employee->id}}"> ₱ {{number_format($NetPay , 2)}} </span><span><input type="text" id="TotalNetPay-{{$employee->id}}" value="{{$NetPay}}" hidden name="netpay[{{$employee->id}}]"></span>
                                                    </li>
                                                
                                            </ul>
                                            
                                            </div>
                                        </div>
                                   </div>
                                    
                               </div>
                               
                               <hr>
                               <div class="row">
                                <div class="col-lg-12">
                                    <h4>Attendance</h4>
                                    <br>
                                    <div class="col-lg-3">
                                         <span>Total Hours : {{$EmployeeTotalHours}}</span>
                                    </div>
                                    <div class="col-lg-3">
                                         <span>Total Days :</span>
                                    </div>
                                    <div class="col-lg-3">
                                         <span>Undertime :</span>
                                    </div>
                                    <div class="col-lg-3">
                                         <span>Late :</span>
                                    </div>
                                    
                                </div>
                                </div>
                                
                              
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-sm btn-white" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-sm btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
        </td>
    </tr>

    

@endforeach

<script>
  
</script>