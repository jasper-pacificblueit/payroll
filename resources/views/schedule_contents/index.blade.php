<div class="row">
  <div class="col-lg-12">
      <div class="row">
          <div class="col-lg-12">
                <button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#addSchedule">Add Schedule</button>
          </div>
          @include('schedule_contents.modal')
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
                                    <th>Designated to</th>
                                    <th>Time in <small>(am)</small></th>
                                    <th>Time out <small>(am)</small></th>
                                    <th>Time in <small>(pm)</small></th>
                                    <th>Time out <small>(pm)</small></th>
                                    <th width=50>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody id="scheduleData">
                                  @include ("schedule_contents.data")
                                </tbody>
                         </table>
                </div>
          </div>
      </div>
  </div>
</div>


