
<div class="row" >
    <div class="col-lg-12">
    
        <div class="row">
            <div class="col-lg-3">
                <br>
                <h4>Select Date</h4>
                @php($payrollDates = \App\Payroll::all())
                
                <select name="DateSelector" id="DateSelector" class="form-control select2_demo_1" onchange="checkDate(this.value)">
                    @foreach ($payrollDates as $payrollDate)
                        <option value="{{$payrollDate->id}}">{{date("M d" , strtotime($payrollDate->start))}} - {{date("M d Y" , strtotime($payrollDate->end))}}</option>
                    @endforeach
                    <option value="2">2</option>
                  
                </select>
          
            
            </div>
         
            <div class="col-sm-3 pull-right">
                <h4 class="pull-right"><button class="btn btn-danger btn-md"><i class="fa fa-trash"></i> Delete</button></h4>
                <br>
                <br>
                <br>
                <div class="input-group"><input type="text" placeholder="Search" class="input-sm form-control"> <span class="input-group-btn">
                    <button type="button" class="btn btn-sm btn-primary"> Go!</button> </span></div>
            </div>
           
            
        </div>
        <br>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Employee</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Total Income</th>
                    <th>Total Deduction</th>
                    <th>Net Pay</th>
                    <th>Action</th> 
                </tr>
                </thead>
                <tbody id="historyBody">
               
                </tbody>
            </table>
        </div>

    </div>
</div>