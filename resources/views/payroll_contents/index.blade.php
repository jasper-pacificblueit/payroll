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
            <h2>Manage Payroll</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/">Dashboard</a>
                </li>
                <li class="">
                    <a href="/"><strong>Compensation</strong></a>
                </li>
               
               
            </ol>
        </div>
    </div>
    <br>
    <div class="wrapper wrapper-content no-padding">
        <div class="wrapper wrapper-content no-padding">

             <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="{{Request::path() == 'payroll' ? 'active' : '' }}"><a href="/payroll">Compensation</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="compensation" class="tab-pane {{ Request::path() == 'payroll' ? 'active' : '' }}">
                                <div class="panel-body">
                                        @if (isset($status))
                                        <div class="alert alert-{{$status}}">
                                            ?
                                        </div>
                                        @endif
                                    @include('payroll_contents.compensation')
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
<!-- Custom and plugin javascript -->
{!! Html::script('js/inspinia.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/sweetalert/sweetalert.min.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/footable/footable.all.min.js') !!}

{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
{!! Html::script('js/plugins/select2/select2.full.min.js') !!}
{!! Html::script('js/plugins/daterangepicker/daterangepicker.js') !!}
{!! Html::script('js/plugins/datapicker/bootstrap-datepicker.js') !!}
{!! Html::script('js/plugins/iCheck/icheck.min.js') !!}

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
        $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });
           
            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

       

    });

   
    
</script>
@endsection