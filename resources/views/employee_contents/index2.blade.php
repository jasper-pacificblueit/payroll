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
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-4 m-b-xs">
                                <h4>Select Company</h4>
                                <select class="input-sm form-control input-s-sm inline cur-company" onchange="changecom()">
                                    @foreach ($company as $i)
                                    <template id='company-id-{{$i->id}}'>
                                        @foreach (App\Department::where('company_id', $i->id)->get() as $dep)
                                            <option value={{ $dep->id }}>
                                                {{ $dep->name }}
                                            </option>
                                        @endforeach
                                    </template>
                                        <option value="{{ $i->id }}">{{$i->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-3 m-b-xs">
                                <h4>Select Department</h4>
                                <select class="input-sm form-control input-s-sm inline cur-dep" onchange="changedep()">
                                    @foreach (App\Department::where('company_id', 1)->orderBy('name', 'asc')->get() as $i)
                                        <option value={{ $i->id }}>{{$i->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-lg-5">
                                <span class='hidden-md hidden-sm hidden-xs'><h4>&nbsp;</h4></span>
                                <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control" oninput="search(this)"><span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-success">Go!</button> </span></div>
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
                                        <th>Manage</th>      
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
                                                <td>{{ App\Profile::where('user_id', $em->user_id)->first()['email'] }}</td>
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
                       <div class="col-lg-4 col-12">
                        @can('employee_write')
                            <label>Change Position</label>
                            <select class='form-control' name="position">
                                <option value='hr'>HR</option>
                                <option value='employee'>Employee</option>
                            </select>
                        @endcan
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

    <!-- manage employee rates modal -->
    @foreach($company as $j)
    @foreach($j->employees as $em)
    <div class="modal fade" id="ratesEmployee-{{ $em->user_id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               <h4 style="padding:10px">Rates</h4>
               
            </div>
            <form method="POST" action="">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="modal-body">
                   <div class="row">
                       <div class="col-lg-12"></div>
                   </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
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


    let changecom = () => {

        let com_id = '#company-id-' + document.querySelector('.cur-company').value;
        let clone = document.querySelector(com_id).content.cloneNode(1);

        document.querySelector('.cur-dep').innerHTML = "";
        document.querySelector('.cur-dep').appendChild(clone);

        document.querySelector('.usertables').innerHTML = "";
        
        let dep_data_clone = 
            document.querySelector('#dep-id-' + document.querySelector('.cur-dep').value)
                .content.cloneNode(1);

        document.querySelector('.usertables').appendChild(dep_data_clone);

    };

    let changedep = () => {

        document.querySelector('.usertables').innerHTML = "";
        
        let dep_data_clone = 
            document.querySelector('#dep-id-' + document.querySelector('.cur-dep').value)
                .content.cloneNode(1);

        document.querySelector('.usertables').appendChild(dep_data_clone);

    };

    var o;
    function search(obj) {
        clearTimeout(o);

        o = setTimeout( function() {
            var result = document.createElement("span"),
                utb = Object.values(document.querySelector(".usertables").rows);

            utb.forEach(function(k) {
                if (obj.value.toLowerCase().trim() == k.children[1].innerText.toLowerCase() ||
                    k.children[1].innerText.toLowerCase().includes(obj.value.toLowerCase().trim()))
                    result.appendChild(k);
            }); 

            document.querySelector(".usertables").innerHTML = "";
            document.querySelector(".usertables").innerHTML = result.innerHTML;

            if (obj.value == "") changedep();
            else if (document.querySelector(".usertables").innerHTML == "") changedep();
        }, 500);
    }
</script>
@endsection