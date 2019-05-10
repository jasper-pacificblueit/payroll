@php( $employees = \App\Employee::all())

@foreach ($employees as $employee)
    <?php
        $startDate = date("Y-m-d" , strtotime($start));
        $endDate = date("Y-m-d" , strtotime($end));
        $EmployeeRate = App\Rate::getHourlyRate($employee->id);
        $EmployeeOvertime = $employee->rates->overtime;
        $EmployeeHoliday = $employee->rates->holiday;
        
        
        $EmployeeTotalHours = App\DateTimeRecord::getTotalHours($startDate , $endDate , $employee->user_id);
        
        //Deductions
        // $EmployeeDeductions = App\Rate::getDeductions($employee->id);
        // $DeductionsRates = json_decode($EmployeeDeductions); 
        $EmployeeLate = $employee->deductions->late;
        $EmployeeDeductions = $employee->deductions->deductions;
        $DeductionsRates = json_decode($EmployeeDeductions);
        

        //Earnings
        $Basic = App\Payroll::getBasic($EmployeeRate , $EmployeeTotalHours);
        $Overtime = 0;
        $Holiday = 0;


        $TotalEarnings = App\Payroll::getEarnings($Basic , $Overtime , $Holiday);
        
        $TotalDeductions = App\Payroll::getDeductions($DeductionsRates);
        $NetPay =  App\Payroll::NetPay($TotalEarnings , $TotalDeductions);
     ?>
    
    @php( $attendances = \App\DateTimeRecord::where('user_id' , $employee->user_id)->whereBetween('date' , [$startDate , $endDate])->get())
    <tr>
        <td>{{ App\Profile::getFullName($employee->user_id) }}</td>
       
        <td><span id="TotalIncomeDispOut-{{$employee->user_id}}"> ₱ {{number_format($TotalEarnings , 2)}} </span></td>
        <td><span id="TotalDeductionDispOut-{{$employee->user_id}}"> ₱ {{number_format($TotalDeductions , 2)}} </span></td>
        <td>₱ {{ number_format($NetPay , 2) }}</td>
        <td>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details-{{$employee->user_id}}">Details</button>
            <div class="modal inmodal fade" id="details-{{$employee->user_id}}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">{{ App\Profile::getFullName($employee->user_id) }}</h4>
                                <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                            </div>
                            <div class="modal-body">
                               <div class="row">
                                   <h4>Information </h4>
                                   <br>
                                   <div class="col-lg-6">
                                        <span>Department : {{$employee->getDepartment->name}}</span>
                                   </div>
                                   <div class="col-lg-6">
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
                                        <span>Late : ₱ {{number_format($EmployeeLate , 2)}}</span>
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
                                                            <span class="pull-right"> ₱ {{number_format($Basic , 2)}} <input class="IncomeClass-{{$employee->user_id}}" type="text" value="{{round($Basic , 2)}}" hidden></span>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span>Overtime</span>
                                                            <span class="pull-right"> ₱ {{number_format(0 , 2)}} <input class="IncomeClass-{{$employee->user_id}}" type="text" value="{{round(0 , 2)}}" hidden></span>
                                                                
                                                        </li>
                                                        <li class="list-group-item">
                                                            <span>Holiday</span>
                                                            <span class="pull-right"> ₱ {{number_format(0 , 2)}} <input class="IncomeClass-{{$employee->user_id}}" type="text" value="{{round(0 , 2)}}" hidden></span>
                                                        </li>
                                                    
                                                    
                                                    </span>
                                                    <span id='income-{{$employee->user_id}}'>
                                                    </span>
                                                
                                                {{-- <div id="addIncomeItem">
                                                    <li class="list-group-item" >
                                                        <input type="text" id="description" style="border:0;border-bottom:solid 1px #CCC;outline:none;background:transparent" placeholder="Description..">
                                                        <span class="pull-right">₱ <input id='amount' type="text" style="border:0;border-bottom:solid 1px #CCC;outline:none;background:transparent" placeholder="Amount.."></span>
                                                    </li>
                                                </div> --}}
                                                <li class="list-group-item">
                                                <span><input type="button" class="btn btn-default btn-xs" onclick="addIncome({{$employee->user_id}})" id="addIncomeBtn-{{ $employee->user_id }}" value="Add Income"></span>
                                                    <span class="pull-right"></span>
                                                </li>
                                                <li class="list-group-item">
                                                        <strong style="color:green">Total Income</strong>
                                                        <span class="pull-right" id="TotalIncomeDisp-{{$employee->user_id}}"> ₱ {{number_format($TotalEarnings , 2)}} </span><span><input type="text" id="TotalIncome-{{$employee->user_id}}" value="{{number_format($TotalEarnings , 2)}}" style="border:0; background:transparent;text-align:right;" hidden></span>
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
                                                    <span id="DisplayDeduction-{{$employee->user_id}}">
                                                     <li class="list-group-item">
                                                        <span>Late</span>
                                                        <span class="pull-right"> ₱ {{number_format(0 , 2)}}  <input class="DeductionClass-{{$employee->user_id}}" type="text" value="{{round(0 , 2)}}" hidden></span>
                                                     </li>
                                                     <li class="list-group-item">
                                                        <span>Undertime</span>
                                                        <span class="pull-right"> ₱ {{number_format(0 , 2)}} <input class="DeductionClass-{{$employee->user_id}}" type="text" value="{{round(0 , 2)}}" hidden></span>
                                                     </li>

                                                    @foreach ($DeductionsRates->statutory as $name => $deductions)
                                                        <li class="list-group-item">
                                                            <span>{{$name}}</span>
                                                            <span class="pull-right"> ₱ {{$deductions}} <input class="DeductionClass-{{$employee->user_id}}" type="text" value="{{round($deductions , 2)}}" hidden></span>
                                                        </li>
                                                    @endforeach
                                                    

                                                    </span>
                                                    <span id="deduction-{{$employee->user_id}}">

                                                    </span>
                                                    <li class="list-group-item">
                                                        <input type="button" class="btn btn-default btn-xs" onclick="addDeduction({{$employee->user_id}})" id="addDeductionBtn-{{ $employee->user_id }}" value="Add Deductions"></span>
                                                        <span class="pull-right"></span>
                                                    </li>
                                                

                                                    <li class="list-group-item">
                                                            <strong style="color:red">Total Deduction</strong>
                                                            <span class="pull-right" id="TotalDeductionDisp-{{$employee->user_id}}"> ₱ {{number_format($TotalDeductions , 2)}} </span><span><input type="text" id="TotalDeduction-{{$employee->user_id}}" value="{{number_format($TotalDeductions , 2)}}" hidden></span>
                                                    </li>
                                                
                                            </ul>
                                            
                                            </div>
                                        </div>
                                   </div>
                                    
                               </div>
                               
                               <hr>
                               <div class="row">
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

<script>
  
</script>