@extends('layouts.master')

@section('title', 'Settings')

@section('styles')

{!! Html::style('font-awesome/css/font-awesome.css') !!}
{!! Html::style('css/plugins/iCheck/custom.css') !!}

@endsection
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Rates</h2>
           
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
                            
                           
                        </div>


                    </div>
                </div>
       
             </div>
        </div>
    </div>
    

    
@endsection

@section('scripts')


{!! Html::script('js/plugins/iCheck/icheck.min.js') !!}



<script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
</script>
@endsection