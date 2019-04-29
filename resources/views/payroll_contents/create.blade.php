<div class="row">
   <div class="col-lg-12">
      {{$payroll_id}}
   </div>
    
</div>

@php( $checkPayroll = \App\PayrollDate::orderBy('id' , 'DESC')->first())
                      
                        @if (\App\PayrollDate::orderBy('id' , 'DESC')->count() > 0)
                       
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Create Payroll Date</h4>
                                    <div class="form-group" id="data_5">
                                       <?php
                                            $start = date("m/d/Y" , strtotime($checkPayroll->start));
                                            $end = date("m/d/Y" , strtotime($checkPayroll->end));
                                        ?>
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="input-sm form-control" name="start" value="{{$start}}" id="start" onchange="checkAttendance(this.value , document.getElementById('end').value)">
                                            <span class="input-group-addon">to</span>
                                            <input type="text" class="input-sm form-control" name="end"  value="{{$end}}" id="end" onchange="checkAttendance(document.getElementById('start').value , this.value)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <Br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4>Available Employee</h4>
                                    @php( $employeeList = \App\DateTimeRecord::distinct()->get(['user_id']))
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Employee</th>
                                                    <th>Rate</th>
                                                    <th>Reg Hours</th>
                                                    <th>Rate</th>
                                                    <th>Total Hours</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody id="payrollTable">
                                              
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Employee</th>
                                                    <th>Rate</th>
                                                    <th>Reg Hours</th>
                                                    <th>Rate</th>
                                                    <th>Total Hours</th>
                                                    
                                                    
                                                </tr>
                                            </tfoot>
                                            </table>
                                     </div>
                        
                                    
                                </div>
                            </div>   
                        @else
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger">
                                    No available attendance for creating for payroll <Br><Br>
                                    Please import your attendance file first
                                    <a class="alert-link" href="/dtr">Click here to create attendance</a>.
                                </div>
                            </div>
                        </div>
                        @endif


       