@php( $dtrRecords = \App\DateTimeRecord::with('getProfile')->distinct()->get(['user_id']))
@foreach ($dtrRecords as $record)
<tr>
    
    <td>{{$record->getProfile->lname}}</td>
    <td>--</td>
    <td>--</td>
   
    @php( $attendances = \App\DateTimeRecord::all()->where('user_id' , '=' , $record->user_id , 'AND' , 'date', '>=' , $data->start , 'date' , '<=' , $data->end))
    <?php $dayCount = 0; $total_hours = 0;?>
      @foreach ($attendances as $attendance)
      <?php
       $dayCount++;
       $total_hours += $attendance->total_hours;
      ?>                             
      @endforeach
    <td>{{$total_hours}}</td>
    <td>{{$dayCount}}</td>
    <td>--</td>
   
    <td><button class="btn btn-default btn-xs">Details</button></td>
  
</tr>
@endforeach