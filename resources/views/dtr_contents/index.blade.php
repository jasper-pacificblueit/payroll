@extends('layouts.master')

@section('title', 'Attendance Report')

@section('styles')
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/sweetalert/sweetalert.css') !!}

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
                    <a href="/dtr">Daily Time Records</a>
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

                <div class="col-lg-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="{{ Request::path() == 'dtr' || Request::path() == 'dtr/view' ? 'active' : '' }}"><a href="/dtr"> Import Attendance</a></li>
                                <li class="{{Request::path() == 'dtr-records' ? 'active' : '' }}"><a href="/dtr-records">Records</a></li>
                            </ul>
                            <div class="tab-content">
                                <div id="import" class="tab-pane {{ Request::path() == 'dtr' || Request::path() == 'dtr/view' ? 'active' : '' }}">
                                    <div class="panel-body">
                                       
                                        @include('dtr_contents.import')
                                    </div>
                                </div>
                                <div id="tab-2" class="tab-pane {{ Request::path() == 'dtr-records' ? 'active' : '' }} ">
                                    <div class="panel-body">
                                        @include('dtr_contents.records')
                                    </div>
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

@section('scripts')


{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
{!! Html::script('js/inspinia.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/codemirror/codemirror.js') !!}
{!! Html::script('js/plugins/codemirror/mode/xml/xml.js') !!}

{!! Html::script('js/plugins/sweetalert/sweetalert.min.js') !!}

<script>
        $(document).ready(function(){
            
           
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                     customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                    }
                    }
                ]

            });

           
            $('.demo2').click(function(){
            swal({
                title: "Good job!",
                text: "You clicked the button!",
                type: "success"
            });
        });
        });

    </script>

{{-- 
    <script>
        jQuery(function(){
        jQuery('#Notif1').click();
        });
    </script> --}}
@endsection