@extends('layouts.master')

@section('title', 'Employee')

@section('styles')

{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}

{!! Html::style('css/plugins/select2/select2.min.css') !!}



@endsection
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
                            <li class="{{Request::path() == 'employee/add' ? 'active' : '' }}"><a href="/employee/add">Add Employees</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="employee" class="tab-pane {{ Request::path() == 'employee' ? 'active' : '' }}">
                                <div class="panel-body">
                                    <div class="row">
                                            <div class="col-md-3 col-xs-6">
                                                    <h4>Select Company</h4>
                                                        <select class="form-control select2_demo_1" id="CompanySelector" onchange="DepartmentSelect(this.value)">
                                                            @php($Companies = App\Company::all())
                                                            @foreach ($Companies as $company)
                                                                <option value="{{$company->id}}">{{$company->name}}</option>
                                                            @endforeach
                                                        </select>
                                                           
                                             </div>

                                             <div class="col-md-3 col-xs-6">
                                                    <h4>Select Department</h4>
                                                    <select class="form-control select2_demo_1" id="DepartmentSelector" onchange="EmployeeSelect(this.value)">
                                                    </select>
                                             </div>
                                        </div>
                                    <br>
                                    @include('employee_contents.view_employee')
                                </div>
                            </div>
                            <div class="tab-pane {{ Request::path() == 'employee/add' ? 'active' : '' }}">
                                    <div class="panel-body">
                                        @include('employee_contents.addEmployee')
                                    </div>
                                </div>
                           
                        </div>
                        

                    </div>
                </div>
            </div>

        </div>
    </div>



@endsection

@section('scripts')
{!! Html::script('js/plugins/footable/footable.all.min.js') !!}
{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
{!! Html::script('js/plugins/select2/select2.full.min.js') !!}

<script>

    function EmployeeSelect(str, pg) {
        if (str.length == 0) { 
            document.getElementById("EmployeeTable").innerHTML= "";
            return;
        }

        if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
        } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    $('.dataTables-example').DataTable().destroy();
                    document.querySelector('#EmployeeTable').innerHTML = this.responseText;
                    $('.dataTables-example').DataTable({
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
                        
                    }).draw();

                }
        }

        xmlhttp.open("GET","showEmployee?q="+str, true);
        xmlhttp.send();
    }

</script>

<script>

  
    $(document).ready(function() {
        $('.dataTables-example').DataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: 'ExampleFile'},
                {extend: 'pdf', title: 'ExampleFile'},

                {extend: 'print',
                 customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                }
                }
            ],
            language: {
                paginate: {
                    previous: '<i class="fas fa-arrow-left"></i>',
                    next: '<i class="fas fa-arrow-right"></i>',
                }
            },
            initComplete: function() { EmployeeSelect(document.getElementById('DepartmentSelector').value); },
        });

        $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });

        $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });

        $('[aria-controls=DataTables_Table_0]').on('input', function () {
            $(".dataTables-example").DataTable().search(this.value).draw();
        });
    });

// event function to change department options when company changes.
    let chdep = () => {
      let depid = 'dep-option-' + document.getElementsByName('company')[0].value;

      document.querySelector('.company-dep').innerHTML = "";  // reset

      let dep = document.querySelector('#' + depid);
      let clone = dep.content.cloneNode(1);

      document.querySelector('.company-dep').appendChild(clone);
    };


</script>
@endsection

