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
                    Dashboard
                </li>
                <li class="{{ Request::path() == 'settings/app' || Request::path() == 'settings' ?: "hidden" }}">
                    <strong>Application Settings</strong>
                </li>
                <li class="{{ Request::path() == 'settings/user' ?: "hidden" }}">
                    <strong>User Settings</strong>
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
                            <li class="{{Request::path() == 'settings/app' || Request::path() == 'settings' ? 'active' : '' }}">
                            	<a href="/settings/app">Application Settings</a>
                            </li>
                            <li class="{{Request::path() == 'settings/user' ? 'active' : '' }}">
                            	<a href="/settings/user">User Settings</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="compensation" class="tab-pane {{ Request::path() == 'settings/app' || Request::path() == "settings" ? 'active' : '' }}">
                                <div class="panel-body">
                                    @include('settings_contents.application')
                                </div>
                            </div>
                            <div id="compensation" class="tab-pane {{ Request::path() == 'settings/user' ? 'active' : '' }}">
                                <div class="panel-body">
                                    @include('settings_contents.user')
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