@extends('layouts.master')

@section('title', 'Attendance Report')

@section('styles')
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/sweetalert/sweetalert.css') !!}
{!! Html::style('css/plugins/select2/select2.min.css') !!}
{!! Html::style('css/plugins/jasny/jasny-bootstrap.min.css') !!}
@endsection

@section('content')
<script>
 
</script>
<?php
    function GetDays($sStartDate, $sEndDate){  
            // Firstly, format the provided dates.  
            // This function works best with YYYY-MM-DD  
            // but other date formats will work thanks  
            // to strtotime().  
            $sStartDate = date("Y-m-d", strtotime($sStartDate));  
            $sEndDate = date("Y-m-d", strtotime($sEndDate));  

            // Start the variable off with the start date  
            $aDays[] = $sStartDate;  

            // Set a 'temp' variable, sCurrentDate, with  
            // the start date - before beginning the loop  
            $sCurrentDate = $sStartDate;  

            // While the current date is less than the end date  
            while($sCurrentDate < $sEndDate) {  
            // Add a day to the current date  
                $sCurrentDate = date("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));  

                // Add this new day to the aDays array  
                $aDays[] = $sCurrentDate;  
            }

            // Once the loop has finished, return the  
            // array of days.  
            return $aDays;  
   }  
        
  
?>


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Attendance</h2>
            <ol class="breadcrumb">
                <li class="active">
                    Dashboard
                </li>
                <li>
                    Daily Time Records
                </li>
                
                <li>
                    <strong>Import Attendance</strong>
                </li>
               
            </ol>
        </div>
    </div>
    <br>
   <div class="row">

        <div class="wrapper wrapper-content no-padding">
                <div class="wrapper wrapper-content no-padding">
        
                        <div class="col-lg-12">
                                <div class="tabs-container">
                                    <ul class="nav nav-tabs">
                                        <li class="{{ Request::path() == 'dtr' || Request::path() == 'dtr/view' ? 'active' : '' }}"><a href="/dtr"> Import Attendance</a></li>
                                        <li class="{{Request::path() == 'dtr-records' ? 'active' : '' }}"><a href="/dtr-records">History</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="import" class="tab-pane {{ Request::path() == 'dtr' || Request::path() == 'dtr/view' ? 'active' : '' }}">
                                            <div class="panel-body">
                                                @if (isset($result))
                                                <div class="alert alert-danger">
                                                    File already imported <a class="alert-link" href="#">Alert Link</a>.
                                                </div>
                                                @endif
                                                @include('dtr_contents.import')
                                            </div>
                                        </div>
                                        <div id="tab-2" class="tab-pane {{ Request::path() == 'dtr-records' ? 'active' : '' }} ">
                                            <div class="panel-body">

                                                  @if (isset($_GET['result']))
                                                    @if ($_GET['result']=='success')
                                                        <div class="alert alert-success">
                                                                <a class="alert-link" href="#">Attendance imported successfully!</a>.
                                                        </div>
                                                    @else
                                                        <div class="alert alert-warning">
                                                                <a class="alert-link" href="#">Employee's attendance has been override! </a>
                                                        </div>
                                                        
                                                    @endif
                                                @endif
                                                @include('dtr_contents.records')
                                            </div>
                                        </div>
                                    </div>
            
            
                                </div>
                            </div>
                   
                </div>
            </div>
            
   </div>
@endsection

@section('scripts')

{!! Html::script('js/plugins/select2/select2.full.min.js') !!}

<script>
        function DateSelect(str){
            if (str.length==0) { 
                try {
                document.getElementById("showEmp").innerHTML="";
                document.getElementById("showEmp").style.border="0px";
                } catch (e) {};                
                return;
            }
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                document.getElementById("tableBody").innerHTML=this.responseText;
                document.getElementById("tableBody").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET","selectDate?q="+str,true);
            xmlhttp.send();
        }
      

        DateSelect(document.getElementById('DateSelector').value);

        $(document).ready(function(){
                
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ":not(#excludedcolumn)",
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ":not(#excludedcolumn)",
                        }
                    },
                    {
                        extend: 'excel', 
                        title: 'ExampleFile',
                    },
                    {
                        extend: 'pdf', 
                        title: 'ExampleFile',
                        exportOptions: {
                            columns: ":not(#excludedcolumn)",
                        }
                    },

                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        },
                        exportOptions: {
                            columns: ":not(#excludedcolumn)",
                        }
                    },
                ],
                language: {
                    paginate: {
                        previous: '<i class="fas fa-arrow-left"></i>',
                        next: '<i class="fas fa-arrow-right "></i>',
                    }
                },
                
            });

            $(".select2_demo_1").select2();
        });  
    </script>
@endsection