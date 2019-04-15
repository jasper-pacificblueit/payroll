<div class="row">
   
    <div class="col-md-4">
        <h4>Select a Payroll</h4>
        <select class="form-control select2_demo_1">
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
            <option value="4">Option 4</option>
            <option value="5">Option 5</option>
        </select>
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
                    <form method="POST" action="payroll/makePayroll">
                        {{ csrf_field() }}
                    <div class="modal-body">
                       
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group" id="data_5">
                                    <label class="font-normal">Date range select</label>
                                    @php( $checkPayroll = \App\PayrollDate::orderBy('id' , 'DESC')->first())
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
                                            @php( $profile = \App\Profile::find($employee->user_id))
                                            <td>{{$profile->fname}} {{$profile->lname}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
                </div>
            </div>
        </div>

    </div>
</div>
<Br>
<div class="row">
   
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
            <thead>
            <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th>
                <th>CSS grade</th>
            </tr>
            </thead>
            <tbody>
            
            </tbody>
            <tfoot>
            <tr>
                <th>Rendering engine</th>
                <th>Browser</th>
                <th>Platform(s)</th>
                <th>Engine version</th>
                <th>CSS grade</th>
            </tr>
            </tfoot>
            </table>
                </div>

    </div>
</div>