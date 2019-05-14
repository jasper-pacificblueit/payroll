
 <div class="row">
    <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12"></div>
            </div>
            <div class="row">
                <div class="col-lg-1">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#addPosition" {{ auth()->user()->can("position_Create") ?: 'disabled' }}>
                        Add Position
                    </button>

                    @can ("position_Create")
                    <div class="modal inmodal fade" id="addPosition" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header no-padding">
                                    <button type="button" class="close" style="padding:10px" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                </div>
                                <div class="modal-body">
                                <form action="/positions" method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-lg-12" style='padding: 0px'>
                                            <div class="col-lg-6">
                                                <label>Title</label>
                                                <input type="text" name="name" id="" class="form-control" required>
                                            </div>
                                            <div class="col-lg-2">
                                                <label>Maximum</label>
                                                <input type="number" name="max" id="" class="form-control" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label>Status</label>
                                                <select class="form-control" name="state">
                                                    <option value=0 selected>Available</option>
                                                    <option value=1>Unavailable</option>
                                                    <option value=2>Temporarily Unavailable</option>
                                                    <option value=4>Unknown</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <label>Description</label>
                                            <textarea type="text" name="description" id="" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Close</button>
                                        <button type="submit" name="createPosition" class="btn btn-primary btn-sm">Create</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endcan
                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover positionTable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Date Created</th>
                                <th>Job Title</th>
                                <th class="hidden-xs hidden-sm">Description</th>
                                <th>Employee/s</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody id='update'>                                        
                                @if ( ($Positions = \App\Positions::all())->count() > 0)
                                    @foreach ($Positions as $position)
                                    <tr @can ("position_Modify") ondblclick="$('#position-{{ $position->id }}').modal('show');" @endcan>
                                        <td>
                                            {{$position->id}}
@can ("position_Modify")
<!-- @@@@@@@@@@@@ modal @@@@@@@@@@@@ -->
<div class="modal inmodal fade" id="position-{{ $position->id }}" tabindex="-1" role="dialog"  aria-hidden="true">
<div class="modal-dialog modal-md">
<div class="modal-content">
<form method="post" action="/positions/{{ $position->id }}">
    {{ csrf_field() }}
    {{ method_field("put") }}
    <div class="modal-header no-padding">
       <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12" style="padding: 0px">
                <div class="col-lg-5">
                    <label>Title</label>
                    <input type=text class="form-control" name="edit-title" placeholder="{{ $position->title }}" title={{$position->title}}>
                </div>
                <div class="col-lg-2">
                    <label>Maximum</label>
                    <input type=number class="form-control" style="width: 100%" name="edit-lim" placeholder={{ $position->lim }}>
                </div>
                <div class="col-lg-5">
                    <label>Status</label>
                    <select class="form-control" name="edit-state">
                        <option value=0 {{ $position->state != 0 ?: 'selected' }}>Available</option>
                        <option value=1 {{ $position->state != 1 ?: 'selected' }}>Unavailable</option>
                        <option value=2 {{ $position->state != 2 ?: 'selected' }}>Temporarily Unavailable</option>
                        <option value=4 {{ $position->state != 3 ?: 'selected' }}>Unknown</option>
                    </select>
                </div>
                <div class="col-lg-12">
                    <label>Description</label>
                    <textarea type="text" name="edit-description" id="" class="form-control" style="width: 100%">{{ $position->description }}</textarea>
                </div>
            </div>

          <div class="col-lg-12 col-xs-12" style="padding: 14px;">
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
            <tbody>
                <tr>
                  @foreach(['department', 'company', 'employee', 'position', 'dtr'] as $tmp)
                    <td>
                      @foreach(["Create", "Modify", "View", "Delete"] as $perm)
                      <label class="text-muted">{{ $perm }}</label>
                      <div class="icheckbox_square-green pull-right" id="checkbox-{{ $perm }}-{{ $tmp }}" style="position: relative;" title="{{ $perm }}">
                        <input type="hidden" name="{{ $tmp }}_{{ $perm }}" style="position: absolute; opacity: 0;" value=false>
                        <ins class="iCheck-helper" id="{{$tmp}}_{{$perm}}" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;" title="{{ $perm }}" onclick="
                          if (document.querySelector('#checkbox-{{ $perm }}-{{ $tmp }}').classList.contains('checked')) {
                            document.querySelector('#checkbox-{{ $perm }}-{{ $tmp }}').classList.remove('checked');
                            document.getElementsByName('{{ $tmp }}_{{ $perm }}')[0].value = false;
                          } else {
                            document.querySelector('#checkbox-{{ $perm }}-{{ $tmp }}').classList.add('checked');
                            document.getElementsByName('{{ $tmp }}_{{ $perm }}')[0].value = true;
                          }
                        "></ins>
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
                    <td>
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
                        "></ins>
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
            <button type="submit" class="btn btn-sm btn-success">Save</button>
            <button type="button" class="btn btn-sm btn-danger"
            @if ($position->id == 1 || $position->count() > 0)
                {{ 'disabled' }}
            @endif
             onclick='
                fetch("/positions/{{ $position->id }}", {
                    method: "delete",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    }
                }).then(rep => rep.text()).then(text => {
                    $(".positionTable").DataTable().destroy();
                    document.querySelector("#update").innerHTML = text;
                    $(".positionTable").DataTable({
                        pageLength: 10,
                        language: {
                            paginate: {
                                previous: `<i class="fas fa-arrow-left"></i>`,
                                next: `<i class="fas fa-arrow-right"></i>`,
                            }
                        },
                   }).draw();
                });
            '
             data-dismiss="modal">
                Remove
            </button>
        </div>
    </div>
</form>
</div>
</div>
</div>
<!-- @@@@@@@@@@@@@@@@@@@@@@@@@@@@@ -->
@endcan
                                        </td>
                                        <td>{{$position->created_at}}</td>
                                        <td>{{$position->title}}</td>
                                        <td width=450 class="hidden-xs hidden-sm">{{ $position->description }}</td>
                                        <td>{{ $position->count() }}/{{ $position->lim }}</td>
                                        <td>
                                            @php
                                                switch ($position->state) {
                                                case 0:
                                                    echo "<span class='alert-success'>Available</span>";
                                                    break;
                                                case 1:
                                                    echo "<span class='alert-warning'>Unavailable</span>";
                                                    break;
                                                case 2:
                                                    echo "<span class='alert-info'>Temporarily Unavailable</span>";
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
    </div>
 </div>