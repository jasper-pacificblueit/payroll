@extends('layouts.master')

@section('title', 'Attendance Report')

@section('styles')

{!! Html::style('css/plugins/dropzone/basic.css') !!}
{!! Html::style('css/plugins/dropzone/dropzone.css') !!}
{!! Html::style('css/plugins/jasny/jasny-bootstrap.min.css') !!}
{!! Html::style('css/plugins/codemirror/codemirror.css') !!}
{!! Html::style('css/plugins/codemirror/codemirror.css') !!}

@endsection

@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Attendance</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/">Dashboard</a>
                </li>
                <li>
                    <a href="/employee"><strong>Import Attendance</strong></a>
                </li>
               
            </ol>
        </div>
    </div>
    <br>
    <div class="wrapper wrapper-content no-padding">
        <div class="wrapper wrapper-content no-padding">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                    
                        <div class="ibox-content">
                            
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    

    <?php
        function GetDays($sStartDate, $sEndDate){  
                // Firstly, format the provided dates.  
                // This function works best with YYYY-MM-DD  
                // but other date formats will work thanks  
                // to strtotime().  
                $sStartDate = gmdate("Y-m-d", strtotime($sStartDate));  
                $sEndDate = gmdate("Y-m-d", strtotime($sEndDate));  

                // Start the variable off with the start date  
                $aDays[] = $sStartDate;  

                // Set a 'temp' variable, sCurrentDate, with  
                // the start date - before beginning the loop  
                $sCurrentDate = $sStartDate;  

                // While the current date is less than the end date  
                while($sCurrentDate < $sEndDate){  
                // Add a day to the current date  
                $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  

                // Add this new day to the aDays array  
                $aDays[] = $sCurrentDate;  
                }  

                // Once the loop has finished, return the  
                // array of days.  
                return $aDays;  
       }  
            
      
    ?>
    <div class="modal inmodal fade" id="showWarning" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Set Value for Warnings</h4>
                        <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                            <div class="col-lg-12">
                                
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
@endsection

@section('scripts')

{!! Html::script('js/plugins/codemirror/mode/xml/xml.js') !!} 

<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();


    });
</script>
@endsection