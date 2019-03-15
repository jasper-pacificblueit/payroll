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
                                    <option value="0">Option 1</option>
                                    <option value="1">Option 2</option>
                                    <option value="2">Option 3</option>
                                    <option value="3">Option 4</option>
                                </select>
                            </div>
                            
                            <div class="col-sm-3">
                                <h4>&nbsp;</h4>
                                <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                                    <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Employee name</th>
                                        <th>Department</th>
                                        <th>E-mail</th>
                                        <th>Position</th>  
                                        <th>Action</th>  
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>0001</td>
                                        <td>Jose Rizal</td>
                                        <td>I.T. Department</td>
                                        <td>rizal@gmail.com</td>
                                        <td>Staff</td>
                                        <td><button class="btn btn-primary btn-xs">Update</button></td>
                                        
                                    </tr>

                                    <tr>
                                            <td>0001</td>
                                            <td>Jose Rizal</td>
                                            <td>I.T. Department</td>
                                            <td>rizal@gmail.com</td>
                                            <td>Staff</td>
                                            <td><button class="btn btn-primary btn-xs">Update</button></td>
                                            
                                        </tr>
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