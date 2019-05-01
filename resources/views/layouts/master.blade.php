<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta id="_token" value="{{ csrf_token() }}">


    <title>@yield('title')</title>

    {{ Html::favicon('img/placeholder.jpg') }}

    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('font-awesome/css/font-awesome.css') !!}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    {!! Html::style('css/animate.css') !!}
    {!! Html::style('css/style.css') !!}
    {!! Html::style('css/plugins/steps/jquery.steps.css') !!}

    {!! Html::style('css/plugins/dropzone/basic.css') !!}
    {!! Html::style('css/plugins/dropzone/dropzone.css') !!}
    {!! Html::style('css/plugins/jasny/jasny-bootstrap.min.css') !!}
    {!! Html::style('css/plugins/codemirror/codemirror.css') !!}
    {!! Html::style('css/plugins/codemirror/codemirror.css') !!}

    @yield('styles')
</head>
@php

@endphp
<body class="skin-1">
@php
    
    $profile = App\Profile::where('user_id', auth()->user()->id)->first();
    $profile->image = (array)json_decode($profile->image);

@endphp
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <a class="dropdown-toggle">
                            <span class="clear">
                                <p class="text-muted text-xs">{!! App\User::$positions[auth()->user()->position] !!}</p>
                            </span>
                        </a>
                        <span>
                            <img alt="image" class="img-circle" src="{{ $profile->image['data'] }}" style='max-width: 75px'/>
                        </span>

                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">{{ App\Profile::getFullName(auth()->user()->id) }}</strong>
                                </span>
                                <span class="text-muted text-xs block">
                                    <b class="caret"></b>
                                </span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li>
                    <a onclick="window.location.href='/profile'"><i class="fa fa-user"></i> <span class="nav-label">Profile</span></a>
                            <li>
                                <a onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                  <span class="nav-label">Logout</span>
                                </a>
                            </li>  
                        </ul>
                    </div>
                    <div class="logo-element">
                        PMR
                    </div>
                </li>

                {{--side menus start--}}

                <li class="{!! if_uri_pattern(array('/')) == 1 ? 'active' : '' !!}">
                    <a href="/"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li>

                @can('dtr_read')
                @can('dtr_write')
                <li class="{{ Request::path() == 'dtr' || Request::path() == 'dtr/view' ? 'active' : '' }}">
                    <a href="/dtr"><i class="fa fa-calendar"></i> <span class="nav-label">Date Time Record</span></a>
                </li>
                @endcan
                @endcan
                <li class="{{ Request::path() == 'payroll' || Request::path() == 'payroll/create' ? 'active' : '' }}">
                    <a href="/payroll/create"><i class="fa fa-money"></i> <span class="nav-label">Payroll</span></a>
                </li>

                
                @if (count(App\Company::all()) > 0 && count(App\Department::all()) > 0)
                @can('company_read')
                <li class="{{ Request::path() == 'employee' || Request::path() == 'employee/add' ? 'active' : '' }}">
                        <a href="/employee"><i class="fa fa-users"></i> <span class="nav-label">Employee</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li class="{{ Request::path() == 'employee' ? 'active' : '' }}"><a href="/employee">View Employee</a></li>
                            @can('employee_write')
                               <li class="{{ Request::path() == 'employee/add' ? 'active' : '' }}"><a href="/employee/add">Add Employee</a></li>
                            @endcan
                        </ul>
                </li>
                @endcan
                @endif

               

                <li class="{{ Request::path() == 'position' ? 'active' : '' }}">
                    <a href="/positions"><i class="fa fa-user"></i> <span class="nav-label">Manage Positions</span></a>
                </li>

                <li class="{{ Request::path() == 'rates' ? 'active' : '' }}">
                    <a href="/rates"><i class="fa fa-money"></i> <span class="nav-label">Manage Rates</span></a>
                </li>


                @can('company_read')
                <li class="{{ Request::path() == 'company' ? 'active' : '' }}">
                        <a href="/company"><i class="far fa-building"></i> <span class="nav-label">Manage Company</span></a>
                </li>
                @endcan
               
                
              

                {{--side menus end--}}

            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">

        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars"></i></a>
                </div>
                
                <ul class="nav navbar-top-links navbar-right text-right">
                    
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <span class="text-muted">Logout</span><i class="fas fa-sign-out-alt" style="position: relative; top: 1px; left: 5px"></i>
                        </a>
                    </li>
                    
                </li>
                </ul>

            </nav>
        </div>

        <br>
            @yield('content')
      
        <br>
        <br>
        
        <div class="footer">
            <div class='text-right'>
                <strong>Powered By:</strong> <a href="https://www.pacificblueit.com" target="_blank" >Pacific Blue I.T. &copy; {{ Date('Y') }}</a>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

<!-- Mainly scripts -->

{!! Html::script('js/jquery-3.1.1.min.js') !!}
{!! Html::script('js/bootstrap.min.js') !!}
{!! Html::script('js/plugins/metisMenu/jquery.metisMenu.js') !!}
{!! Html::script('js/plugins/slimscroll/jquery.slimscroll.min.js') !!}
{!! Html::style('css/plugins/sweetalert/sweetalert.css') !!}


@yield('scripts')

</body>
</html>