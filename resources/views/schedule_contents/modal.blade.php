<div class="modal inmodal fade" id="addSchedule" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form action="/schedules" method="POST">
            {{ csrf_field() }}
            <div class="modal-content">
                <div class="modal-header no-padding">
                    <button type="button" class="close" data-dismiss="modal" style="padding: 10px"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>                   
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6" style="padding: 0">
                            <div class="col-lg-6">
                                <label>Schedule Type</label>
                                <input name="type" type="text" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label>Status</label>
                                <select class="form-control">
                                    <option value="0">Available</option>
                                    <option value="0">Unavailable</option>
                                    <option value="0">Temporarily Unavailable</option>
                                    <option value="0">Unknown</option>
                                </select>
                            </div>

                            <div class="col-lg-12">
                                <label>Company</label>
                                <select type="text" class="form-control" name="company" onchange="chdep()">
                                    @foreach (App\Company::all() as $company)
                                        @if (count($company->departments) > 0)
                                            <option value={{$company->id}}>{{ $company->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-12">
                                <label>Department</label>
                                <select class="form-control" type="text" name="department_id"></select>
                            </div>
                        </div>
                        <div class="col-lg-6" style="padding: 0">
                            <div class="col-lg-12">
                                <label>AM</label>
                                <div class="input-daterange input-group am" id="datepicker" style="width: 100%">
                                    <input type="time" class="input form-control" name=in_am>
                                    <span class="input-group-addon">to</span>
                                    <input type="time" class="input form-control" name=out_am>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <label>PM</label>
                                <div class="input-daterange input-group am" id="datepicker" style="width: 100%">
                                    <input type="time" class="input form-control" name=in_pm>
                                    <span class="input-group-addon">to</span>
                                    <input type="time" class="input form-control" name=out_pm>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-sm">Save</button>
                    </div>
                </div>
             </div>
        </form>
    </div>
</div>

<script>

    function chdep() {

        fetch ("/selectDepartment?q=" + document.querySelector("[name=company]").value, {
            method: "get",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            }
        }).then(rep => rep.text()).then(text => {
            document.querySelector("[name=department_id]").innerHTML = text;
        });

    }

    chdep();
</script>
