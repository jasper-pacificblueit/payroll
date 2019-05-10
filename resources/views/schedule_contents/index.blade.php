@extends('layouts.master')

@section('title', 'Payroll')

@section('styles')


{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/select2/select2.min.css') !!}
{!! Html::style('css/plugins/daterangepicker/daterangepicker-bs3.css') !!}
{!! Html::style('css/plugins/datapicker/datepicker3.css') !!}
{!! Html::style('css/plugins/iCheck/custom.css') !!}

@endsection
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Schedules</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a>Dashboard</a>
                </li>
                <li class="">
                    <a href="/"><strong>Schedules</strong></a>
                </li>
            </ol>
        </div>
    </div>
    <br>
    <div class="wrapper wrapper-content no-padding">
        <div class="wrapper wrapper-content no-padding">

             <div class="row">
                <div class="col-lg-12">
                   <div class="i-box">
                       <div class="ibox-content">
                          <div class="row">
                              <div class="col-lg-3">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addDeduction">Add Custom</button>
                              </div>
                          </div>
                          <br>
                          <div class="row">
                              <div class="col-lg-12">
                                    <div class="table-responsive">
                                            <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Schedule Type</th>
                                                       
                                                        <th>Department</th>
                                                        <th>Time in <small>(am)</small></th>
                                                        <th>Time out <small>(am)</small></th>
                                                        <th>Time in <small>(pm)</small></th>
                                                        <th>Time out <small>(pm)</small></th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                     
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                             </table>
                                    </div>
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

   

{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
{!! Html::script('js/plugins/select2/select2.full.min.js') !!}
{!! Html::script('js/plugins/daterangepicker/daterangepicker.js') !!}
{!! Html::script('js/plugins/datapicker/bootstrap-datepicker.js') !!}
{!! Html::script('js/plugins/iCheck/icheck.min.js') !!}

<script>
    
    $(document).ready(function(){
        
        //    var call=localStorage.getItem('desc');
        //    var data={call}
        //         console.log(JSON.parse(call).name);
    
            $(".select2_demo_1").select2();
                $(".select2_demo_2").select2();
                $(".select2_demo_3").select2({
                    placeholder: "Select a state",
                    allowClear: true
                });
               
              $('.dataTables-example').DataTable({
                pageLength: 25,
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

    
           
    
        });
   
    
</script>
@endsection