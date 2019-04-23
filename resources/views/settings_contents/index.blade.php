@extends('layouts.master')

@section('title', 'Settings')

@section('styles')

@endsection
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Settings</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/">Settings</a>
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
                            <li class="{{Request::path() == 'settings' ? 'active' : '' }}"><a href="/rate">Employee's Rate</a></li>
                            
                        </ul>
                        <div class="tab-content">
                            <div id="compensation" class="tab-pane {{ Request::path() == 'settings' ? 'active' : '' }}">
                                <div class="panel-body">
                                    
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