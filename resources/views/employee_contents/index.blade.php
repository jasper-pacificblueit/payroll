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
                            <div class="col-sm-5 m-b-xs">
                                <h4>Select Company</h4>
                                <select class="input-sm form-control input-s-sm inline">
                                    @foreach ($company as $i)
                                        <option>{{$i->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-sm-3">
                                <h4>&nbsp;</h4>
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
                                                {{  sprintf('%s %s %s',
                                                        App\Profile::where('user_id', $em->user_id)->first()['fname'],
                                                        App\Profile::where('user_id', $em->user_id)->first()['lname'],
                                                        App\Profile::where('user_id', $em->user_id)->first()['mname']
                                                    )
                                                }}
                                                </td>
                                                
                                                <td>
                                                    {{ App\Department::where('id', $em->department_id)->first()['name'] }}
                                                </td>
                                                <td>
                                                    {{ App\Profile::where('user_id', $em->user_id)->first()['email'] }}
                                                </td>
                                                <td>
                                                    {{ App\User::where('id', $em->user_id)->first()['position'] }}
                                                </td>
                                                <td><a href="#" class="btn btn-default btn-xs">Manage</a></td>
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
    
@endsection


@section('scripts')

    <script>
        $(document).ready(function() {

        });
    </script>

@endsection