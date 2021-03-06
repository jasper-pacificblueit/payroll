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
                    Dashboard
                </li>
                <li class="">
                    <strong>Compensation</strong>
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
                                    @include('payroll_contents.history')
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
{!! Html::script('js/companyDepartment.js') !!}
                 
<script>
        
        function printElem(payslip_id){
            var printBody = document.querySelector(`.payslipBody-${payslip_id}`)
            var newWin= window.open("");
            newWin.document.write(printBody.outerHTML);
            
            newWin.print();
            newWin.close();
            
           

        }

        function printAllElement(){
            var allPayslip = document.querySelectorAll('.payslipBody');
            var newWin= window.open("");
            allPayslip.forEach(element => {
                newWin.document.write(element.outerHTML);
                
            });
            newWin.print();
            newWin.close();
            
        }
        function checkDate(payroll_id){
            console.log( payroll_id);
          
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp=new XMLHttpRequest();
            } else {  // code for IE6, IE5
                xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                document.getElementById("historyBody").innerHTML=this.responseText;
              
                }
            }
            xmlhttp.open("GET","checkPayroll?payroll_id="+payroll_id,true);
            xmlhttp.send();
        }

        checkDate(document.getElementById('DateSelector').value);

        function CalculateNetPay(user_id , income , deduction){
            var NewNetPay = income - deduction;
         
            document.querySelector('#TotalNetPay-'+user_id).value = NewNetPay.toFixed(2);
            document.querySelector('#TotalNetPayDisp-'+user_id).innerHTML = currencyFormat(NewNetPay);
            document.querySelector('#TotalNetPayDispOut-'+user_id).innerHTML = currencyFormat(NewNetPay);
            

        }
        function confirmAction(){
            swal({
                title: '',
                text: 'Are you sure you want to create this payroll?',
                showCancelButton: true,
            }, function () {
                document.getElementById("createPayrollForm").submit();
            });
        }
         function currencyFormat(num) {
             return '₱ ' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
        function CalculateTotalIncome(user_id){
            var IncomeClass = document.getElementsByClassName('IncomeClass-' + user_id);
            var NewTotalIncome = 0;
            for(var i = 0; i < IncomeClass.length; i++) {
                
               var value= IncomeClass[i].value;
               console.log(parseFloat(value));
               NewTotalIncome += parseFloat(value);

            }
            console.log(NewTotalIncome);
            document.querySelector('#TotalIncome-'+user_id).value = NewTotalIncome.toFixed(2);
            document.querySelector('#TotalIncomeDisp-'+user_id).innerHTML = currencyFormat(NewTotalIncome);
            document.querySelector('#TotalIncomeDispOut-'+user_id).innerHTML = currencyFormat(NewTotalIncome);

            CalculateNetPay(user_id , NewTotalIncome , document.querySelector('#TotalDeduction-'+user_id).value);
        }
        

        function changeSaveBtn(Discription , Amount , user_id){
            var addButton = document.getElementById('addIncomeBtn-' + user_id);
            if(Discription.length > 0 && Amount.length > 0){
                console.log(Discription , Amount);
                addButton.disabled = false;
                CalculateTotalIncome(user_id);
            }
            else{
                console.log('dis');
                addButton.disabled = true;
            }

          
            
         
        
        
        }   
        

        function addIncome(user_id) {
                var addButton = document.getElementById('addIncomeBtn-' + user_id);
                
                if(addButton.value == 'Save'){
           
                    var Description = document.getElementById('description-' + user_id);
                    var Amount = document.getElementById('amount-' + user_id);
                    

                    console.log(Description.value);
                    
                    var newNode = document.createElement("LI");
                    newNode.setAttribute('id', 'DispaddedIncome-'+user_id+'-'+document.querySelector('#DisplayIncome-' + user_id).childElementCount);
                    newNode.className = 'list-group-item';
                    newNode.innerHTML = `
                        <span id="DispaddedDisc">${Description.value} <input type="text" name="addedItemDiscp[${user_id}][]"  class="DiscriptionClass-${user_id}" value="${Description.value}" hidden></span>
                        <span class="pull-right" style="margin-right:-15px;"><a onclick="removeAddedIncome(${user_id}, ${document.querySelector('#DisplayIncome-' + user_id).childElementCount})"><i class="fa fa-close"></i></a></span>
                        <span class="pull-right">₱ ${Amount.value} <input type="text" name="addedItemAmount[${user_id}][${Description.value}]" class="IncomeClass-${user_id}" value="${Amount.value}" hidden> </span>
                        
                    `;
                    document.querySelector("#DisplayIncome-"+user_id).appendChild(newNode);
                    
                    addButton.value = 'Add Income';
                    removeIncome(user_id);
                    CalculateTotalIncome(user_id);
                   

                //    var des = document.getElementById('description-'+user_id).value;

                //    var json= {
                //        "name":user_id,
                //        "desc":des
                //     }    

                //    localStorage.setItem('desc',JSON.stringify(json));
                }
                else{
                    var Description = document.getElementById('description-' + user_id);
                    var Amount = document.getElementById('amount-' + user_id);

                    console.log(user_id);
                    var node = document.createElement("LI");
                    node.setAttribute('id', 'addedIncome-'+user_id);
                    node.className = 'list-group-item';

                    node.innerHTML = `
                        <input type="text" class="addedDisp" name="addedIncome[${user_id}][]" id="description-${user_id}" onkeyup="changeSaveBtn(this.value , document.getElementById('amount-'+${user_id}).value , ${user_id})" style="border:0;border-bottom:solid 1px #CCC;outline:none;background:transparent;" placeholder="Description.." required>
                        ₱ <input id='amount-${user_id}' class="IncomeClass-${user_id}" onkeyup="changeSaveBtn(document.getElementById('description-'+${user_id}).value , this.value , ${user_id})" type="number" style="border:0;border-bottom:solid 1px #CCC;outline:none; width: 40%;background:transparent" placeholder="Amount.." required>
                        <span class="pull-right close-btn-${user_id}"> <a onclick="removeIncome(${user_id})"><i class="fa fa-close pull-right" style='font-size: 21px'></i></a> </span> 
                    `;
                    document.querySelector("#income-"+user_id).appendChild(node);

                    addButton.className = 'btn btn-primary btn-xs';
                    addButton.value = 'Save';

                    addButton.disabled = true;
                    
                }
               
       
               
                
        }
        function CalculateTotalDeduction(user_id){
            var DeductionClass = document.getElementsByClassName('DeductionClass-' + user_id);
            var NewTotalDeduction = 0;
            console.log(DeductionClass.length);
            for(var i = 0; i < DeductionClass.length; i++) {
                
               var value= DeductionClass[i].value;
               
               console.log(parseFloat("deductions = " + value));
               NewTotalDeduction += parseFloat(value);

            }
            console.log(NewTotalDeduction);
            document.querySelector('#TotalDeduction-'+user_id).value = NewTotalDeduction.toFixed(2);
            document.querySelector('#TotalDeductionDisp-'+user_id).innerHTML = currencyFormat(NewTotalDeduction);
            document.querySelector('#TotalDeductionDispOut-'+user_id).innerHTML = currencyFormat(NewTotalDeduction);

            console.log('income = ' + document.querySelector('#TotalIncome-'+user_id).value);
           
            CalculateNetPay(user_id , document.querySelector('#TotalIncome-'+user_id).value , NewTotalDeduction);
            
        }
        function changeSaveBtnDeduction(Discription , Amount , user_id){
            var addButton = document.getElementById('addDeductionBtn-' + user_id);
            if(Discription.length > 0 && Amount.length > 0){
                console.log(Discription , Amount);
                addButton.disabled = false;
                CalculateTotalDeduction(user_id);
            }
            else{
                console.log('dis');
               
                addButton.disabled = true;
            }

        }   
        function removeDeduction(user_id) {
            var element = document.getElementById('addedDeduction-'+user_id);
            element.parentNode.removeChild(element);
            var addButton = document.getElementById('addDeductionBtn-'+user_id);

            addButton.className = 'btn btn-default btn-xs';
            addButton.value = 'Add Deduction';
            
            addButton.disabled = false;
            CalculateTotalDeduction(user_id);

        }

        function removeAddedDeduction(user_id, count) {
            var element = document.getElementById('DispaddedDeduction-'+user_id+'-'+count);
            element.parentNode.removeChild(element);
            CalculateTotalDeduction(user_id);
        }

        function addDeduction(user_id) {
                var addButton = document.getElementById('addDeductionBtn-' + user_id);
                
                if(addButton.value == 'Save'){
           
                   console.log('save');

                    var Description = document.getElementById('Deduc_description-' + user_id);
                    var Amount = document.getElementById('Deduction_amount-' + user_id);
                    

                    console.log(Description.value);
                    
                    var newNode = document.createElement("LI");
                    newNode.setAttribute('id', 'DispaddedDeduction-'+user_id+'-'+document.querySelector("#DisplayDeduction-"+user_id).childElementCount);
                    newNode.className = 'list-group-item';
                    newNode.innerHTML = `
                        <span id="DispaddedDiscDeduction">${Description.value} <input type="text" name="addedDeductionDiscp[${user_id}][]"  class="DiscriptionClassDeduction-${user_id}" value="${Description.value}" hidden></span>
                        <span class="pull-right" style="margin-right:-15px;"><a onclick="removeAddedDeduction(${user_id}, ${document.querySelector("#DisplayDeduction-"+user_id).childElementCount})"><i class="fa fa-close"></i></a></span>
                        <span class="pull-right">₱ ${Amount.value} <input type="text" name="addedItemDeductionAmount[${user_id}][${Description.value}]" class="DeductionClass-${user_id}" value="${Amount.value}" hidden> </span>
                        
                    `;
                    document.querySelector("#DisplayDeduction-"+user_id).appendChild(newNode);
                    
                    addButton.value = 'Add Deduction';
                    removeDeduction(user_id);
                    CalculateTotalDeduction(user_id);
                }
                else{
                    console.log(user_id);
                    var Description = document.getElementById('description-' + user_id);
                    var Amount = document.getElementById('amount-' + user_id);

                    console.log(user_id);
                    var node = document.createElement("LI");
                    node.setAttribute('id', 'addedDeduction-'+user_id);
                    node.className = 'list-group-item';

                    node.innerHTML = `
                         <input type="text" class="addedDedDisp" name="addedDeduction[${user_id}][]" id="Deduc_description-${user_id}" onkeyup="changeSaveBtnDeduction(this.value , document.getElementById('Deduction_amount-'+${user_id}).value , ${user_id})" style="border:0;border-bottom:solid 1px #CCC;outline:none;background:transparent;" placeholder="Description.." required>
                        ₱ <input id='Deduction_amount-${user_id}' class="DeductionClass-${user_id}" onkeyup="changeSaveBtnDeduction(document.getElementById('Deduc_description-'+${user_id}).value , this.value , ${user_id})" type="number" style="border:0;border-bottom:solid 1px #CCC;outline:none; width: 40%;background:transparent" placeholder="Amount.." required>
                        <span class="pull-right close-btn-${user_id}"> <a onclick="removeDeduction(${user_id})"><i class="fa fa-close pull-right" style='font-size: 21px'></i></a> </span> 
                    
                       
                        `;
                    document.querySelector("#deduction-"+user_id).appendChild(node);

                    addButton.className = 'btn btn-primary btn-xs';
                    addButton.value = 'Save';

                    addButton.disabled = true;
                    
                }
               
       
               
                
        }
        function removeIncome(user_id) {
            var element = document.getElementById('addedIncome-'+user_id);
            element.parentNode.removeChild(element);
            var addButton = document.getElementById('addIncomeBtn-'+user_id);

            addButton.className = 'btn btn-default btn-xs';
            addButton.value = 'Add Income';
            
            addButton.disabled = false;
            CalculateTotalIncome(user_id);

        }

        function removeAddedIncome(user_id, count) {
            var element = document.getElementById('DispaddedIncome-'+user_id+'-'+count);
            element.parentNode.removeChild(element);
            CalculateTotalIncome(user_id)
            
            
        }
        function checkAttendance(start , end, dep) {
            console.log( start , end, dep);
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
                                exportOptions: {
                                    columns: ":not(#excludedcolumn)",
                                }
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
            xmlhttp.open("GET","create/payrollDate?start="+start+"&end="+end+"&dep="+dep,true);
            xmlhttp.send();
        }

        chcom(document.querySelector("#com"));
        $("#com").select2();
        
        
</script>

<script>
    
    $(document).ready(function(){
        
    //    var call=localStorage.getItem('desc');
    //    var data={call}
    //         console.log(JSON.parse(call).name);

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
