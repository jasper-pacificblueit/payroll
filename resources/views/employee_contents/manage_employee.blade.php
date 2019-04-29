@php
    $eminfo = App\Employee::where('user_id', $user->id)->first();
@endphp

<div class="modal inmodal fade" id="manage" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header no-padding">
                <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
               <h4 style="padding:10px"></h4>
            </div>
            <form method="POST" action="/employee/{{ $user->id }}">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="modal-body">
                   <div class="row">
                       <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6">
                            <label>Biometric ID</label>
                            <br>
                            <input type="text" class="form-control" name="bio" placeholder="{{ $eminfo->bio_id ? $eminfo->bio_id : '--' }}">
                       </div>

                       <div class="col-lg-4 col-md-5 col-sm-4 col-xs-6">
                            <label>Department</label>
                            <br>
                            <select class="form-control" style="width: 100%">
                                @foreach(App\Company::find($eminfo->company_id)->departments as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                @endforeach
                            </select>
                       </div>
                   </div>
                </div>
                <div class="modal-footer">
                    <div class='btn-group'>
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>