<div class="row">
   
    <div class="col-md-3">
        <h4>Select a Payroll</h4>
        <form id="selectDateForm" method="get" action="/payroll">
            
            <select class="form-control select2_demo_1" id="selectDate" name="selectDate" onchange="this.form.submit()">
                @php( $payrollDates = \App\Payroll::orderBy('id' , 'DESC')->get())

                @if (count($payrollDates) > 0)
                
                    @foreach ($payrollDates as $payrollDate)
                    <option value="{{$payrollDate->id}}">{{date("M d" , strtotime($payrollDate->start))}} - {{date("M d Y" , strtotime($payrollDate->end))}}</option>
                    @endforeach
                @else
                    <option value="">--No available data--</option>   
                @endif
            </select>
            
        </form>
        <script>
            document.getElementById('selectDate').value = {{$payroll_id}};
        </script>
    </div>

    <div class="col-lg-1">
        <h4>&nbsp;</h4>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Create Payroll
        </button>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               
                        <h4 class="modal-title">Create Payroll</h4>
                        
                    </div>
                    <form method="POST" action="payroll">
                        {{ csrf_field() }}
                    <div class="modal-body">
                        @php( $checkPayroll = \App\PayrollDate::orderBy('id' , 'DESC')->first())
                        <?php
                        $row = \App\Payroll::orderBy('id' , 'DESC')->count();
                        ?>
                        @if ($row > 0)

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group" id="data_5">
                                        <label class="font-normal">Date range select</label>
                                        
                                    
                                        <?php
                                            $start = date("m/d/Y" , strtotime($checkPayroll->start));
                                            $end = date("m/d/Y" , strtotime($checkPayroll->end));
                                        ?>
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="input-sm form-control" name="start" value="{{$start}}">
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="input-sm form-control" name="end"  value="{{$end}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="font-normal">Select Employees</label>
                                    @php( $employeeList = \App\DateTimeRecord::distinct()->get(['user_id']))
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Employee</th>
                                            <th>Department</th>
                                            <th>Position</th>
                                            <th>Total Hours</th>
                                            <th>Total Days</th>
                                            <th>Warning</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($employeeList as $employee)
                                            <tr>
                                                <td><input type="checkbox" class="i-checks" name="employee[]" value="{{$employee->user_id}}"></td>

                                                @php( $profile = \App\Profile::find($employee->user_id))
                                                <td>{{$profile->fname}} {{$profile->lname}}</td>


                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>   
                        @else
                        <div class="ibox-content">
                            <h4>No Available Data</h4>
                            <Br>
                            <p>There is no available data</p>
                            <p>Please create or manage your payroll data here</p>
            
                            <p>
                                
                            </p>
                        </div>
                        @endif
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        @if ($row > 0)
                            <button type="submit" class="btn btn-primary">Create</button>
                        @endif
                        
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>
</div>
<Br>
<div class="row">

    @if ($payroll_id == NULL)
        <div class="col-lg-12">
            <div class="ibox-content">
                <p>There is no available data</p>
                <p>Please create or manage your payroll data here</p>   
            </div>

        </div>
    @else
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                <tr>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Income</th>
                    <th>Deduction</th>
                    <th>Net Pay</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @php( $date = \App\Payroll::find($payroll_id))

                    @php( $employees = \App\DateTimeRecord::distinct()->get(['user_id']))
                    
                    @foreach ($employees as $employee)
                        <tr>
                            @php( $profile = \App\Profile::find($employee->user_id))
                            <td>{{$profile->fname}} {{$profile->lname}}</td>
                            <td><small>({{$date->start}})</small></td>
                            <td><small>(incomplete module)</small></td>
                            <td><small>(rate module inc)</small></td>
                            <td><small>(deduction module inc)</small></td>
                            <td>--</td>
                            <td><button class="btn btn-default btn-sm">Full Details</button></td>
                            
                        </tr>
                    @endforeach
                
                </tbody>
                <tfoot>
                <tr>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Income</th>
                        <th>Deduction</th>
                        <th>Net Pay</th>
                        <th>Action</th>
                </tr>
                </tfoot>
                </table>
            </div>

        </div>
    @endif
    
</div>