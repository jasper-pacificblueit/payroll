@extends('layouts.master')

@section('title', 'Attendance Report')


@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Attendance</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/">Dashboard</a>
                </li>
                <li>
                    <a href="/employee"><strong>View Attendance</strong></a>
                </li>
               
            </ol>
        </div>
    </div>
    <br>
    <div class="wrapper wrapper-content animated fadeInRight no-padding">
        <div class="wrapper wrapper-content animated fadeInRight no-padding">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                    
                        <div class="ibox-content">
                            
                            @if(isset($csv_info))
                             
                                <label>Period : {{date("M d" , strtotime($start))}} - {{date("M d Y" , strtotime($end))}}</label>
                                <br>
                                <label>Printed : </label> {{ $csv_info->printed }}
                                <br>
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                       <th>Employee</th>
                                        <?php
                                            $days = GetDays($start , $end);
                                        ?>

                                        @foreach ($days as $day)
                                            <th>{{date("d/D" , strtotime($day))}}<th>
                                            
                                        @endforeach
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($csv_info->employees as $employee)
                                            <tr>
                                                <td>{{ucwords(strtolower($employee->name))}}</td>
                                               

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="row">
                                    <div class="col-sm-3 m-b-xs">
                                        <h4>Import Attendance</h4>
                                        <form method="POST" action="/dtr/view" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <span class="btn btn-default btn-file"><span class="fileinput-new">Select file</span>
                                                <span class="fileinput-exists">Change</span><input type="file" name="upload-file"/></span>
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
@endsection

{!! Html::script('js/plugins/codemirror/mode/xml/xml.js') !!} 

@section('scripts')

<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();


    });
</script>
@endsection