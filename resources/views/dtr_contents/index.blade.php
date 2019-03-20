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
                                <div class="row">

                                    <div class="col-lg-12">
                                        <table class="table">
                                            
                                            
                                            <tbody>
                                                @foreach($data as $value)
                                               

                                                    <?php

                                                        for ($i=0; $i <count($value) ; $i++) { 
                                                            echo "<tr>";
                                                            for ($j=0; $j < count($value[0]) ; $j++) { 
                                                                echo "<td>".$value[$i][$j]." </td>";
                                                            }

                                                            echo "<tr>";

                                                        }
                                                    ?>

                                                @endforeach

                                              
                                         
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