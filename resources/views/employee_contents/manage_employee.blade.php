@php
    $eminfo = App\Employee::where('user_id', $user->id)->first();
@endphp

<div class="modal inmodal fade" id="manage" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               <h4 style="padding:10px">    </h4>
            </div>
            <form method="POST" action="/employee/{{ $user->id }}" onsubmit="

                event.preventDefault();

                var form = this;

                fetch('/employee/{{ $user->id }}', {
                    method: 'post',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify((function() {

                        var json = {};

                        for (var i in form.elements)
                            if (form.elements[i].name && form.elements[i].value)
                                json[form.elements[i].name] = form.elements[i].value;
                            else if (form.elements[i].name)
                                json[form.elements[i].name] = form.elements[i].placeholder;

                        console.log(json);

                        return json;
                    })()),

                }).then(rep => {console.log(rep); return rep.text(); }).then(txt => {
                    $('#manage #close').click();
                    EmployeeSelect(document.querySelector('#DepartmentSelector').value);
                });



            ">
                <div class="modal-body">
                   <div class="row" style="padding: 0px">
                       <div class="col-lg-12" style="padding: 0px">
                       <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
                            <label>Bio. ID</label>
                            <br>
                            <input type="text" class="form-control" name="bio" placeholder="{{ $eminfo->bio_id ? $eminfo->bio_id : '--' }}">
                       </div>
                       <div class="col-lg-4 col-md-5 col-sm-4 col-xs-6">
                            <label>Department</label>
                            <br>
                            <select class="form-control" name="department" style="width: 100%">
                                @foreach(App\Company::find($eminfo->company_id)->departments as $dep)
                                    <option value="{{ $dep->id }}" {{ $eminfo->department_id == $dep->id ? 'selected' : '' }}>{{ $dep->name }}</option>
                                @endforeach
                            </select>
                       </div>
                       </div>

                   </div>

                   <div class="row" style="padding: 14px">
                      <br>
                      <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>Department</th>
                                <th>Company</th>
                                <th>Employee</th>
                                <th>Positions</th>
                                <th>DTR</th>
                              </tr>
                            </thead>
                            <tbody class="i-checks">
                                <tr>
                                  @php
                                    $user = App\User::find($eminfo->user_id);
                                  @endphp
                                  @foreach(['department', 'company', 'employee', 'position', 'dtr'] as $tmp)
                                    <td width=100>
                                      @foreach(["Create", "Modify", "View", "Delete"] as $perm)
                                      <label class="text-muted">{{ $perm }}</label>
                                      <div class="icheckbox_square-green pull-right" id="checkbox-{{ $perm }}-{{ $tmp }}" style="position: relative;">
                                        <input type="hidden" name="{{ $tmp }}_{{ $perm }}" style="position: absolute; opacity: 0;" value=false>
                                        <ins class="iCheck-helper" id="{{$tmp}}_{{$perm}}" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;" title="{{ $perm }}" onclick="
                                          if (document.querySelector('#checkbox-{{ $perm }}-{{ $tmp }}').classList.contains('checked')) {
                                            document.querySelector('#checkbox-{{ $perm }}-{{ $tmp }}').classList.remove('checked');
                                            document.getElementsByName('{{ $tmp }}_{{ $perm }}')[0].value = false;
                                          } else {
                                            document.querySelector('#checkbox-{{ $perm }}-{{ $tmp }}').classList.add('checked');
                                            document.getElementsByName('{{ $tmp }}_{{ $perm }}')[0].value = true;
                                          }
                                        ">
                                          <img src="" hidden onerror='

                                            @if ($user->hasPermissionTo($tmp . "_" . $perm))
                                                $("#{{$tmp}}_{{$perm}}").click();
                                            @endif

                                        '>
                                        </ins>
                                      </div>
                                      <br>
                                      @endforeach
                                    </td>
                                  @endforeach
                                </tr>
                                <tr>
                                  <thead>
                                    <th>Payroll</th>
                                    <th>Rate</th>
                                    <th>Schedule</th>
                                    <th>Deduction</th>
                                    <th>Earning</th>
                                  </thead>
                                </tr>
                                <tr>
                                  @foreach(['payroll', 'rate', 'schedule', 'deduction', 'earning'] as $tmp)
                                    <td width=500>
                                      @foreach(["Create", "Modify", "View", "Delete"] as $perm)
                                      <label class="text-muted">{{ $perm }}</label>
                                      <div class="icheckbox_square-green pull-right" id="checkbox-{{ $perm }}-{{ $tmp }}" style="position: relative;">
                                        <input type="hidden" name="{{ $tmp }}_{{ $perm }}" style="position: absolute; opacity: 0;" value=false>
                                        <ins class="iCheck-helper" id="{{$tmp}}_{{$perm}}" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;" title="{{ $perm }}" onclick="
                                          if (document.querySelector('#checkbox-{{ $perm }}-{{ $tmp }}').classList.contains('checked')) {
                                            document.querySelector('#checkbox-{{ $perm }}-{{ $tmp }}').classList.remove('checked');
                                            document.getElementsByName('{{ $tmp }}_{{ $perm }}')[0].value = false;
                                          } else {
                                            document.querySelector('#checkbox-{{ $perm }}-{{ $tmp }}').classList.add('checked');
                                            document.getElementsByName('{{ $tmp }}_{{ $perm }}')[0].value = true;
                                          }
                                        ">
                                        <img src="" hidden onerror='

                                            @if ($user->hasPermissionTo($tmp . "_" . $perm))
                                                $("#{{$tmp}}_{{$perm}}").click();
                                            @endif

                                        '>
                                      </ins>
                                        
                                      </div>
                                      <br>
                                      @endforeach
                                    </td>
                                  @endforeach
                                </tr>
                            </tbody>
                            <tfoot>
                            </tfoot>
                          </table>
                        </div>
                       </div>
                </div>
                <div class="modal-footer">
                    <div class='btn-group'>
                        <button type="button" class="btn btn-sm btn-success" data-dismiss="modal" id='close'>Close</button>
                        <button type="submit" class="btn btn-sm btn-success" name="submit" onclick="document.querySelector('#btnclick-{{ $eminfo->user_id }}').disabled = false;">Save</button>
                        <button class="btn btn-sm btn-danger" 
                            onclick="
                                fetch('/employee/{{ $eminfo->user_id }}', {
                                    method: 'delete',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    }
                                }).then(function() { 
                                    EmployeeSelect(document.getElementById('DepartmentSelector').value);
                                });
                                
                            " data-dismiss="modal">
                            Remove
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<img hidden="true" src="..." onerror='

    $("#manage").on("hide.bs.modal", function (e) {
        document.querySelector("#btnclick-{{ $eminfo->user_id }}").disabled = false;
    });

'>