@extends('layouts.master')

@section('title', 'Company')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Company</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a href="/company">Dashboard</a>
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
                            <div class="col-sm-12 m-b-xs col-12">
                                <h4>{{$company -> name}}</h4>
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addDepartment">
                                    Add Department
                                </button>
                                <button class="btn btn-sm btn-danger pull-right">
                                    Remove
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
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date Created</th>
                                        <th>Department name</th>
                                        <th>No. of Employee</th>  
                                        <th></th>  
                                    </tr>
                                </thead>

                                <tbody>
                                   @if (count($company->departments) > 0)
                                    @foreach ($company->departments as $department)
                                        <tr ondblclick="$('#pop_info-{{ $department->id }}').click()">
                                            <td>{{$department->created_at}}</td>
                                            <td>{{$department->name}}</td>
                                            <td>{{count($department->getEmployee())}}</td>
                                            <td>
                                                <button class="btn btn-default btn-xs" onclick="pop_modal({{ $department->id }})" id="pop_info-{{ $department->id }}">Manage</button>
                                            </td>
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
    <span id="modal-panel"></span>
@endsection


@section('scripts')

    <script>
        $(document).ready(function() {
            
        });

        async function pop_modal(id) {

            document.querySelector("#pop_info-" + id).disabled = true;

            fetch('/department/' + id, {
                method: 'get',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                }
            }).then(rep => rep.text()).then(html => {

                document.querySelector('#modal-panel').innerHTML = html;
                $('#manage').modal('toggle');

            });
        }

    </script>

@endsection