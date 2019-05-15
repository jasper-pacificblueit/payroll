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
@guest
@else
@php
    $config = json_decode(auth()->user()->settings->settings);
@endphp
@endguest
<body class="@guest @else{{ $config->skin }}@endguest"> 
@guest
@else
@php
    $profile = App\Profile::where('user_id', auth()->user()->id)->first();
    $profile->image = (array)json_decode($profile->image);
@endphp
@endguest
<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        @guest
                            <span>
                                <img alt="image" class="img-responsive" src="/img/a4.jpg" 
                                    style='max-width: 75px; position: relative; left: 47px; border-radius: 100%; border: 2px; height: 66px'/>
                            </span>
                        @else
                        <span>
                            <img alt="image" class="img-responsive" src="{{ $profile->image['data'] }}" 
                                style='max-width: 75px; position: relative; left: 47px; border-radius: 100%; border: 2px;'/>
                        </span>
                        @endguest

                        @guest
                        @else
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">@guest @else{{ App\Profile::getFullName(auth()->user()->id) }}@endguest</strong>
                                </span>
                                <span class="text-muted text-xs block">
                                    <b class="caret"></b>
                                </span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li>
                                <a onclick="window.location.href='/profile'"><i class="fa fa-user"></i> <span class="nav-label">My Profile</span></a>
                            </li>

                            <li>
                                <a onclick="window.location.href='/settings/app'"><i class="fa fa-cog"></i> <span class="nav-label">Settings</span></a>
                            </li>
                            
                            <li>
                                <a onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i>
                                  <span class="nav-label">Logout</span>
                                </a>
                            </li>  
                        </ul>
                        @endguest
                    </div>
                    <div class="logo-element">
                        PMR
                    </div>
                </li>

                {{--side menus start--}}

                <li class="{!! if_uri_pattern(array('/')) == 1 ? 'active' : '' !!}">
                    <a href="/"><i class="fa fa-th-large" style="width: 20px"></i><span class="nav-label">Dashboard</span></a>
                </li>

                @can ("dtr_View")
                <li class="{{ Request::path() == 'dtr' || Request::path() == 'dtr/view' ? 'active' : '' }}">
                    <a href="/dtr"><i class="fa fa-calendar" style="width: 20px"></i><span class="nav-label">Attendance</span></a>
                </li>
                @endcan

                @can ("payroll_View")
                <li class="{{ Request::path() == 'payroll' || Request::path() == 'payroll/create' ? 'active' : '' }}">
                    <a href="/payroll/create"><i class="fas fa-dollar-sign" style="width: 20px"></i></i><span class="nav-label">Payroll</span></a>
                </li>
                @endcan

                @can ("company_View")
                <li class="{{ Request::path() == 'company' ? 'active' : '' }}">
                    <a href="/company"><i class="far fa-building" style='width: 20px'></i><span class="nav-label">Companies</span></a>
                </li>
                @endcan

                @can ("employee_View")
                @if (count(App\Company::all()) > 0 && count(App\Department::all()) > 0)
                <li class="{{ Request::path() == 'employee' || Request::path() == 'employee/add' ? 'active' : '' }}">
                    <a href="/employee"><i class="fas fa-address-card" style="width: 20px"></i><span>Employees</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        @can ("employee_Create")
                        <li class="{{ Request::path() == 'employee/add' ? 'active' : '' }}"><a href="/employee/add"><i class="fas fa-user-plus" style="width: 20px"></i> Add</a></li>
                        @endcan

                        <li class="{{ Request::path() == 'employee' ? 'active' : '' }}"><a href="/employee"><i class="fa fa-users" style="width: 20px"></i> Manage</a></li>
                    </ul>
                </li>
                @endif
                @endcan

                @guest
                @else
                @php
                    function can ($perm) {
                        return auth()->user()->can($perm);
                    }
                @endphp
                @endguest

                @guest
                @else
                @if (can('rate_View') || can('deduction_View') || can('earning_View') || can('schedule_View') || can('position_View'))
                <li class="{{ in_array(Request::path(), ['rates', 'deductions', 'earnings', 'schedules', 'positions' , 'schedules']) ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-tasks"></i> <span class="nav-label">Management</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            @can ("rate_View")
                            <li class="{{ Request::path() == 'rates' ? 'active' : '' }}">
                                <a href="/rates"><i class="fa fa-money" style="width: 20px"></i>Rates</span></a>
                            </li>
                            @endcan

                            @can ("deduction_View")
                            <li class="{{ Request::path() == 'deductions' ? 'active' : '' }}">
                                <a href="/deductions"><i class="fas fa-level-down-alt" style="width: 20px"></i>Deductions</span></a>
                            </li>
                            @endcan

                            @can ("earning_View")
                            <li class="{{ Request::path() == 'earnings' ? 'active' : '' }}">
                                <a href="/earnings"><i class="far fa-chart-bar" style="width: 20px"></i>Earnings</span></a>
                            </li class="{{ Request::path() == 'earnings' ? 'active' : '' }}">
                            @endcan

                            @can ("schedule_View")
                            <li class="{{ Request::path() == 'schedules' ? 'active' : '' }}">
                                <a href="/schedules"><i class="far fa-clock" style="width: 20px"></i>Schedules</a>
                            </li>
                            @endcan

                            @can ("position_View")
                            <li class="{{ Request::path() == 'positions' ? 'active' : '' }}">
                                <a href="/positions"><i class="fa fa-user" style="width: 20px"></i>Positions</a>
                            </li>
                            @endcan
                        </ul>
                </li>

                <li class="{{ Request::path() == 'settings/app' || Request::path() == 'settings/user' ? 'active' : '' }} hidden-lg hidden-sm hidden-md">
                    <a href="/settings/app"><i class="fa fa-cogs" style="width: 20px"></i><span>Settings</span></a>
                </li>
                @endif
                @endguest

                {{--side menus end--}}

            </ul>
        </div>
    </nav>

    <div id="page-wrapper" class="gray-bg">

        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-success" href="#"><i class="fa fa-bars"></i></a>
                </div>
                
                <ul class="nav navbar-top-links navbar-right text-right">
                    @guest
                    <li>
                        <a href="{{ route('login') }}">
                            <span class="text-muted">Login</span><i class="fas fa-sign-out-alt" style="position: relative; top: 0.5px; left: 5px"></i>
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                            <span class="text-muted">Logout</span><i class="fas fa-sign-out-alt" style="position: relative; top: 0.5px; left: 5px"></i>
                        </a>
                    </li>
                    @endguest
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

{!! Html::script('js/inspinia.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/sweetalert/sweetalert.min.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/footable/footable.all.min.js') !!}
{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
{!! Html::script('js/plugins/codemirror/codemirror.js') !!}
{!! Html::script('js/plugins/codemirror/mode/xml/xml.js') !!}

<!-- Jasny -->
{!! Html::script('js/plugins/jasny/jasny-bootstrap.min.js') !!}


@yield('scripts')

<script>
    window.addEventListener("mouseover", _ => {});
    window.addEventListener("mousedown", _ => {});
    window.addEventListener("mouseup", _ => {});
</script>

</body>
</html>