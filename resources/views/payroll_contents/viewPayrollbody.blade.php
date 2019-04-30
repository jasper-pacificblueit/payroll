@php( $employees = \App\Employee::all())

@foreach ($employees as $employee)
    <?php
        $startDate = date("Y-m-d" , strtotime($start));
        $endDate = date("Y-m-d" , strtotime($end));
        $EmployeeRate = App\Rate::getHourlyRate($employee->id);
        $EmployeeTotalHours = App\DateTimeRecord::getTotalHours($startDate , $endDate , $employee->user_id);

        $Basic = App\Payroll::getBasic($EmployeeRate , $EmployeeTotalHours);
        $Overtime = 0;
        $Holiday = 0;


        $TotalEarnings = App\Payroll::getEarnings($Basic , $Overtime , $Holiday);

        $TotalDeductions = 0;
        $NetPay =  App\Payroll::NetPay($TotalEarnings , $TotalDeductions);
     ?>
    
    @php( $attendances = \App\DateTimeRecord::where('user_id' , $employee->user_id)->whereBetween('date' , [$startDate , $endDate])->get())
    <tr>
        <td>{{ App\Profile::getFullName($employee->user_id) }}</td>
       
        <td>₱ {{ number_format($TotalEarnings , 2) }}</td>
        <td>₱ 0</td>
        <td>₱ {{ number_format($NetPay , 2) }}</td>
        <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#details-{{$employee->user_id}}">Details</button></td>
    </tr>

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
                                <span>Department : --</span>
                           </div>
                           <div class="col-lg-6">
                                <span>Position : --</span>
                           </div>
                           
                       </div>
                       
                       <hr>
                       <div class="row">
                        
                           <div class="col-lg-3">
                                <span>Hourly : ₱ {{number_format($EmployeeRate , 2)}}</span>
                           </div>
                           <div class="col-lg-3">
                                <span>Overtime : ₱ {{number_format(0 , 2)}}</span>
                           </div>
                           <div class="col-lg-3">
                                <span>Holiday : ₱ {{number_format(0 , 2)}}</span>
                           </div>
                           <div class="col-lg-3">
                                <span>Late : ₱ {{number_format(0 , 2)}}</span>
                           </div>
                          
                         
                           
                       </div>
                       <hr>
                       <div class="row">
                         
                           <div class="col-lg-6">
                                <h4>Income</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <ul class="list-group">
                                        <li class="list-group-item">
                                            <span>Basic</span>
                                            <span class="pull-right"> ₱ {{number_format($Basic , 2)}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Overtime</span>
                                            <span class="pull-right"> ₱ {{number_format(0 , 2)}}</span>
                                                
                                        </li>
                                        <li class="list-group-item">
                                            <span>Holiday</span>
                                            <span class="pull-right"> ₱ {{number_format(0 , 2)}}</span>
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
                                        <li class="list-group-item">
                                            <span>Late</span>
                                            <span class="pull-right"> ₱ {{number_format(0 , 2)}}</span>
                                        </li>
                                        <li class="list-group-item">
                                                <span>Undertime</span>
                                                <span class="pull-right"> ₱ {{number_format(0 , 2)}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>SSS</span>
                                            <span class="pull-right"> ₱ {{number_format(0 , 2)}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>Pag-ibig</span>
                                            <span class="pull-right"> ₱ {{number_format(0 , 2)}}</span>
                                        </li>
                                        <li class="list-group-item">
                                            <span>PhilHealth</span>
                                            <span class="pull-right"> ₱ {{number_format(0 , 2)}}</span>
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

@endforeach
