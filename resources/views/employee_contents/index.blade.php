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
    <div class="wrapper wrapper-content animated fadeInRight no-padding">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                   
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-4 m-b-xs">
                                <h4>Select Company</h4>
                                <select class="input-sm form-control input-s-sm inline cur-company" onchange="changedep()">
                                    @foreach ($company as $i)
                                    <template id='company-id-{{$i->id}}'>
                                        @foreach (App\Department::where('company_id', $i->id)->get() as $dep)
                                            <option value={{ $dep->name }}>
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
                                <select class="input-sm form-control input-s-sm inline cur-dep">
                                    @foreach (App\Department::where('company_id', 1)->get() as $i)
                                        <option>{{$i->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-lg-5">
                                <span class='hidden-md hidden-sm hidden-xs'><h4>&nbsp;</h4></span>
                                <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary">Go!</button> </span></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee username</th>
                                        <th>Employee name</th>
                                        <th>Department</th>
                                        <th>E-mail</th>
                                        <th>Position</th>  
                                        <th>Action</th>  
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <!--fixed-->
                                    @foreach($company as $i)
                                        @foreach($i->employees as $em)
                                            <tr>
                                                <td>{{ $em->id }}</td>
                                                <td>{{ App\User::where('id', $em->user_id)->first()['user'] }}</td>
                                                <td>
                                                {{ App\Profile::getFullName($em->user_id) }}
                                                </td>
                                                
                                                <td>
                                                    {{ App\Department::where('id', $em->department_id)->first()['name'] }}
                                                </td>
                                                <td>
                                                    {{ App\Profile::where('user_id', $em->user_id)->first()['email'] }}
                                                </td>
                                                <td>
                                                    {{ App\User::$positions[App\User::where('id', $em->user_id)->first()['position']] }}
                                                </td>
                                                <td>
                                                <button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#manageEmployee-{{ $em->user_id }}">
                                                    Manage
                                                </button>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

<!-- manage employees modal -->
@foreach ($company as $j)
@foreach ($j->employees as $em)
<div class="modal inmodal fade" id="manageEmployee-{{ $em->user_id }}" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               <h4 style="padding:10px">{{ App\Profile::getFullName($em->user_id) }}</h4>
               
            </div>
            <form method="POST" action="/company">
            <div class="modal-body">
               <div class="row">
                   <div class="col-lg-12">
                        
                            {{ csrf_field() }}
                            <label>Company Name</label>
                            <input type="text" name="name" class="form-control" required>
                            <br>
                            <label>Address</label>
                            <input type="text" name="address" class="form-control" required>
                   </div>
               </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endforeach
    
@endsection


@section('scripts')

    <script>
        $(document).ready(function() {

        });


        let changedep = () => {

            let com_id = '#company-id-' + document.querySelector('.cur-company').value;
            let clone = document.querySelector(com_id).content.cloneNode(1);

            document.querySelector('.cur-dep').innerHTML = "";

            document.querySelector('.cur-dep').appendChild(clone);

        };
    </script>

@endsection