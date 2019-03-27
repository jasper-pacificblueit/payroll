@extends('layouts.master')

@section('title', 'Attendance Report')


@section('content')
@if(isset($csv_info))
@php
    dd($csv_info);
@endphp
@endif

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
                                <h1 align='center'>Attendance Report</h1>
                                <label>Period : </label> {{ $csv_info->period }}
                                <br>
                                <label>Printed : </label> {{ $csv_info->printed }}
                                <br>
                                <table class="table table-striped table-bordered table-hover dataTables-example dataTable" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info" role="grid" style='margin-top: 15px'>
                    <thead>
                    <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 95px;">Biometric ID
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 100px;">Employee Name
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 100px;">Department
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 100px;">Date
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 93px;">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
{{----}}
@foreach($csv_info->employees as $emrec)
<tr>
    <td>{{ $emrec->bio_id }}</td>
    <td>{{ ucwords(strtolower($emrec->name)) }}</td>
    <td>{{ $emrec->dep }}</td>
    <td>{{ $emrec->date }}</td>
</tr>
@endforeach
{{----}}
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