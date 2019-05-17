@extends('layouts.master')

@section('title', 'Company')

@section("styles")
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
@endsection


@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Company</h2>
            <ol class="breadcrumb">
                <li>
                    Dashboard
                </li>
                <li>
                    View Companies
                </li>
                <li>
                    <strong>Manage Company</strong>
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
                                <h4 id="company_name">{{$company -> name}}</h4>
                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addDepartment" @if (!auth()->user()->can("department_Create")) disabled @endif>
                                    Add Department
                                </button>

                                <div class="btn-group pull-right">
                                        <button class="btn btn-sm btn-success" data-toggle="modal" data-target="#editCompany" @if (!auth()->user()->can("company_Modify")) disabled @endif>
                                            Edit
                                        </button>
                                    <form action="/company/{{ $company->id }}" id="deleteCompany" hidden method="post" style="display:inline; margin: 0; padding: 0">
                                        {{ csrf_field() }}
                                        {{ method_field("delete") }}
                                    </form>
                                    <button class="btn btn-sm btn-danger" @if (!auth()->user()->can("company_Delete")) disabled @endif onclick='

                                        document.querySelector("#deleteCompany").submit();

                                    '>
                                        Remove
                                    </button>
                                </div>

                                @can("company_Modify")
                                <div class="modal inmodal fade" id="editCompany" tabindex="-1" role="dialog"  aria-hidden="true">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header no-padding">
                                                <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <label>Company Name</label>
                                                        <input class="form-control input" name="name" placeholder="{{$company->name}}">
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <label>Address</label>
                                                        <input class="form-control input" name="address" placeholder="{{$company->address}}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <div class='btn-group'>
                                                    <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success btn-sm" data-dismiss="modal" onclick='

                                                        fetch ("/company/{{$company->id}}", {
                                                            method: "put",
                                                            headers: {
                                                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                                            },
                                                            body: JSON.stringify({
                                                                name: document.querySelector("[name=name]").value,
                                                                address: document.querySelector("[name=address]").value,
                                                            }),
                                                        }).then(rep => rep.json()).then(json => {

                                                            document.querySelector("#company_name").innerHTML = json.name;

                                                        });


                                                    '>Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endcan

                                @can("department_Create")
                                <div class="modal inmodal fade" id="addDepartment" tabindex="-1" role="dialog"  aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header no-padding">
                                                    <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
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
                                                        <button type="button" class="btn btn-success btn-sm" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-success btn-sm" name="submit">Create</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover departmentTable">
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
            $(".departmentTable").DataTable({
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {
                        extend: 'copy',
                        exportOptions: {
                            columns: ":not(#excludedcolumn)",
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ":not(#excludedcolumn)",
                        }
                    },
                    {
                        extend: 'excel', 
                        title: 'ExampleFile',
                    },
                    {
                        extend: 'pdf', 
                        title: 'ExampleFile',
                        exportOptions: {
                            columns: ":not(#excludedcolumn)",
                        }
                    },

                    {
                        extend: 'print',
                        customize: function (win) {
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        },
                        exportOptions: {
                            columns: ":not(#excludedcolumn)",
                        }
                    },
                ],
                language: {
                    paginate: {
                        previous: '<i class="fas fa-arrow-left"></i>',
                        next: '<i class="fas fa-arrow-right "></i>',
                    }
                },
                
            });
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