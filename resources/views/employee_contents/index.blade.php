@extends('layouts.master')

@section('title', 'Employee')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Employee</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/employee"><strong>Employees</strong></a>
                </li>
                <li>
                    <a href="/employee/add">Add Employee</a>
                </li>
               
            </ol>
        </div>
    </div>
    <Br>
    <div class="wrapper wrapper-content animated fadeInRight" style="border:solid 1px #CCC;">
       View Employee
    </div>

@endsection


@section('scripts')

    <script>
        $(document).ready(function() {

        });
    </script>

@endsection