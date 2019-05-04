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
                   <div class="row">
                       <div class="col-lg-3 col-md-3 col-sm-5 col-xs-6">
                            <label>Biometric ID</label>
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
                                });
                                EmployeeSelect(document.getElementById('DepartmentSelector').value);
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