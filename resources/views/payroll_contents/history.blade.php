<div class="row">
    <div class="col-lg-3">
            @php($payrollDates = \App\Payroll::all())
            
            <h4>Payroll Date:</h4>

            <select name="DateSelector" id="DateSelector" class="form-control select2_demo_1" onchange="checkDate(this.value)">
                @foreach ($payrollDates as $payrollDate)
                    <option value="{{$payrollDate->id}}">{{date("M d" , strtotime($payrollDate->start))}} - {{date("M d Y" , strtotime($payrollDate->end))}}</option>
                @endforeach
                <option value="2">1</option>
            </select>
      
        
    </div>
    <div class="col-lg-1 pull-right">
        <button class="btn btn-default btn-md pull-right"><i class="fa fa-trash"></i></button>
    </div>
    
</div>

<br>
<div class="row" >
    <div class="col-lg-12">
    
      <div class="table-responsive" id="historyBody">
           
        </div>
    </div>
</div>