<div class="row">
    <div class="col-lg-3">
            @php($payrollDates = \App\PayrollDate::all())
            
            <h4>Payroll Date:</h4>

            <select name="DateSelector" id="DateSelector" class="form-control select2_demo_1" onchange="DateSelect(this.value)">
                @foreach ($payrollDates as $payrollDate)
                    <option value="{{$payrollDate->id}}">{{date("M d" , strtotime($payrollDate->start))}} - {{date("M d Y" , strtotime($payrollDate->end))}}</option>
                @endforeach
            </select>
      
        
    </div>
    <div class="col-lg-1 pull-right">
        <button class="btn btn-default btn-md pull-right"><i class="fa fa-trash"></i></button>
    </div>
    
</div>

<br>
<div class="row" >
    <div class="col-lg-12">
    
      <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                <tr>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Total Hours</th>
                    <th>Total Days</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableBody"></tbody>
                <tfoot>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Total Hours</th>
                    <th>Total Days</th>
                    <th>Action</th>
                </tfoot>
            </table>  
        </div>
    </div>
</div>