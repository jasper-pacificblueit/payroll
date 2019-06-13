@extends('layouts.master')

@section('title', 'Settings')

@php

    $settings = App\Settings::where("user_id", "=", auth()->user()->id)->first();

    $settings = json_decode($settings->settings);

@endphp

@section('styles')
<style>
    #theme-slider div img {
        max-height: 200px;
        max-width: 300px;
        border-radius: 25px;
        border: solid #23c6c8;
        padding: 5px;
        margin: auto;
    }

    .slick-slider {
        text-align: center;
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
                            	<a href="/settings/app">Settings</a>
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

       $("#theme-slider").slick({
            initialSlide: 
            @php
                if ($settings->skin == "") echo 0;
                else if ($settings->skin == "skin-1") echo 1;
                else if ($settings->skin == "skin-2") echo 2;
                else if ($settings->skin == "skin-2") echo 3;
                else echo 1;
            @endphp,
       });

       document.querySelector("#theme-slider div#{{ $settings->skin == "" ? "default" : $settings->skin }} h4").innerHTML += " <span class='badge badge-success'>Applied</span>";

       document.querySelector("#theme-slider div#{{ $settings->skin == "" ? "default" : $settings->skin }} a").classList.add("disabled");

       document.querySelector("#theme-slider").style.visibility = "visible";

    });

    prevApplied = "{{ $settings->skin == "" ? "default" : $settings->skin }}";

    function applyStyle(style) {
        document.querySelector(`#theme-slider div#${prevApplied} h4`).children[0].remove();
        document.querySelector(`#theme-slider div#${prevApplied} a`).classList.remove("disabled");

        document.querySelector(`#theme-slider div#${style} h4`).innerHTML += " <span class='badge badge-success'>Applied</span>";
        document.querySelector(`#theme-slider div#${style} a`).classList.add("disabled");

        document.body.classList.remove(prevApplied);
        document.body.classList.add(style);

        document.querySelector("input[name=skin]").value = style;


        prevApplied = style;
    }
    
</script>
@endsection