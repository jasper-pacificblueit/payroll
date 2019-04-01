
@if (isset($csv_info))
<div class="row">
        <div class="col-lg-12">
                  @if(isset($csv_info))
                     
                        <h4>Period : {{ $csv_info->period}}</h4>
                       
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                    </tr>
                    </tfoot>
                    </table>    

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                        <th>Employee</th>
                                            <?php
                                                $days = GetDays($start , $end);
                                            ?>

                                            @foreach ($csv_info->employees[0]->attendance as $attendance)
                                            <td>{{$attendance->ddww}}</td> 
                                            @endforeach

                                        <th>Total Hrs</th>
                                        </tr>
                                       
                                    </thead>
                                     <tbody>
                                      
                                        @foreach ($csv_info->employees as $employee)
                                            <tr>
                                                <td>{{ucwords(strtolower($employee->name))}}</td>
                                                
                                                <?php $totalHrs = 0; $diff = array();?>
                                                @foreach ($employee->attendance as $attendance)
                                            
                                                    @if($attendance->absent)
                                                    <td><b style="color:red;">A</b></td>
                                                    @else
                                                    <?php
                                                      
                                                        if(empty($attendance->am['out']) && empty($attendance->pm['out'])){
                                                            $diff = "<b style='color:orange;'>W</b>";
                                                        }
                                                        else if(empty($attendance->am['out'])){
                                                            $am_in = strtotime($attendance->am['in']);
                                                            $pm_out = strtotime($attendance->pm['out']);
                                                            $diff = round(abs($am_in - $pm_out) / 3600 , 1);
                                                        }
                                                        
                                                       
                                                        else if(empty($attendance->pm['out'])){
                                                            $am_in = strtotime($attendance->am['in']);
                                                            $am_out = strtotime($attendance->am['out']);
                                                            $diff = round(abs($am_in - $am_out) / 3600 , 1);
                                                        }

                                                    ?>
                                                    
                                                    <?php $totalHrs += (float)$diff; ?>
                                                    <td><?php echo $diff; ?></td>
                                                   
                                                    

                                                    @endif
                                                    
                                                    
                                                @endforeach

                                                
                                                <td>{{$totalHrs}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <Br>
                            <a href="/dtr" class="btn btn-default">Cancel</a>
                            <a class="btn btn-success pull-right" data-toggle="modal" data-target="#showWarning">Save</a>
                            
                                
                      
                       
                    
                    @endif
           
        </div>

    </div>

@else
    <div class="row">
        

        <div class="col-lg-6">
           
            <div class="row">
                <div class="col-sm-12 m-b-xs">
                    <h4>Import Attendance</h4>
                    <form method="POST" action="/dtr/view" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                            <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="upload-file" required></span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                        </div>
                       
                        
                </div>
               
            </div>
           
            <div class="row">
                <div class="col-lg-2">
                    <button type="submit" class="form-control">View</button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12 m-b-xs">
                    <h4>Export File Format</h4>
                    <div class="btn-group">
                        <button class="btn btn-white" type="button">xlsx</button>
                        <button class="btn btn-white" type="button">csv</button>
                        <button class="btn btn-white" type="button">xls</button>
                    </div>


                </div>
           </div>
           
       
        </div>

        <div class="col-lg-6">
         
            <div class="row">
                <div class="col-lg-12" >
                    
                    <p>Recent Upload File</p>
                    <div class="row">
                        <div class="col-sm-12 m-b-xs">
                         
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>ID number</th>
                                    <th>Full name</th>
                                    <th>Department</th>
                                    <th>Total Rendered Hours</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="#">See more details</a>
                        </div>
                   </div>
                </div>
        
            </div>
        </div>
    </div>
@endif
