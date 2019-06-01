

@php( $employees = \App\DateTimeRecord::with('getProfile')->distinct()->get(['user_id']))
@foreach ($employees as $employee)
    
    <tr>
       
        @php( $attendances = \App\DateTimeRecord::where('user_id' , $employee->user_id)->whereBetween('date' , [$data->start , $data->end])->get())
        <td> {{App\Profile::getFullName($employee->user_id)}}</td>
        <?php $dayCount = 0; $totalHrs = 0;?>
        @foreach ($attendances as $attendance)
            <?php
            
                $dayCount++;
                $totalHrs += $attendance->total_hours;
            ?>
        @endforeach
        <td>{{ App\Employee::where('user_id', $employee->user_id)->first()->departments->name }}</td>
        <td>{{ App\User::find($employee->user_id)->position()->title }}</td>
        <td>{{$totalHrs}}</td>
        <td>{{$dayCount}}</td>
       
        <td><a class="btn btn-default btn-sm" data-toggle="modal" data-target="#showDetails-{{$employee->user_id}}">Details</a></td>
    </tr>

    
<div class="modal inmodal fade" id="showDetails-{{$employee->user_id}}" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <label class="pull-left">Attendance Details - <a href="#">{{$employee->getProfile->lname}}, {{$employee->getProfile->fname}}</a></label>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-lg-12">
                    @php( $attendances = \App\DateTimeRecord::where('user_id' , $employee->user_id)->whereBetween('date' , [$data->start , $data->end])->get())
                    <ul class="list-group clear-list m-t">
                            <li class="list-group-item fist-item">
                                <span class="pull-right label label-default"  style="font-size:13px;width:200px;">Date</span>
                             
                                <span class="label label-primary" style="font-size:13px;width:200px;">Time in</span> 
                                <span class="label label-danger" style="font-size:13px; width:200px;">Time out</span> 
                                <span class="label label-success" style="font-size:13px; width:200px;">Total Hours</span> 

                            </li>
                        @foreach ($attendances as $attendance)
                            <li class="list-group-item">
                                <span class="pull-right label label-default" style="font-size:13px; width:200px;">
                                {{date("M d Y" , strtotime($attendance->date))}}
                                </span>
                                <span class="label label-primary" style="font-size:13px; width:200px;">{{$attendance->in_am}}</span> 
                                
                                <span class="label label-danger" style="font-size:13px; width:200px;">{{$attendance->out_am}}</span> 
                                
                                <span class="label label-primary" style="font-size:13px; width:200px;">{{$attendance->in_pm}}</span> 
                            
                                <span class="label label-danger" style="font-size:13px; width:200px;">{{$attendance->out_pm}}</span> 
                                <span class="label label-success" style="font-size:13px; width:200px;">{{$attendance->total_hours}}</span> 
                                
                            </li>
                        @endforeach
                        
                    </ul>
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