
<div class="col-lg-12">
        @php( $dtrRecords = \App\DateTimeRecord::all() )
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Employee number</th>
                    
                        <th>Time in <small>AM</small> </th>
                        <th>Time out <small>AM</small> </th>
                        <th>Time in <small>PM</small> </th>
                        <th>Time out <small>PM</small> </th>
                        
                       
                    </tr>
                    </thead>
                    <tbody>
                           @foreach ($dtrRecords as $dtrRecord)
                               <tr>
                                    @php( $profile = \App\Profile::find($dtrRecord->user_id) )
                                   <td>{{$dtrRecord->user_id}} - {{$profile->fname}} {{$profile->lname}}</td>
                                  
                                      
                                                <td>{{$dtrRecord->in_am}}</td>
                                   <td>{{$dtrRecord->out_am}}</td>
                                   <td>{{$dtrRecord->in_pm}}</td>
                                   <td>{{$dtrRecord->out_pm}}</td>
                                   
                               </tr>
                           @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Employee number</th>
                        <th>Full name</th>
                        <th>Department</th>
                        <th>Rendered Hours</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                    </table>  
        </div>
    </div>
