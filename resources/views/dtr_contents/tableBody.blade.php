@php( $employees = \App\DateTimeRecord::with('getProfile')->distinct()->get(['user_id']))
@foreach ($employees as $employee)
    
    <tr>
        @php( $attendances = \App\DateTimeRecord::where('user_id' , $employee->user_id)->whereBetween('date' , [$data->start , $data->end])->get())
        <td>{{$employee->getProfile->lname}}</td>
        <?php $dayCount = 0; $totalHrs = 0;?>
        @foreach ($attendances as $attendance)
            <?php
            
                $dayCount++;
                $totalHrs += $attendance->total_hours;
            ?>
        @endforeach
        <td>--</td>
        <td>--</td>
        <td>{{$dayCount}}</td>
        <td>{{$totalHrs}}</td>
        <td><a class="btn btn-default btn-sm" data-toggle="modal" data-target="#showDetails-{{$employee->user_id}}">Details</a></td>
    </tr>
    <div class="modal inmodal fade" id="showDetails-{{$employee->user_id}}" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h3>Header</h3>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                           <p>Contents</p>
                      </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                     
                    </div>
                </div>
            </div>
     </div> 
@endforeach