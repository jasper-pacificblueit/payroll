<div class="row">
    <div class="col-lg-1">
        <button class="btn btn-success">Add Deduction</button>
    </div>
    
    <div class="col-lg-1">
        <button class="btn btn-default">Add Formula</button>
    </div>
    
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive" >
                <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Deductions</th>
                            <th>Deduction Type</th>
                            <th>Formula Type</th>
                            <th>Formula</th>
                            <th>Amount</th>
                            <th>Status</th>
                         
                        </tr>
                        </thead>
                        <tbody>
                            @php( $Deductions = \App\Deduction::all())

                            @if(\App\Deduction::all()->count() > 0)
                                @if (isset($editDeduction))
                                    @if ($editDeduction == true)
                                        @foreach ($Deductions as $deduction)
                                            <tr>
                                                <td>{{$deduction->name}}</td>
                                                <td>
                                                    <select name="formula_type" id="" class="form-control">
                                                        <option value="">{{$deduction->type}}</option>
                                                        <option value="">Custom</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="formula_type" id="" class="form-control">
                                                        <option value="">{{$deduction->formula_type}}</option>
                                                        <option value="">Custom</option>
                                                    </select>
                                                </td>
                                                <td>N/A</td>
                                                <td><input type="text" name="" id="" value="{{$deduction->amount}}" class="form-control"></td>
                                                <td>{{$deduction->status}}</td>
                                            </tr>   
                                        @endforeach
                                    @else
                                        @foreach ($Deductions as $deduction)
                                            <tr>
                                                <td>{{$deduction->name}}</td>
                                                <td>{{$deduction->type}}</td>
                                                <td>{{$deduction->formula_type}}</td>
                                                <td>N/A</td>
                                                <td>Php {{number_format($deduction->amount , 2)}}</td>
                                                <td>{{$deduction->status}}</td>
                                            </tr>   
                                        @endforeach
                                    @endif
                                @endif
                            @else
                                <tr>
                                    <td colspan="7">No Result</td>
                                </tr>
                            @endif
                            
                           
                        
                        </tbody>
                 </table>
        </div>


    </div>
    
</div>
<div class="row">
    
      
        @if (isset($editDeduction))
            @if ($editDeduction == true)
            <div class="col-lg-2">
                <form action="/deductions" action="get">
                    <button type="submit" class="btn btn-primary" value="true" name="editDeduction">Save</button>
                    <a href="deductions" class="btn btn-danger">Cancel</a> 
                </form>
            </div>
            
               
            @elseif($editDeduction == false)
            <div class="col-lg-1">
                <form action="/deductions" action="get">
                    <button type="submit" class="btn btn-default" value="true" name="editDeduction">Edit</button>
                </form>
            </div>
                
            @endif
        @endif
        
   
</div>