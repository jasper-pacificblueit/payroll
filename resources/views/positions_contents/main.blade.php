<div class="row">
    <div class="col-lg-12">
        <button class="btn btn-sm btn-success">Add Positions</button>
    </div>

    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive" >
                    <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date Created</th>
                                <th>Title</th>
                                <th>Descriptions</th>
                                <th>Employee/s</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if ( ($positions = App\Positions::all())->count() > 0)
                                    @foreach ($positions as $position)
                                    <tr>
                                        <td>{{ $position->id + 1000 }}</td>
                                        <td>{{ $position->created_at }}</td>
                                        <td>{{ $position->title }}</td>
                                        <td width=500>{{ $position->description }}</td>
                                        <td>0/50</td>
                                        <td>
                                        @php
                                            switch ($position->state) {
                                            case 0:
                                                echo "<span class='alert-success'>Active</span>";
                                                break;
                                            case 1:
                                                echo "<span class='alert-warning'>Inactive</span>";
                                                break;
                                            case 2:
                                                echo "<span class='alert-info'>Temporarily Inactive</span>";
                                                break;
                                            default:
                                                echo "<span class='alert-danger'>Unknown</span>";
                                            }
                                        @endphp
                                        </td>
                                    </tr>
                                    @endforeach
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