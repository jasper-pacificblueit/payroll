
@if (isset($csv_info))
<form action="/dtr" method="POST">
    {{ csrf_field() }}
<div class="row">
        <div class="col-lg-12">
                  @if(isset($csv_info))
                      @php

                        $period = $csv_info->period;
                        $year1 = "{$period[0]}{$period[1]}{$period[2]}{$period[3]}";
                        if(isset($period[20])){
                            $year2 = 'adasd';
                        }
                        else{
                            $year2 = $year1;
                        }
                        
                        $startMonth = "{$period[5]}{$period[6]}";
                        $startDay = "{$period[8]}{$period[9]}";

                        $endMonth = "{$period[13]}{$period[14]}";
                        $endDay = "{$period[16]}{$period[17]}";
                        
                        $payrollDate1 = "{$year1}/{$startMonth}/{$startDay}";
                        $payrollDate2 = "{$year2}/{$endMonth}/{$endDay}";

                        
                        $days = GetDays($payrollDate1 , $payrollDate2);
                        
                      @endphp
                    <h4>Payroll Date : {{date("M d Y" , strtotime($payrollDate1))}} -  {{date("M d Y" , strtotime($payrollDate2))}}</h4>
                   
                   
                        
                    <br>
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Bio ID</th>
                            <th>Employee</th>
                            <th>Department</th>
                            <th>Rendered Hours</th>
                            <th>Total Days</th>
                            <th>Warning/s</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                                @foreach ($csv_info->employees as $employee)
                                    <tr>
                                        <td>{{$employee->bio_id}}</td>
                                        <input type="text" name="bio_id[]" value="{{$employee->bio_id}}" hidden>
                                        <td>{{ucwords(strtolower($employee->name))}}</td>
                                        <td>{{ $employee->dep }}</td>

                                     
                                        @php
                                            $totalHrs = 0; $diff = array(); $TotalWarning = array();$Warning = 0;
                                            $totalDays = 0;
                                        @endphp
                                            @foreach ($employee->attendance as $attendance)
                                                
                                                
                                                @if($attendance->absent)
                                                    <?php 
                                                        $diff = 0;
                                                    ?>
                                                @else
                                                    <?php
                                                        
                                                        if(empty($attendance->am['out']) && empty($attendance->pm['out'])){
                                                                $diff = "<b style='color:orange;'>W</b>";
                                                                $Warning++;
                                                        }
                                                        else if(empty($attendance->am['out'])){
                                                                $am_in = strtotime($attendance->am['in']);
                                                                $pm_out = strtotime($attendance->pm['out']);
                                                                $diff = round(abs($am_in - $pm_out) / 3600 , 1);
                                                        }
                                                            
                                                        
                                                        else if(empty($attendance->pm['out'])){
                                                                $am_in = strtotime($attendance->am['in']);
                                                                $am_out = strtotime($attendance->am['out']);
                                                                $diff = round(abs($am_in - $am_out) / 3600 , 1);
                                                        }
                                                        $totalDays++;
                                                    ?>
                                                        
                                                    <?php $totalHrs += (float)$diff; ?>
                                                    

                                                @endif
                                                        
                                                        
                                            @endforeach

                                        <td><?php echo $totalHrs; ?></td>
                                        <td><?php echo $totalDays; ?></td>
                                        <td><?php echo $Warning; ?></td>
                                        
                                        <td><a class="btn btn-default btn-sm" data-toggle="modal" data-target="#showDetails-{{$employee->bio_id}}">Details</a></td>
                                    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>    

                                
                            <br>
                            <a href="/dtr" class="btn btn-default">Cancel</a>
                            <a class="btn btn-success pull-right" data-toggle="modal" data-target="#showWarning" {{ auth()->user()->can("dtr_Create") ?: 'disabled' }}>Next</a>
                            
                    </div>
                    
                    @endif
           
        </div>

    </div>

    
 @foreach ($csv_info->employees as $employee)
 <div class="modal inmodal fade" id="showDetails-{{$employee->bio_id}}" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3>{{ucwords(strtolower($employee->name))}}</h3>
                   
                </div>
                <div class="modal-body">
                  <div class="row">
                        <div class="col-lg-12">
                                <div class="table-responsive">
                                        <table class="table">
                                                <thead>
                                                <tr>
                                                   <th>{{$csv_info->period}}</th>
                                                   <th>Time in</th>
                                                   <th>Time out</th>
                                                   <th>Rendered Hours</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody>
                                                
                                                    <?php $dayCount = 0; $totalHrs = 0;?>
                                                    @foreach ($employee->attendance as $attendance)
                                                    
                                                        <tr>
                                                            @if($attendance->absent)
                                                              
                                                                <td>{{date("M d Y" , strtotime($days[$dayCount]))}}</td>
                                                                <td>--</td>
                                                                <td>--</td>   
                                                                <td><b style="color:red">Absent</b></td>
                                                               
                                                                
                                                            @else

                                                            <?php
                                                                            
                                                                if(empty($attendance->am['out']) && empty($attendance->pm['out'])){
                                                                    $diff = "<b style='color:orange;'>Warning</b>";
                                                                    $out = '--';
                                                                }
                                                                else if(empty($attendance->am['out'])){
                                                                    $am_in = strtotime($attendance->am['in']);
                                                                    $pm_out = strtotime($attendance->pm['out']);
                                                                    $diff = round(abs($am_in - $pm_out) / 3600, 1);
                                                                    $in = $attendance->am['in'];
                                                                    $out = $attendance->pm['out'];
                                                                    
                                                                }
                                                                
                                                            
                                                                else if(empty($attendance->pm['out'])){
                                                                    $am_in = strtotime($attendance->am['in']);
                                                                    $am_out = strtotime($attendance->am['out']);
                                                                    $diff = round(abs($am_in - $am_out) / 3600 , 1);
                                                                    $in = $attendance->am['in'];
                                                                    $out = $attendance->am['out'];
                                                                }

                                                            ?>
                                                            
                                                            <?php $totalHrs += (float)$diff; ?>
                                                            
                                                                <td>{{date("M d Y" , strtotime($days[$dayCount]))}}</td>
                                                                <input type="text" name="date[{{$employee->bio_id}}][]" value="{{$attendance->ddww}}" hidden>
                                                                <input type="time" name="in[{{$employee->bio_id}}][]" value="{{$in}}" hidden>
                                                                <input type="time" name="out[{{$employee->bio_id}}][]" value="{{$out}}" hidden>
                                                                
                                                                
                                                                
                                                                <td>{{$in}}</td>
                                                                <td>{{$out}}</td>
                                                                <td><?php echo $diff; ?></td>
                                                                <input type="number" name="totalHours[{{$employee->bio_id}}][]" value="{{$diff}}" hidden>
                                                               
                                                            @endif
                                                            
                                                        </tr>
                                                        <?php $dayCount++; ?>
                                                        @endforeach
                                                        <tr>
                                                            <th>Total Hours</th>
                                                            <th>&nbsp;</th>
                                                            <th>&nbsp;</th>
                                                            <th>{{$totalHrs}}</th>
                                                            
                                                            <Br>
                                                        </tr>
                                                </tbody>
                                            </table>
                                  </div>
                            
                        </div>
                  </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
 </div> 
 @endforeach

 @can ("dtr_Create")
 <div class="modal inmodal fade" id="showWarning" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Set Value for Warnings</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                        <div class="col-lg-12">
                          <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Bio ID</th>
                                            <th>Employee</th>
                                            <th>Date</th>
                                            <th>Time in</th>
                                            <th>Set time out</th>
                                            <th>Total Hour</th>
                                            <th>Set Bio-ID</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($csv_info->employees as $employee)
                                            <tr>
                                                <td>{{ $employee->bio_id }}</td>
                                                <td>{{ ucwords(strtolower($employee->name)) }}</td>
                                                <td style="width:10%;">
                                                  
                                                    @foreach ($employee->attendance as $attendance)
                                                    
                                                        @if (empty($attendance->am['out']) && empty($attendance->pm['out']))
                                                            @if (!empty($attendance->am['in']) || !empty($attendance->pm['in']))
                                                                @if(!empty($attendance->am['in']))
                                                                   <input type="text" value="{{$attendance->ddww}}" readonly class="form-control" style="background:transparent; border: 0;">
                                                                   <br>
                                                                @endif
                                                            @endif
                                                        @endif

                                                    @endforeach
                                                </td>

                                                
                                                <td>
                                                    @php
                                                        $count = 0;
                                                    @endphp
                                                    @foreach ($employee->attendance as $attendance)
                                                    
                                                        @if (empty($attendance->am['out']) && empty($attendance->pm['out']))
                                                            @if (!empty($attendance->am['in']) || !empty($attendance->pm['in']))
                                                                @if(!empty($attendance->am['in']))
                                                                    <input type="time" value="{{$attendance->am['in']}}" class="warningTimeIn form-control" style="background:transparent;border:0;" name="warningTimeIn[{{$employee->bio_id}}][]" id="in" readonly>
                                                                    <br>
                                                                @elseif(!empty($attendance->pm['in']))
                                                                     <input type="time" value="{{$attendance->pm['in']}}" class="warningTimeIn form-control" style="background:transparent;border:0;" name="warningTimeIn[{{$employee->bio_id}}][]" id="in" readonly>
                                                                     <br>
                                                                @endif
                                                            @endif
                                                        @endif

                                                    @endforeach
                                                </td>

                                                <td>
                                                    @php
                                                        $count = 0;
                                                    @endphp
                                                    @foreach ($employee->attendance as $attendance)
                                                       
                                                        @if (empty($attendance->am['out']) && empty($attendance->pm['out']))
                                                            @if (!empty($attendance->am['in']) || !empty($attendance->pm['in']))
                                                              <div class="input-group clockpicker" data-autoclose="true">
                                                                    <span class="input-group-addon">
                                                                        <i class="far fa-clock"></i>
                                                                    </span> 
                                                                    <input type="time" class="warningTimeOut form-control" onchange="calchour()" name="warningTimeOut[{{$employee->bio_id}}][]" id="out" value="18:00" required>
                                                                       
                                                                </div>
                                                                <br>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td style="width:10%;">
                                                    @php
                                                        $count = 0;
                                                    @endphp
                                                    @foreach ($employee->attendance as $attendance)
                                                        @if (empty($attendance->am['out']) && empty($attendance->pm['out']))
                                                            @if (!empty($attendance->am['in']) || !empty($attendance->pm['in']))
                                                                <input type="text" name="warningTotal[{{$employee->bio_id}}][]" class="warningTotal form-control" style="background:transparent;border:0;" readonly>
                                                                <br>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </td>
                                                @php( $checkBioID = \App\Employee::all()->where('bio_id' , '=' , $employee->bio_id)->first())
                                                @php( $checkRow = \App\Employee::all()->where('bio_id' , '=' , $employee->bio_id)->count())
                                                
                                                @if ( $checkRow > 0)
                                                    <td>
                                                        <i class="fa fa-check" style="color:green;font-size:20px;"></i> 
                                                        <input type="text" value="{{$checkBioID->user_id}}" name="UserID[{{$employee->bio_id}}][]" hidden>
                                                    </td>
                                                @else
                                                    <td>

                                                        {{-- @php( $employees = \App\Employee::all()->where('bio_id' , '=' , NULL)) --}}
                                                        <?php
                                                            $name = ucwords(strtolower($employee->name));
                                                            $Searchname = "{$name[0]}{$name[1]}{$name[2]}";
                                                        ?>
                                                        
                                                        @php($EmployeeList = DB::table('employees')->join('profiles' , 'employees.user_id' , '=' , 'profiles.user_id')->where('fname' , 'LIKE' , '%'.$Searchname.'%' , 'AND' , 'bio_id' , NULL)->get())
                                                        <select name="UserID[{{$employee->bio_id}}][]" id="" class="form-control">
                                                        @foreach ($EmployeeList as $emp)
                                                            <option value="{{$emp->user_id}}">{{ App\Profile::getFullName($emp->user_id) }}</option>
                                                        @endforeach
                                                    </select>
                                                    </td>
                                                @endif
                                          
                                              
                                            </tr>
                                        @endforeach
                                      
                                        </tbody>
                                    </table>
                          </div>
                         

                        </div>
                  </div>
                </div>
                {!! Form::hidden('info', json_encode($csv_info)) !!}
                {!! Form::hidden('days', json_encode($days)) !!}
                

                <input type="date" name="payrollDate1" value="{{date("Y-m-d" , strtotime($payrollDate1))}}" hidden>
                <input type="date" name="payrollDate2" value="{{date("Y-m-d" , strtotime($payrollDate2))}}" hidden>
                

                <div class="modal-footer">  
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="ImportData" id="ImportData">Save</button>
                </div>
            </div>
        </div>
 </div>
 @endcan
 <input type="button" name="" id="Notif1"  class="btn btn-success btn-sm demo2" style="display:none;">
 
</form>
@else
    <div class="row">
        

        <div class="col-lg-6">
           
            <div class="row">
                <div class="col-sm-12 m-b-xs">
                    <h4>Import Attendance</h4>
                    <form method="POST" action="/dtr/view" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput" style="border-top-left-radius: 5px; border-bottom-left-radius: 5px">
                                <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                <span class="fileinput-filename"></span>
                            </div>
                                <span class="input-group-addon btn btn-default btn-file">
                                <span class="fileinput-new">Select file</span>
                                <span class="input-group fileinput-exists">Change</span>
                                <input type="file" name="upload-file" required></span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" style="
                                    border-bottom-right-radius: 5px;
                                    border-top-right-radius: 5px;
                                " data-dismiss="fileinput">Remove</a>
                        </div>
                       
                        
                </div>
               
            </div>
           
            <div class="row">
                <div class="col-lg-2 col-xs-3">
                    
                    <button type="submit" class="btn btn-default btn-md" style="width: 100%">View</button>

                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12 m-b-xs">
                    <h4>Export File Format</h4>
                    <div class="btn-group">
                        <button class="btn btn-white" type="button">xlsx</button>
                        <button class="btn btn-white" type="button">csv</button>
                        <button class="btn btn-white" type="button">xls</button>
                    </div>


                </div>
           </div>
           
       
        </div>

        <div class="col-lg-6">
         
            <div class="row">
                @php( $checkPayroll = \App\PayrollDate::orderBy('id' , 'DESC')->count())
                @if ($checkPayroll > 0)

                     <div class="col-lg-12">
                        <label>Recent file uploaded</label>
                        <div class="hr-line-dashed"></div>
                        
    
                      
    
                        <div class="row">
                            <div class="col-sm-12 m-b-xs">
                                    <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Employee</th>
                                                    <th>Department</th>
                                                    <th>Position</th>
                                                    <th>Total Hours</th>
                                                    <th>Total Days</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                @php($payrollDate = \App\PayrollDate::orderBy('id' , 'DESC')->first())

                                                @php($Employees = \App\Employee::all())
                                                @foreach ($Employees as $employee)
                                                <?php
                                                 $EmployeeTotalHours = App\DateTimeRecord::getTotalHours($payrollDate->start , $payrollDate->end , $employee->user_id);
                                                 $EmployeeTotalDays = App\DateTimeRecord::getTotalDays($payrollDate->start , $payrollDate->end , $employee->user_id);
                                                 
                                                ?>
                                                <tr>
                                                    <td>{{ App\Profile::getFullName($employee->user_id) }}</td>
                                                    <td>{{$employee->getDepartment->name}}</td>
                                                    <td>{{ $employee->positions()->title }}</td>
                                                    <td>{{$EmployeeTotalHours}}</td>
                                                    <td>{{$EmployeeTotalDays}}</td>
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                            </div>
                       </div>
                    </div>

                @else
                    <div class="col-lg-12">
                        <h4>No recent file uploaded</h4>
                        <br>
                        <div class="alert alert-warning">
                                How quickly daft jumping zebras vex. <a class="alert-link" href="#">Alert Link</a>.
                        </div>
                    </div>
                @endif
               
        
            </div>
        </div>
    </div>
@endif

<script>



function diff_minutes(dt2, dt1) 
 {

  var diff =(dt2.getTime() - dt1.getTime()) / 1000;
  diff /= 60;
  return Math.abs(Math.round(diff));
  
 }
  function calchour() {
    warningElement = document.getElementsByClassName('warningTimeOut');
    warningInElement = document.getElementsByClassName('warningTimeIn');
    warningTotalElement = document.getElementsByClassName('warningTotal');

    var warningValues = new Array();
    var warningInValues = new Array();
    var warningTotalValues = new Array();

    for(var i = 0; i < warningElement.length; i++) {
        var warningVar = warningElement[i].value;
        var warningInVar = warningInElement[i].value;
        
       
        warningValues.push(warningElement[i].value);
        warningInValues.push(warningInElement[i].value);

        var intime = warningInVar.split(':');
        var outtime = warningVar.split(':');

        var diff = (new Date(0, 0, 0, outtime[0], outtime[1], 0) - new Date(0, 0, 0, intime[0], intime[1], 0))/(3.6 * 1e6);

        warningTotalValues.push(diff.toFixed(2));
    }

    for(var j =0; j< warningValues.length; j++) {
        warningTotalElement[j].value = warningTotalValues[j];
    }


   
    checkResult = warningTotalValues.some(el => el < 0);

    try {
    if(checkResult){
       document.getElementById('ImportData').disabled = true;
    }
    else{
        document.getElementById('ImportData').disabled = false;
    }
    } catch (error) {};
  
  }
   


  calchour();


</script>