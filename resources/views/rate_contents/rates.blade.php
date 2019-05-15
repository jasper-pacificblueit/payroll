<div class="row">
    <div class="col-lg-12" style="padding: 0">
        <div class="col-lg-2">
            <select class="form-control select2_demo_1 com" onchange="chdepartment(this)">
                @foreach (App\Company::all() as $company)
                    @if (count($company->departments) > 0)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endif
                @endforeach
            </select>

        </div>
        <div class="col-lg-2">
            <select class="form-control select2_demo_2 dep" onchange="chemployee(this)"></select>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive" >
                <table class="table table-striped table-hover ratesTable">
                        <thead>
                        <tr>
                            <th>Bio ID</th>
                            <th>Employee</th>
                            <th>Salary</th>
                            <th>Hourly</th>
                            <th>Overtime</th>
                            <th>Holiday</th>
                            <th>Night Diff.</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="employeelist"></tbody>
                 </table>
        </div>
    </div>
    
</div>
