@extends('layouts.master')

@section('title', 'Employee')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Employee</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/">Dashboard</a>
                </li>
                <li>
                    <a href="/employee"><strong>Manage Employee</strong></a>
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
                            <li class="{{Request::path() == 'employee' ? 'active' : '' }}"><a href="/employee">Manage Employees</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="employee" class="tab-pane {{ Request::path() == 'employee' ? 'active' : '' }}">
                                <div class="panel-body">
                                       
                                    @include('employee_contents.view_employee')
                                </div>
                            </div>
                           
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Employee name</th>
                                        <th>Department</th>
                                        <th>E-mail</th>
                                        <th>Position</th>
                                        <th>Management</th>      
                                    </tr>
                                </thead>
                                <tbody class='usertables'>
                                    <!--fixed-->
                                    @foreach(App\Employee::where('department_id', App\Department::where('company_id', 1)->orderBy('name', 'asc')->get()[0]->id)->get() as $em)
                                        @if (auth()->user()->id != $em->user_id)
                                            @if (App\User::find($em->user_id)['position'] != auth()->user()->position)
                                            <tr>
                                                <td>{{ $em->user_id }}</td>
                                                <td>{{ App\Profile::getFullName($em->user_id) }}</td>
                                                <td>{{ App\Department::find($em->department_id)->name }}</td>
                                                <td>{{ App\User::find($em->user_id)->email }}</td>
                                                <td>{{ App\User::$positions[App\User::find($em->user_id)['position']] }}</td>
                                                <td>
                                                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#settingEmployee-{{ $em->user_id }}">
                                                    Settings
                                                </button>
                                                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#ratesEmployee-{{ $em->user_id }}">
                                                    Others
                                                </button>
                                                </td>
                                            </tr>
                                            @endif
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

@can('employee_write')
    <!-- manage employee setting modal -->
    @foreach ($company as $j)
    @foreach ($j->employees as $em)
    <div class="modal fade" id="settingEmployee-{{ $em->user_id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               <h4 style="padding:10px">Settings</h4>
               
            </div>
            <form method="POST" action="/employee/{{ $em->user_id }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <label>Username: </label>
                            {{ App\User::find($em->user_id)['user'] }}
                        </div>
                        <div class="col-lg-6 col-12">
                            <label>Bio ID</label>
                            <input class="form-control" placeholder="--" value="{{ $em->bio_id }}" name="bio">
                        </div>
                    </div>
               <div class="row">
                    <div class="col-lg-6 col-12">
                        <label>Change Position: </label>
                        <select class='form-control' name="position">
                            <option value='hr'>HR</option>
                            <option value='employee'>Employee</option>
                        </select>
                    </div>
                    <div class="col-lg-6 col-12">
                        <label>Change Department</label>
                        <select class="form-control" name="chdep">
                            @foreach ($j->departments as $dep)
                                <option value="{{ $dep->id }}" {{ $dep->id == $em->department_id ? "selected" : "" }}>{{ $dep->name }}</option>
                            @endforeach
                        </select>
                    </div>
               </div>
               <hr>
                <div class="row">
                    <div class="col-lg-12">
                    </div>  
                </div>
                </div>

                <div class="modal-footer">
                    <div class='btn-group'>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
    @endforeach
    @endforeach

@endcan

<!-- usertables lists -->   
@foreach(App\Company::all() as $com)
@foreach($com->departments as $dep)
    <template id='dep-id-{{ $dep->id }}'>
    @foreach(App\Employee::where('department_id', $dep->id)->get() as $em)
        @if (auth()->user()->id != $em->user_id)
            @if (App\User::find($em->user_id)['position'] != auth()->user()->position)
                <tr>
                    <td>{{ $em->id }}</td>
                    <td>{{ App\Profile::getFullName($em->user_id) }}</td>
                    <td>{{ $dep->name }}</td>
                    <td>{{ App\User::find($em->user_id)['email'] }}</td>
                    <td>{{ App\User::$positions[App\User::find($em->user_id)['position']] }}</td>
                    <td>
                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#settingEmployee-{{ $em->user_id }}">
                            Settings
                        </button>
                        <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#ratesEmployee-{{ $em->user_id }}">
                            Rates
                        </button>
                    </td>
                </tr>
            @endif
        @endif
    @endforeach
    </template>
@endforeach
@endforeach

                    </div>
                </div>
       
             </div>
        </div>
    </div>
@endsection

@section('scripts')
<!-- Custom and plugin javascript -->
{!! Html::script('js/inspinia.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/sweetalert/sweetalert.min.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/footable/footable.all.min.js') !!}

<script>
    $(document).ready(function() {

    });


  
</script>
@endsection