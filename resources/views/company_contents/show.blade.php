@extends('layouts.master')

@section('title', 'Company')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Company</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/">Dashboard</a>
                </li>

                <li>
                    <a href="/company">View Companies</a>
                </li>
                <li>
                    <a href="#"><strong>Manage Company</strong></a>
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
                            <div class="col-sm-5 m-b-xs">
                                <h4>{{$company -> name}}</h4>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addDepartment">
                                    Add Department
                                </button>
                                <div class="modal inmodal fade" id="addDepartment" tabindex="-1" role="dialog"  aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                   <h4 style="padding:10px">Add Department</h4>
                                                </div>
                                                <div class="modal-body">
                                                   <div class="row">
                                                       <div class="col-lg-12">
                                                            <form method="POST" action="/company/{{$company->id}}/department">
                                                                {{ csrf_field() }}
                                                                <label>Department Name</label>
                                                                <input type="text" name="name" class="form-control" required>
                                                       </div>
                                                   </div>
                                                </div>
        
                                                <div class="modal-footer">
                                                    <div class='btn-group'>
                                                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success" name="submit">Create</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            
                            <div class="col-sm-3 pull-right">
                                <h4>&nbsp;</h4>
                                <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-success"> Go!</button> </span></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Deparment ID</th>
                                        <th>Department name</th>
                                        <th>No. of Employee</th>  
                                        <th>Action</th>  
                                    </tr>
                                </thead>

                                <tbody>
                                   @if (count($company->departments) > 0)
                                    
                                    @foreach ($company->departments as $department)
                                        <tr>
                                            <td>{{$department -> id}}</td>
                                            <td>{{$department -> name}}</td>
                                            <td>{{count($department->getEmployee())}}</td>
                                            <td><button class="btn btn-default btn-xs">Details</button></td>
                                        </tr>
                                    @endforeach
                                   
                                   @else
                                    <tr>
                                        <td colspan="4">No Departments yet</td>
                                    </tr>
                                   @endif

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