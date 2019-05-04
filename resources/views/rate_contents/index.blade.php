@extends('layouts.master')

@section('title', 'Settings')

@section('styles')

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
                            <li class="{{Request::path() == 'rates' ? 'active' : '' }}"><a href="/rate">Employee Rate</a></li>
                            <li class="{{Request::path() == 'deductions' ? 'active' : '' }}"><a href="/deductions">Deductions</a></li> 
                        </ul>
                        <div class="tab-content">
                            <div id="compensation" class="tab-pane {{ Request::path() == 'rates' ? 'active' : '' }}">
                                <div class="panel-body">
                                    @include('rate_contents.rates')
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
<script>
    
    $(document).ready(function(){


    });

   
    
</script>
@endsection