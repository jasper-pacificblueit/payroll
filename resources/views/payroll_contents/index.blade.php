@extends('layouts.master')

@section('title', 'Payroll')

@section('styles')

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

                <div class="col-lg-12">
                        <div class="tabs-container">
                            <ul class="nav nav-tabs">
                                <li class="{{Request::path() == 'payroll' ? 'active' : '' }}"><a href="/payroll">Compensation</a></li>
                                <li class="{{Request::path() == 'holiday' ? 'active' : '' }}"><a href="/holiday">Holiday Pay</a></li>
                            </ul>

                          

                            <div class="tab-content">
                                <div id="compensation" class="tab-pane {{ Request::path() == 'payroll' ? 'active' : '' }}">
                                    <div class="panel-body">
                                        @include('payroll_contents.compensation')
                                    </div>
                                </div>
                                <div id="compensation" class="tab-pane {{ Request::path() == 'holiday' ? 'active' : '' }}">
                                    <div class="panel-body">
                                        @include('payroll_contents.holiday')
                                    </div>
                                </div>

                               
                            </div>
    
    
                        </div>
                    </div>
           
        </div>
    </div>
    

    
@endsection

@section('scripts')

<script>
        $(document).ready(function(){
            
         
        });

    </script>

@endsection