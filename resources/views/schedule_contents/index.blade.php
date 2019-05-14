
 <div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3">
                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addCustomSched">
                    Large Modal
                </button>
                <div class="modal inmodal fade" id="addCustomSched" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-md">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title">Add Custom Schedule</h4>
                               
                            </div>
                            <form action="/schedules" method="POST">
                                {{ csrf_field() }}
                            <div class="modal-body"> 
                               <div class="row">
                                   <div class="col-lg-6">
                                        <h4>Schedule Type:</h4>  
                                        <input type="text" placeholder="Schedule Type.." class="form-control" name="type" required>                             
                                   </div>
                                   <div class="col-lg-6">
                                        <h4>Department:</h4>        
                                        <select name="department_id" id="" class="form-control">
                                           @php($Departments = \App\Department::all())
                                           @foreach ($Departments as $Department)
                                               <option value="{{$Department->id}}">{{$Department->name}}</option>
                                           @endforeach
                                        </select>                                
                                    </div>
                               </div>
                               <hr>
                               
                               <div class="row">
                                   <h3>AM</h3>
                                    <div class="col-lg-6">
                                         <h4>Time in</h4>  
                                         <input type="time" class="form-control" value="09:00" name="in_am">                         
                                    </div>
                                    <div class="col-lg-6">
                                         <h4>Time out</h4>  
                                         <input type="time" class="form-control" value="12:00" name="out_am">                                
                                     </div>
                                </div>
                                <br>
                                <div class="row">
                                        <h3>PM</h3>
                                         <div class="col-lg-6">
                                              <h4>Time in</h4>  
                                              <input type="time" class="form-control" value="13:00" name="in_pm">                         
                                         </div>
                                         <div class="col-lg-6">
                                              <h4>Time out</h4>  
                                              <input type="time" class="form-control" value="18:00" name="out_pm">                                
                                          </div>
                                     </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                  <div class="table-responsive">
                          <table class="table table-striped table-hover scheduleTable">
                                  <thead>
                                  <tr>
                                      <th>Schedule Type</th>
                                      <th>Department</th>
                                      <th>Time in <small>(am)</small></th>
                                      <th>Time out <small>(am)</small></th>
                                      <th>Time in <small>(pm)</small></th>
                                      <th>Time out <small>(pm)</small></th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                                  </thead>
                                  <tbody id="tbody">
                                    @include ("schedule_contents.data")
                                  </tbody>
                           </table>
                  </div>
            </div>
        </div>
    </div>
 </div>
