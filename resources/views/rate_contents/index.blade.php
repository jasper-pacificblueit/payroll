@extends('layouts.master')

@section("title", "Management | " . ucfirst(Request::path()))

@section('styles')

{!! Html::style('css/plugins/iCheck/custom.css') !!}
{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/select2/select2.min.css') !!}
{!! Html::style('css/plugins/daterangepicker/daterangepicker-bs3.css') !!}
{!! Html::style('css/plugins/datapicker/datepicker3.css') !!}

@endsection
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Management</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a>Dashboard</a>
                </li>
                <li>Management</li>
                <li class="{{ Request::path() == 'rates' ?: 'hidden' }}">
                    <strong>Rates</strong>
                </li>
                <li class="{{ Request::path() == 'deductions' ?: 'hidden' }}">
                    <strong>Deductions</strong>
                </li>
                <li class="{{ Request::path() == 'earnings' ?: 'hidden' }}">
                    <strong>Earnings</strong>
                </li>
                <li class="{{ Request::path() == 'schedules' ?: 'hidden' }}">
                    <strong>Schedules</strong>
                </li>
                <li class="{{ Request::path() == 'positions' ?: 'hidden' }}">
                    <strong>Positions</strong>
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
                            <li class="{{Request::path() == 'rates' ? 'active' : '' }}"><a href="/rates">Rates</a></li>
                            <li class="{{Request::path() == 'deductions' ? 'active' : '' }}"><a href="/deductions">Deductions</a></li>
                            <li class="{{Request::path() == 'earnings' ? 'active' : '' }}"><a href="/earnings">Earnings</a></li>
                            <li class="{{Request::path() == 'schedules' ? 'active' : '' }}"><a href="/schedules">Schedules</a></li>
                            <li class="{{Request::path() == 'positions' ? 'active' : '' }}"><a href="/positions">Positions</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="compensation" class="tab-pane {{ Request::path() == 'rates' ? 'active' : '' }}">
                                <div class="panel-body">
                                    @if (Request::path() == "rates")
                                    <div class="row">
                                        <div class="col-lg-12" style="padding: 0">
                                            <div class="col-lg-3 col-xs-6">
                                                <label>Select Company</label>
                                                <select class="form-control select2_demo_1 com" onchange="chdepartment(this)">
                                                    @foreach (App\Company::all() as $company)
                                                        @if (count($company->departments) > 0)
                                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-lg-3 col-xs-6">
                                                <label>Select Department</label>
                                                <select class="form-control select2_demo_2 dep" onchange="chemployee(this)"></select>
                                            </div>
                                        </div>
                                    </div>
                                    @include('rate_contents.rates')
                                    @endif
                                </div>
                            </div>
                            <div id="compensation" class="tab-pane {{ Request::path() == 'deductions' ? 'active' : '' }}">
                                <div class="panel-body">
                                    @if (Request::path() == "deductions")
                                    <div class="row">
                                        <div class="col-lg-12" style="padding: 0">
                                            <div class="col-lg-3 col-xs-6">
                                                <label>Select Company</label>
                                                <select class="form-control select2_demo_1 com" onchange="chdepartment(this)">
                                                    @foreach (App\Company::all() as $company)
                                                        @if (count($company->departments) > 0)
                                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-xs-6">
                                                <label>Select Department</label>
                                                <select class="form-control select2_demo_2 dep" onchange="chemployee(this)"></select>
                                            </div>
                                        </div>
                                    </div>
                                    @include('rate_contents.deductions')
                                    <span id="modal-view"></span>
                                    @endif
                                </div>
                            </div>
                            <div id="compensation" class="tab-pane {{ Request::path() == 'earnings' ? 'active' : '' }}">
                                <div class="panel-body">
                                    @if (Request::path() == "earnings")
                                    <div class="row">
                                        <div class="col-lg-12" style="padding: 0">
                                            <div class="col-lg-3 col-xs-6">
                                                <label>Select Company</label>
                                                <select class="form-control select2_demo_1 com" onchange="chdepartment(this)">
                                                    @foreach (App\Company::all() as $company)
                                                        @if (count($company->departments) > 0)
                                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="col-lg-3 col-xs-6">
                                                <label>Select Department</label>
                                                <select class="form-control select2_demo_2 dep" onchange="chemployee(this)"></select>
                                            </div>
                                        </div>
                                    </div>
                                    @include('rate_contents.earnings')
                                    <span id="modal-view"></span>
                                    @endif
                                </div>
                            </div>
                            <div id="compensation" class="tab-pane {{ Request::path() == 'schedules' ? 'active' : '' }}">
                                <div class="panel-body">
                                    @if (Request::path() == "schedules")
                                    @include('schedule_contents.index')
                                    @endif
                                </div>
                            </div>
                            <div id="compensation" class="tab-pane {{ Request::path() == 'positions' ? 'active' : '' }}">
                                <div class="panel-body">
                                    @if (Request::path() == "positions")
                                    @include('positions_contents.index')
                                    @endif
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

{!! Html::script('js/plugins/dataTables/datatables.min.js') !!}
{!! Html::script('js/plugins/select2/select2.full.min.js') !!}
{!! Html::script('js/plugins/daterangepicker/daterangepicker.js') !!}
{!! Html::script('js/plugins/datapicker/bootstrap-datepicker.js') !!}
{!! Html::script('js/plugins/iCheck/icheck.min.js') !!}

<script>
    
    $(document).ready(function() {

        @if (Request::path() == 'schedules')
        $(".scheduleTable").DataTable({
            pageLength: 10,
            language: {
                paginate: {
                    previous: '<i class="fas fa-arrow-left"></i>',
                    next: '<i class="fas fa-arrow-right"></i>',
                }
            },
       });
        @endif

        @if (Request::path() == 'deductions')
        $(".deductionTable").DataTable({
            pageLength: 10, 
            language: {
                paginate: {
                    previous: '<i class="fas fa-arrow-left"></i>',
                    next: '<i class="fas fa-arrow-right"></i>',
                }
            },
       });
        chdepartment(document.querySelector(".com"));
        @endif

        @if (Request::path() == 'rates')
            $(".ratesTable").DataTable({
                pageLength: 10,
                language: {
                    paginate: {
                        previous: '<i class="fas fa-arrow-left"></i>',
                        next: '<i class="fas fa-arrow-right"></i>',
                    }
                },
           });

           chdepartment(document.querySelector(".com"));
        @endif


        @if (Request::path() == "earnings")
           $(".earningsTable").DataTable({
                pageLength: 10,
                language: {
                    paginate: {
                        previous: '<i class="fas fa-arrow-left"></i>',
                        next: '<i class="fas fa-arrow-right"></i>',
                    }
                },
           });
           chdepartment(document.querySelector(".com"));
       @endif

       @if (Request::path() == "positions")
       $(".positionTable").DataTable({
            pageLength: 10,
            language: {
                paginate: {
                    previous: '<i class="fas fa-arrow-left"></i>',
                    next: '<i class="fas fa-arrow-right"></i>',
                }
            },
       });
       @endif   

    });

    @if (Request::path() == "rates")
   function chemployee(obj) {
        fetch ("/rates/employeelist/rates/"+ obj.value, {
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            }
        }).then(rep => rep.text()).then(html => {
            $(".ratesTable").DataTable().destroy();
            document.querySelector(".employeelist").innerHTML = html;
            $(".ratesTable").DataTable({
                pageLength: 10, 
                language: {
                    paginate: {
                        previous: '<i class="fas fa-arrow-left"></i>',
                        next: '<i class="fas fa-arrow-right"></i>',
                    }
                },
           }).draw();
        });
    }

    function chdepartment(obj) {
        fetch("/selectDepartment?q=" + obj.value, {
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            }
        }).then(rep => rep.text()).then(html => {
            document.querySelector(".dep").innerHTML = html;
            $(".dep").select2();
            $(".com").select2();

            chemployee(document.querySelector(".dep"));
        });
    }
    @endif

    @if (Request::path() == "deductions")
   function chemployee(obj) {
        fetch ("/rates/employeelist/deductions/"+ obj.value, {
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            }
        }).then(rep => rep.text()).then(html => {
            $(".deductionTable").DataTable().destroy();
            document.querySelector(".employeelist").innerHTML = html;
            $(".deductionTable").DataTable({
                pageLength: 10, 
                language: {
                    paginate: {
                        previous: '<i class="fas fa-arrow-left"></i>',
                        next: '<i class="fas fa-arrow-right"></i>',
                    }
                },
           }).draw();
        });
    }

    var adddeduction = 0;
    var modalInterval;

    function save_deduction(id) {
        var deduction = document.querySelector("#deduction-" + id);

        deduction.children[0].innerHTML = deduction.children[0].firstElementChild.value || "deduction" + (id+1);
        deduction.children[1].innerHTML = deduction.children[1].firstElementChild.value || "0.00";

        adddeduction--;

        deduction.children[2].firstElementChild.style.top = "auto";
        deduction.children[2].firstElementChild.innerHTML = "Edit";

        deduction.children[2].firstElementChild.onclick = '';

        deduction.children[2].firstElementChild.addEventListener('click', event => {
            if (deduction.children[2].firstElementChild.innerHTML == "Save") {
                deduction.children[0].innerHTML = deduction.querySelector("#deduction-"+id+"-desc").value 
                    || deduction.querySelector("#deduction-"+id+"-desc").placeholder;
                deduction.children[1].innerHTML = deduction.querySelector("#deduction-"+id+"-val").value
                    || deduction.querySelector("#deduction-"+id+"-val").placeholder;

                deduction.children[2].firstElementChild.innerHTML = "Edit";
                deduction.children[2].firstElementChild.style.top = "auto";
                adddeduction--;
                return;
            }

            var late_desc = deduction.children[0].innerHTML;
            var late_val = deduction.children[1].innerHTML;

            deduction.children[0].innerHTML = `<input class="form-control" placeholder="${late_desc}" id="deduction-${id}-desc">`;
            deduction.children[1].innerHTML = `<input class="form-control" type="number" step=".01" placeholder="${late_val}" id="deduction-${id}-val">`;

            deduction.children[2].firstElementChild.style.position = "relative";
            deduction.children[2].firstElementChild.style.top = "5px";
            deduction.children[2].firstElementChild.innerHTML = "Save";
            adddeduction++;
        });

    }

    function chdepartment(obj) {
        fetch("/selectDepartment?q=" + obj.value, {
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            }
        }).then(rep => rep.text()).then(html => {
            document.querySelector(".dep").innerHTML = html;
            $(".dep").select2();
            $(".com").select2();
            chemployee(document.querySelector(".dep"));
        });
    }
    @endif

    @if (Request::path() == "earnings")
    function chemployee(obj) {
        fetch ("/rates/employeelist/earnings/"+ obj.value, {
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            }
        }).then(rep => rep.text()).then(html => {
            $(".earningsTable").DataTable().destroy();
            document.querySelector(".employeelist").innerHTML = html;
            $(".earningsTable").DataTable({
                pageLength: 10, 
                language: {
                    paginate: {
                        previous: '<i class="fas fa-arrow-left"></i>',
                        next: '<i class="fas fa-arrow-right"></i>',
                    }
                },
           }).draw();
        });
    }

    function chdepartment(obj) {
        fetch("/selectDepartment?q=" + obj.value, {
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            }
        }).then(rep => rep.text()).then(html => {
            document.querySelector(".dep").innerHTML = html;
            $(".dep").select2();
            $(".com").select2();

            chemployee(document.querySelector(".dep"));
        });
    }

    function save_earnings(earning_n) {

        var earning = document.querySelector("#earning tbody#misc").children[earning_n];

        if (earning.children[2].firstElementChild.innerHTML == "Save") {

            earning.children[0].innerHTML = earning.children[2].firstElementChild.value.replace(/ /g,"") || "earning" + earning_n;
            earning.children[1].innerHTML = earning.children[1].firstElementChild.value.replace(/ /g,"") || 0;
            earning.children[2].firstElementChild.innerHTML = "Edit";

            earning.children[2].firstElementChild.onclick = function () {

                var earning = document.querySelector("#earning tbody#misc").children[earning_n];

                if (this.innerHTML == "Save") {

                    earning.children[0].innerHTML = 
                        earning.children[0].firstElementChild.value.replace(/ /g,"") || earning.children[0].firstElementChild.placeholder;
                    earning.children[1].innerHTML = 
                        earning.children[1].firstElementChild.value.replace(/ /g,"") || earning.children[1].firstElementChild.placeholder;

                    this.innerHTML = "Edit";
                    return;
                };

                earning.children[0].innerHTML = `
                    <input class="form-control" name="name" placeholder=${earning.children[0].innerHTML}>
                `;
                earning.children[1].innerHTML = `
                    <input class="form-control" name="value" placeholder=${earning.children[1].innerHTML}>
                `;
                earning.children[2].firstElementChild.innerHTML = "Save";


            };

            return;
        }


    }

    @endif
    
</script>
@endsection