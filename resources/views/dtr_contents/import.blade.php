
@if (isset($csv_info))
<div class="row">
        <div class="col-lg-12">
           
                    
                    @if(isset($csv_info))
                     
                        <label>Period : {{ $csv_info->period}}</label>
                        <br>
                        <label>Printed : </label> {{ $csv_info->printed }}
                        <br>
                        <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Employee</th>
                                            <?php
                                                $days = GetDays($start , $end);
                                            ?>

                                            @foreach ($csv_info->employees[0]->attendance as $attendance)
                                            <td>{{$attendance->ddww}}</td> 
                                            @endforeach

                                        <th>Total Hrs</th>
                                        </tr>
                                       
                                    </thead>
                                     <tbody>
                                        @foreach ($csv_info->employees as $employee)
                                            <tr>
                                                <td>{{ucwords(strtolower($employee->name))}}</td>
                                                
                                                <?php $totalHrs = 0; $diff = array();?>
                                                @foreach ($employee->attendance as $attendance)
                                            
                                                    @if($attendance->absent)
                                                    <td><b style="color:red;">A</b></td>
                                                    @else
                                                    <?php
                                                      
                                                        if(empty($attendance->am['out']) && empty($attendance->pm['out'])){
                                                            $diff = "<b style='color:orange;'>W</b>";
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

                                                    ?>
                                                    
                                                 
                                                    <td><?php echo $diff; ?></td>
                                                 
                                                    @endif
                                                 
                                                    
                                                @endforeach
                                                <td>{{$totalHrs}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <Br>
                            <a href="/dtr" class="btn btn-default">Cancel</a>
                            <a class="btn btn-success pull-right" data-toggle="modal" data-target="#showWarning">Save</a>
                            
                                
                      
                       
                    
                    @endif
           
        </div>

    </div>

@else
<div class="row">
        <div class="col-sm-3 m-b-xs">
            <h4>Import Attendance</h4>
            <form method="POST" action="/dtr/view" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="fileinput fileinput-new" data-provides="fileinput">
                    <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span>
                    <span class="fileinput-exists">Change</span><input type="file" name="upload-file" required/></span>
                    <span class="fileinput-filename"></span>
                    <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                </div> 
                
        </div>
       
    </div>
    <div class="row">
            <div class="col-sm-4 m-b-xs">
                <h4>Please input date</h4>
                <div class="form-group" id="data_5">
                    <div class="input-daterange input-group" id="datepicker">

                        <?php $initStart = date("Y-m-d");?>
                        <?php $initEnd = date('Y-m-d', strtotime($initStart. ' + 14 day'));?>
                        <input type="date" class="input-sm form-control" name="start" value="{{$initStart}}" />
                        <span class="input-group-addon">to</span>
                        <input type="date" class="input-sm form-control" name="end" value="{{$initEnd}}" />
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <button type="submit" class="form-control">View</button>
            </form>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12" >
            
            <p>Please import your csv file to view records</p>

        </div>

    </div>
@endif
