@extends('layouts.master')

@section('title', 'Settings')

@section('styles')
<style>
    .theme-slide img {
        max-height: 200px;
        max-width: 300px;
        border-radius: 25px;
        padding: 5px;
        float: left;
    }

    .theme-slide p button {
        vertical-align: bottom;
    }

    .slick-slide {
        outline: none;
    }

</style>

{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style("css/plugins/slick/slick.css") !!}
{!! Html::style("css/plugins/slick/slick-theme.css") !!}
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
                        </ul>
                        <div class="tab-content">
                            <div id="compensation" class="tab-pane {{ Request::path() == 'settings/app' || Request::path() == "settings" ? 'active' : '' }}">
                                <div class="panel-body">
                                    @include('settings_contents.application')
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
{!! Html::script("js/plugins/slick/slick.min.js") !!}
<script>
    
    $(document).ready(function(){

        $(".migrationTable").DataTable({
            pageLength: 10, 
            language: {
                paginate: {
                    previous: '<i class="fas fa-arrow-left"></i>',
                    next: '<i class="fas fa-arrow-right"></i>',
                }
            },
       });

        $(".theme-slide").slick();

    });
    
</script>
@endsection