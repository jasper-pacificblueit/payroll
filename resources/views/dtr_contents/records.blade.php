<div class="row">
    <div class="col-lg-3">
            @php( $payrollDates = \App\PayrollDate::all() )
            
            <h4>Payroll Date:</h4>
     
            
            <select name="DateSelector" id="DateSelector" class="form-control" onchange="DateSelect(this.value)">
              
                @foreach ($payrollDates as $payrollDate)
                <option value="{{$payrollDate->id}}">{{date("M d" , strtotime($payrollDate->start))}} - {{date("M d Y" , strtotime($payrollDate->end))}}</option>                
                @endforeach
            </select>
      
        
    </div>
    
</div>

<br>
<div class="row" id="RecordContent" >
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
                        <th>Warning</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="tableBody">
                        
                    </tbody>
                    <tfoot>
                        <th>Employee</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Total Hours</th>
                        <th>Total Days</th>
                        <th>Warning</th>
                        <th>Action</th>
                    </tfoot>
                    </table>  
        </div>
    </div>
</div>