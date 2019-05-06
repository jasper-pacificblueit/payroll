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
            <h2>Manage Positions</h2>
        </div>
    </div>
    <br>
    <div class="wrapper wrapper-content no-padding">
        <div class="wrapper wrapper-content no-padding">

             <div class="row">
                <div class="col-lg-12">
                    <div class="tabs-container">
                        <ul class="nav nav-tabs">
                            <li class="{{Request::path() == 'positions' ? 'active' : '' }}"><a href="/positions">Add Positions</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="compensation" class="tab-pane {{ Request::path() == 'positions' ? 'active' : '' }}">
                               <div class="panel-body">
                                    @include('positions_contents.main')
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

       

    });

   
    
</script>
@endsection