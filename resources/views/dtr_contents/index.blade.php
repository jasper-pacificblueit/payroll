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
                            
                            @if(isset($data))
                                <div class="row">'
                                    <div class="col-lg-12">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td>ID number</td>
                                                <td>Date</td>
                                                <td colspan="2" style="text-align: center">AM</td>
                                                <td colspan="2" style="text-align: center">PM</td>
                                                
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td style="text-align: center">IN</td>
                                                <td style="text-align: center">OUT</td>
                                                <td style="text-align: center">IN</td>
                                                <td style="text-align: center">OUT</td>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($data) > 0)
                                                @foreach($data as $j)
                                                    <tr>
                                                        <td>{{ $j['user_id'] }}</td>
                                                        <td>{{ $j['date'] }}</td>
                                                        <td style="text-align: center">{{ $j['in_am'] }}</td>
                                                        <td style="text-align: center">{{ $j['out_am'] }}</td>
                                                        <td style="text-align: center">{{ $j['in_pm'] }}</td>
                                                        <td style="text-align: center">{{ $j['out_pm'] }}</td>
                                                        
                                                        
                                                        

                                                    </tr>
                                                       
                                                @endforeach
                                            @else
                                            <td>No Record</td>
                                            @endif
                                            </tbody>
                                        </table>

                                        <hr>
                                        <a href="/dtr" class="btn btn-default">Cancel</a>  


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
                                                <span class="fileinput-exists">Change</span><input type="file" name="upload-file"/></span>
                                                <span class="fileinput-filename"></span>
                                                <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">×</a>
                                            </div> 
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


@section('scripts')
{!! Html::script('js/plugins/footable/footable.all.min.js') !!}
 

<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });

</script>

@endsection