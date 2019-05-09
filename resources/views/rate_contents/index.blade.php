@extends('layouts.master')

@section('title', 'Settings')

@section('styles')

{!! Html::style('font-awesome/css/font-awesome.css') !!}
{!! Html::style('css/plugins/iCheck/custom.css') !!}
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/select2/select2.min.css') !!}
{!! Html::style('css/plugins/daterangepicker/daterangepicker-bs3.css') !!}
{!! Html::style('css/plugins/datapicker/datepicker3.css') !!}

@endsection
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Management</h2>
        </div>
    </div>
    <br>
    <div class="wrapper wrapper-content no-padding">
        <div class="wrapper wrapper-content no-padding">

             <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="{{Request::path() == 'rates' ? 'active' : '' }}"><a href="/rates">Employees Rate</a></li>
                            <li class="{{Request::path() == 'deductions' ? 'active' : '' }}"><a href="/deductions">Deductions</a></li>
                            <li class="{{Request::path() == 'earnings' ? 'active' : '' }}"><a href="/earnings">Earnings</a></li>
                            <li class="{{Request::path() == 'schedules' ? 'active' : '' }}"><a href="/schedules">Schedules</a></li>
                            <li class="{{Request::path() == 'positions' ? 'active' : '' }}"><a href="/positions">Positions</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="compensation" class="tab-pane {{ Request::path() == 'rates' ? 'active' : '' }}">
                                <div class="panel-body">

                                    @include('rate_contents.rates')
                                </div>
                            </div>
                            <div id="compensation" class="tab-pane {{ Request::path() == 'deductions' ? 'active' : '' }}">
                                <div class="panel-body">

                                    @include('rate_contents.deductions')
                                </div>
                            </div>
                            <div id="compensation" class="tab-pane {{ Request::path() == 'earnings' ? 'active' : '' }}">
                                <div class="panel-body">
                            
                                    @include('rate_contents.earnings')
                                </div>
                            </div>
                            <div id="compensation" class="tab-pane {{ Request::path() == 'schedules' ? 'active' : '' }}">
                                <div class="panel-body">

                                    @include('rate_contents.earnings')
                                </div>
                            </div>
                            <div id="compensation" class="tab-pane {{ Request::path() == 'positions' ? 'active' : '' }}">
                                <div class="panel-body">
                                    @include('positions_contents.index')
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

       $(".positionTable").DataTable({
            pageLength: 10,
            language: {
                paginate: {
                    previous: '<i class="fas fa-arrow-left"></i>',
                    next: '<i class="fas fa-arrow-right"></i>',
                }
            },
       });

    });

   
    
</script>
@endsection