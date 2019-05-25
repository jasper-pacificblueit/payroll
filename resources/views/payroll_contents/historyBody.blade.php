
@php($Payslips = \App\Payslips::all()->where('start' , '=' , $payroll->start , 'AND' , 'end' , $payroll->end))

@foreach ($Payslips as $payslip)
   
    {{-- employee_id is equal to user_id LOL :D --}}

    <?php

        $employee = $payslip->getEmployee;
        $EmployeeRate = App\Rate::getHourlyRate($employee->id);
        $EmployeeOvertime = $employee->rates->overtime;
        $EmployeeHoliday = $employee->rates->holiday;
        $EmployeeLate = $employee->deductions->late;
        $EmployeeUndertime = $employee->deductions->undertime;

        $EmployeeEarnings = $payslip->earnings;
        $EmployeeEarningsDecoded = json_decode($EmployeeEarnings);

        
   ?>

    

    <tr>
      
        <td>{{\App\Profile::getFullName($payslip->employee_id)}}</td>
        <td>{{$payslip->getEmployee->getDepartment->name}}</td>
        <td>{{$payslip->getEmployee->positions()->title}}</td>
        
        <td>₱ {{number_format($payslip->total_income , 2)}}</td>
        <td>₱ {{number_format($payslip->total_deduction , 2)}}</td>
        <td>₱ {{number_format($payslip->net_pay , 2)}}</td>
        <td>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#payslip-{{$payslip->id}}">
                View Payslip
            </button>

            <div class="modal inmodal fade" id="payslip-{{$payslip->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                <div class="modal-content">
                        <div class="modal-header" style="padding:10px;">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                          
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <h4 style="margin-left: 11px">Information</h4>
                               
                                <div class="col-lg-4">
                                     <span>Employee : <label>{{App\Profile::getFullName($payslip->employee_id)}}</label></span>
                                </div>
                                <div class="col-lg-4">
                                     <span>Department : {{$payslip->getEmployee->getDepartment->name}}</span>
                                </div>
                                <div class="col-lg-4">
                                     <span>Position : {{$payslip->getEmployee->positions()->title}}</span>
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
                                                 
                                                @foreach ($EmployeeEarningsDecoded as $name => $value)
                                                    <li class="list-group-item">
                                                        <span>{{ucfirst($name)}}</span>
                                                        <span class="pull-right">₱ {{number_format($value , 2)}}</span>
                                                    </li>
                                                @endforeach
                                                    
                                                   
                                               
                                             
                                       
                                             <li class="list-group-item">
                                                     <strong style="color:green">Total Income</strong>
                                                     <span class="pull-right">₱ {{number_format($payslip->total_income , 2)}}</span>
                                           
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
                                                 
                                                @foreach ($EmployeeEarningsDecoded as $name => $value)
                                                    <li class="list-group-item">
                                                        <span>{{ucfirst($name)}}</span>
                                                        <span class="pull-right">₱ {{number_format($value , 2)}}</span>
                                                    </li>
                                                @endforeach
                                             

                                                 <li class="list-group-item">
                                                         <strong style="color:red">Total Deduction</strong>
                                                          <span class="pull-right">₱ {{number_format($payslip->total_deduction , 2)}}</span>
                                                 </li>

                                                 <li class="list-group-item">
                                                         <strong style="color:green">Net Pay</strong>
                                                         <span class="pull-right">₱ {{number_format($payslip->net_pay , 2)}}</span>
                                                 </li>
                                             
                                         </ul>
                                         
                                         </div>
                                     </div>
                                </div>
                                 
                            </div>

                          
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

        </td>
    </tr>

@endforeach
