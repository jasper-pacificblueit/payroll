@extends('layouts.master')

@section('title', 'Payroll')

@section('styles')

{!! Html::style('css/plugins/dataTables/datatables.min.css') !!}
{!! Html::style('css/plugins/select2/select2.min.css') !!}
{!! Html::style('css/plugins/daterangepicker/daterangepicker-bs3.css') !!}
{!! Html::style('css/plugins/datapicker/datepicker3.css') !!}
{!! Html::style('css/plugins/iCheck/custom.css') !!}


@endsection
@section('content')


    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Manage Payroll</h2>
            <ol class="breadcrumb">
                <li class="active">
                    <a>Dashboard</a>
                </li>
                <li class="">
                    <a href="/"><strong>Compensation</strong></a>
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
                            <li class="{{Request::path() == 'payroll/create' ? 'active' : '' }}"><a href="/payroll/create">Create Payroll</a></li>
                            <li class="{{Request::path() == 'payroll' ? 'active' : '' }}"><a href="/payroll">History</a></li>
                           
                        </ul>
                        <div class="tab-content">
                            <div id="compensation" class="tab-pane {{ Request::path() == 'payroll/create' ? 'active' : '' }}">
                                <div class="panel-body">
                                     
                                    @include('payroll_contents.create')
                                </div>
                            </div>
                            <div id="compensation" class="tab-pane {{ Request::path() == 'payroll' ? 'active' : '' }}">
                                <div class="panel-body">
                                        @if (isset($status))
                                        <div class="alert alert-{{$status}}">
                                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ea similique dolore assumenda magnam minus quae consequatur deserunt! Illum iusto odit officia alias cumque ratione ad voluptatem iure? Omnis, quaerat excepturi.
                                        </div>
                                        @endif
                                    @include('payroll_contents.compensation')
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



        function addIncome(user_id) {
                var addButton = document.getElementById('addIncomeBtn-' + user_id);
                
                if(addButton.value == 'Save'){
                    console.log('ok');
                }
                else{
                    console.log(user_id);
                    var node = document.createElement("LI");
                    node.setAttribute('id', 'addedIncome-'+user_id);
                    node.className = 'list-group-item';
                    node.innerHTML = `
                        <input type="text" name="addedIncome[${user_id}][]" id="description" style="border:0;border-bottom:solid 1px #CCC;outline:none;background:transparent;" placeholder="Description.." required>
                        ₱ <input id='amount' type="number" style="border:0;border-bottom:solid 1px #CCC;outline:none; width: 40%;background:transparent" placeholder="Amount.." required>
                        <span class="pull-right"> <a onclick="removeIncome(${user_id})"><i class="fa fa-close pull-right" style='font-size: 21px'></i></a> </span> 
                    `;
                    document.querySelector("#income-"+user_id).appendChild(node);

                    addButton.className = 'btn btn-primary btn-xs';
                    addButton.value = 'Save';
                  
                }
               
                
               
                
        }
        function removeIncome(user_id) {
            var element = document.getElementById('addedIncome-'+user_id);
            element.parentNode.removeChild(element);
            var addButton = document.getElementById('addIncomeBtn-'+user_id);

            addButton.className = 'btn btn-default btn-xs';
             addButton.value = 'Add Income';
        }
        function checkAttendance(start , end){
            console.log( start , end);
            if (start.length==0) { 
                document.getElementById("payrollTable").innerHTML="";
             
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
                    $(".dataTables-example").DataTable().destroy();
                    document.getElementById("payrollTable").innerHTML=this.responseText;
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
                        ]

                    }).draw();
                }
            }
            xmlhttp.open("GET","create/payrollDate?start="+start+"&end="+end,true);
            xmlhttp.send();
        }
    
        checkAttendance(document.getElementById('start').value , document.getElementById('end').value);
        
</script>

<script>
    
    $(document).ready(function(){

        $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });
           
            $('#data_5 .input-daterange').datepicker({
                keyboardNavigation: false,
                forceParse: false,
                autoclose: true
            });

       

    });

   
    
</script>
@endsection