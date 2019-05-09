<div class="row">
    <div class="col-lg-12">
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addDeduction">Add Deduction</button>
        <button class="btn btn-default btn-sm">Add Formula</button>

        <div class="modal inmodal fade" id="addDeduction" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="/addDeductions" method="POST">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Add Deduction</h4>
                           
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label for="">Deduction name</label>
                                    <input type="text" name="name" id="" class="form-control" placeholder="" required>
                                </div>
                                <div class="col-lg-6">
                                        <label for="">Deduction type</label>
                                    <input type="text" name="type" id="" class="form-control" required>
                                </div>

                                <div class="col-lg-6">
                                    <label for="">Formula type</label>
                                    <input type="text" name="formula_type" id="" class="form-control" required>
                                </div>

                                <div class="col-lg-6">
                                    <label for="">Formula</label>
                                    <input type="text" name="" id="" class="form-control" >
                                </div>
                                <div class="col-lg-6">
                                    <label for="">Amount</label>
                                    <input type="text" name="amount" id="" class="form-control" required>
                                </div>
                                
                            </div>
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                     </div>
                </form>
            </div>
        </div>

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
