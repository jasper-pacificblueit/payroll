<div class="row">
    <div class="col-lg-3">
       <form action="/dtr-records" method="POST" id="selectDateForm">
            @php( $payrollDates = \App\PayrollDate::all() )
            {!! csrf_field() !!}
             <h4>Payroll Date:</h4>
     
            
            <select name="DateSelector" id="DateSelector" class="form-control" onchange="this.form.submit()">
                <option value="">--Select a date--</option>
                @foreach ($payrollDates as $payrollDate)
                <option value="{{$payrollDate->id}}">{{date("M d" , strtotime($payrollDate->start))}} - {{date("M d Y" , strtotime($payrollDate->end))}}</option>                
                @endforeach
            </select>
           
       </form>
        
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
                    <tbody>
                          
                        @if (isset($date))
                        <?php
                            $start = $date->start;
                            $end = $date->end;   
                        ?>
                        @php( $dtrRecords = \App\DateTimeRecord::distinct()->get(['user_id']))
                        
                        @foreach ($dtrRecords as $record)
                            <tr>
                                @php( $profile = \App\Profile::find($record->user_id))
                                <td>{{$profile->fname}} {{$profile->lname}}</td>

                                
                                @php( $attendances = \App\DateTimeRecord::all()->where('user_id' , '=' , $record->user_id , 'AND' , 'date', '>=' , $start , 'date' , '<=' , $end))
                                <?php $dayCount = 0;?>
                                @foreach ($attendances as $attendance)
                                    <?php
                                    
                                    $dayCount++;
                                    ?>
                                @endforeach
                                <td>--</td>
                                <td>--</td>
                                
                                <td>{{$dayCount}}</td>
                                <td>{{$dayCount}}</td>
                                <td>{{$dayCount}}</td>

                                <td><button class="btn btn-default btn-xs">Details</button></td>
                              
                            </tr>
                        @endforeach

                        <script>
                            document.getElementById('DateSelector').value = '{{$date->id}}';
                           
                        </script>
                        @else
                         
                           
                         @endif
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