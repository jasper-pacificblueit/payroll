
@if (isset($csv_info))
<div class="row">
        <div class="col-lg-12">
                  @if(isset($csv_info))
                     
                    <h4>Payroll Date : {{ $csv_info->period}}</h4>
                        
                    <br>
                    <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                        <thead>
                        <tr>
                            <th>Employee number</th>
                            <th>Full name</th>
                            <th>Department</th>
                            <th>Rendered Hours</th>
                            <th>Total Days</th>
                            <th>Warning/s</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                                        
                                @foreach ($csv_info->employees as $employee)
                                    <tr>
                                        <td>{{$employee->bio_id}}</td>
                                        <td>{{ucwords(strtolower($employee->name))}}</td>
                                        <td>{{$employee->dep}}</td>

                                        <?php $totalHrs = 0; $diff = array(); $TotalWarning = array();$Warning = 0;?>
                                        <?php $totalDays = 0; ?>

                                            @foreach ($employee->attendance as $attendance)
                                                
                                                @if($attendance->absent)
                                                    <?php 
                                                        $diff =0;
                                                    ?>
                                                @else
                                                    <?php
                                                        
                                                        if(empty($attendance->am['out']) && empty($attendance->pm['out'])){
                                                                $diff = "<b style='color:orange;'>W</b>";
                                                                $Warning++;
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
                                                        $totalDays++;
                                                    ?>
                                                        
                                                    <?php $totalHrs += (float)$diff; ?>
                                                    

                                                @endif
                                                        
                                                        
                                            @endforeach

                                        <td><?php echo $totalHrs; ?></td>
                                        <td><?php echo $totalDays; ?></td>
                                        <td><?php echo $Warning; ?></td>
                                        
                                        <td><a class="btn btn-default btn-sm" data-toggle="modal" data-target="#showDetails-{{$employee->bio_id}}">Details</a></td>
                                    
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

                                
                            <Br>
                            <a href="/dtr" class="btn btn-default">Cancel</a>
                            <a class="btn btn-success pull-right" data-toggle="modal" data-target="#showWarning">Next</a>
                            
                                
                      
                            
                    </div>
                    
                    @endif
           
        </div>

    </div>

    
 @foreach ($csv_info->employees as $employee)
 <div class="modal inmodal fade" id="showDetails-{{$employee->bio_id}}" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h3>{{ucwords(strtolower($employee->name))}}</h3>
                   
                </div>
                <div class="modal-body">
                  <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-group clear-list m-t">
                                        <li class="list-group-item fist-item">
                                            <label class="pull-right">Rendered Hours/Status</label>
                                            <label>{{$csv_info->period}}</label>
                                        </li>

                                 <?php $totalHrs = 0; $diff = array();?>
                                 @foreach ($employee->attendance as $attendance)
                                    @if($attendance->absent)
                                        <li class="list-group-item">
                                            <span class="pull-right"><b style="color:red">Absent</b></span>
                                            <span>{{$attendance->ddww}}</span>
                                        </li>
                                    @else

                                    <?php
                                                      
                                        if(empty($attendance->am['out']) && empty($attendance->pm['out'])){
                                            $diff = "<b style='color:orange;'>Warning</b>";
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
                                
                                        <li class="list-group-item">
                                            <span class="pull-right"><?php echo $diff; ?></span>
                                            <span>{{$attendance->ddww}}</span>
                                        </li>
                                        <?php $totalHrs += (float)$diff; ?>
                                    @endif
                                    
                                
                                  @endforeach

                                        <li class="list-group-item">
                                            <label class="pull-right">{{$totalHrs}}</label>
                                            <label>Total Hours</label>
                                        </li>
                            </ul>
                             
                        </div>
                  </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                 
                </div>
            </div>
        </div>
 </div> 
 @endforeach

 <div class="modal inmodal fade" id="showWarning" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Set Value for Warnings</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <div class="modal-body">
                  <div class="row">
                        <div class="col-lg-12">
                          <div class="table-responsive">
                                <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Bio number</th>
                                            <th>Employee name</th>
                                            <th>Time in</th>
                                            <th>Set time out</th>
                                            <th>Total Hour</th>
                                            
                                            <th>Set ID number</th>
                                            
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach ($csv_info->employees as $employee)
                                            <tr>
                                                <td>{{$employee->bio_id}}</td>
                                                <td>{{ucwords(strtolower($employee->name))}}</td>
                                                <td>
                                                    @foreach ($employee->attendance as $attendance)
                                                       
                                                        @if (empty($attendance->am['out']) && empty($attendance->pm['out']))
                                                            @if (!empty($attendance->am['in']) || !empty($attendance->pm['in']))
                                                                @if(!empty($attendance->am['in']))
                                                                     <input type="time" value="{{$attendance->am['in']}}" class="form-control" style="background:transparent" readonly>
                                                                     <br>
                                                                @elseif(!empty($attendance->pm['in']))
                                                                 <input type="time" value="{{$attendance->pm['in']}}" class="form-control" style="background:transparent" readonly>
                                                                     <br>
                                                                @endif
                                                            @endif
                                                        @endif
                                                          
                                                       

                                                    @endforeach
                                                </td>

                                                <td>
                                                    @foreach ($employee->attendance as $attendance)
                                                       
                                                        @if (empty($attendance->am['out']) && empty($attendance->pm['out']))
                                                            @if (!empty($attendance->am['in']) || !empty($attendance->pm['in']))
                                                              <div class="input-group clockpicker" data-autoclose="true">
                                                                    <input type="time" class="form-control" value="18:00">
                                                                    <span class="input-group-addon">
                                                                        <span class="fa fa-clock-o"></span>
                                                                    </span>    
                                                                </div>
                                                                <br>
                                                            @endif
                                                        @endif
                                                          
                                                       

                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach ($employee->attendance as $attendance)
                                                       
                                                    @if (empty($attendance->am['out']) && empty($attendance->pm['out']))
                                                        @if (!empty($attendance->am['in']) || !empty($attendance->pm['in']))
                                                            <input type="text" value="--" class="form-control"style="background:transparent;" readonly>
                                                            <br>
                                                        @endif
                                                    @endif
                                                      
                                                   

                                                @endforeach
                                                </td>
                                                <td>
                                                    <select name="" id="" class="form-control">
                                                        <option value="">--</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                      
                                      
                                        </tbody>
                                    </table>
                          </div>
                         

                        </div>
                  </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
 </div>
 <input type="button" name="" id="Notif1"  class="btn btn-success btn-sm demo2" style="display:none;">
 
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
