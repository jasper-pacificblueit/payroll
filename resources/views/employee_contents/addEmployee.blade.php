
@php($company = App\Company::all())
<div class="row">
<div class="col-lg-12">
  <form method="post" action="/employee/keep">
    {{ csrf_field() }}
      <div class="row">
      		<div class="col-lg-12">
    				<h2>Employee Information</h2>
    			</div>
          <div class="col-lg-6 col-sm-6" style="padding: 0">
            <div class="col-lg-4">
             <label>First name</label>
             <input type="text" name="firstName" class="form-control p-2" required>
            </div>

            <div class="col-lg-4">
             <label>Last name</label>
             <input type="text" name="lastName" class="form-control p-2" required>
            </div>

            <div class="col-lg-4">
             <label>Middle name</label>
             <input type="text" name="middleName" class="form-control p-2" required>
            </div>

            <div class="col-lg-6">
             <label>E-mail</label>
             <input type="email" name="email" class="form-control p-2" required>
            </div>

            <div class="col-lg-6">
             <label>Mobile Number</label>
             <input type="text" name="mobile" class="form-control p-2" required>
            </div>
          </div>

          <div class="col-lg-6 col-sm-6" style="padding: 0">
              <div class="col-lg-4">
                <label>Gender</label>
                <select class='form-control' name='gender' required>
                  <option value='1'>Male</option>
                  <option value='0'>Female</option>
                </select>
              </div>
              <div class="col-lg-6">
                <label>Birthdate</label>
                <input type="date" name="birthdate" class="form-control" required oninput="

                  fetch ('/getServerTime', {
                    method: 'get',
                    headers: {
                      'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    }
                  }).then(rep => rep.json()).then(json => {

                    var date = new Date(json.carbon.date);
                    var bday = new Date(this.value);

                    document.querySelector('[name=age]').value = Math.floor(
                      (date.getYear() - bday.getYear()) - (date.getMonth()/bday.getMonth() - date.getDate()/bday.getDate())
                    );  

                  });

                ">
              </div>

              <div class="col-lg-2">
                <label>Age</label>
                <input type="text" name="age" class="form-control" readonly>
              </div>

              <div class="col-lg-12">
                <label>Address</label>
                <input type="text" name="address" class="form-control" required>
              </div>

          </div>
      </div>
      <br>
      <hr style="margin: 5px">
      <div class="row">
      	<div class="col-lg-12" style="padding: 0px">
          <div class="col-lg-6">
            <h2>User Accounts</h2>
          </div>
          <div class="col-lg-6 hidden-xs hidden-md">
            <h2>Permissions <small>(optional)</small></h2>
          </div>
      	</div>
      </div>
      <div class="row">
        <div class="col-lg-6" style='padding: 0'>
          <div class="col-lg-2">
            <label>Bio. ID</label>
            <input type="text" name="bio" class="form-control">
          </div>
          <div class="col-lg-5">
                <label>Username</label>
                <input type="text" name="user" class="form-control" required>
          </div>
          <div class="col-lg-5">
                <label>Password</label>
                <input type="password" name="pass" class="form-control" required>
          </div>

          <div class="col-lg-12">
           <h2>Positions</h2>
           <label>Position</label>
           <select class='form-control' name='position' onchange="autoFillPerm(this)" required>
              @foreach (App\Positions::all() as $position)
                <option value={{ $position->id }}>{{ $position->title }}</option>
              @endforeach
           </select>
          </div>
        </div>

        <br class="hidden-lg">


        <div class="col-lg-6 pull-right col-xs-12" style="padding: 14px;">
          <h2 class="hidden-lg">Permissions (optional)</h2>
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

      <hr style="margin: 5px">


      <div class="row">
        <div class="col-lg-6" style="padding: 0">
          <div class="col-lg-12">
            <h2>Workplace</h2>
          </div>
          <div class="col-lg-6 col-sm-6">
            <label>Company</label>
            <select class="form-control" name="company" onchange="chdep()" required>
              @foreach($company as $i)
                @if (count($i->departments) > 0)
                <option value="{{ $i->id }}">{{ $i->name }}</option>
                @endif
              @endforeach
            </select>
          </div>

          <div class="col-lg-6 col-sm-6">
            <label>Department</label>
            <select class="form-control company-dep" name="department" onchange="chsched(this.value)" required>
              @foreach($company[0]->departments as $dep)
                <option value="{{ $dep->id }}" selected>{{$dep->name}}</option>
              @endforeach       
            </select>
          </div>
        </div>
      	

        <div class="col-lg-6" style="padding: 0">
            <div class="col-lg-12">
              <h2>Schedules</h2>
            </div>
            <div class="col-lg-2">
              <label>Type</label>
              <select class="form-control" name="schedule" required onchange="chtype(this.value, this.options[this.selectedIndex].innerHTML)"></select>
            </div>
            <div class="col-lg-5">
              <label>AM</label>
              <div class="input-daterange input-group am" id="datepicker">
                  <input type="time" class="input form-control" name="in_am" value="">
                  <span class="input-group-addon">to</span>
                  <input type="time" class="input form-control" name="out_am" value="">
              </div>
            </div>
            <div class="col-lg-5">
              <label>PM</label>
              <div class="input-daterange input-group pm" id="datepicker">
                  <input type="time" class="form-control" name="in_pm" value="">
                  <span class="input-group-addon">to</span>
                  <input type="time" class="form-control" name="out_pm" value="">
              </div>
            </div>
        </div>
      </div>

      <hr style="margin: 5px">

      <div class="row">
      	<div class="col-lg-12" style="padding: 0px">
          <div class="col-lg-6">
            <h2>Rates</h2>
          </div>
          <div class="col-lg-6">
            <h2 class="hidden-xs hidden-sm hidden-md">Deductions</h2>
          </div>
      	</div>
      </div>
      <div class="row">
        <br class="hidden-lg">

        <div class="col-lg-6 col-sm-6" style="padding: 0">
          <div class="col-lg-3">
            <label>Monthly</label>
            <input class="form-control" type="text" name="hourly_rate" placeholder="Salary">
          </div>
          <div class="col-lg-2 col-xs-3">
            <label>Hourly</label>
            <input class="form-control" type="text" name="hourly_rate" placeholder="Rate">
          </div>
          <div class="col-lg-2 col-xs-3">
            <label>Overtime</label>
            <input class="form-control" type="text" name="ot_rate" placeholder="Rate">
          </div>
          <div class="col-lg-2 col-xs-3">
            <label>Holiday</label>
            <input class="form-control" type="text" name="holiday" placeholder="Rate">
          </div>
          <div class="col-lg-3 col-xs-3">
            <label title="Night Differential">Night Diff.</label>
            <input class="form-control" type="text" name="nightdiff_rate" placeholder="Rate">
          </div>
        </div>

        <div class="col-lg-6"></div>
        <div class="col-lg-6"></div>
        
      </div>

      <div class="row">

      </div>

      <hr style="margin: 5px">
      <div class="row">
          <div class="col-lg-12">
              
              <div class="form-group text-right">
                  <div >
                      <button class="btn btn-success btn-sm" type="submit">Submit</button>
                  </div>
              </div>
          </div>
      </div>
  </form>
</div>
</div>

<script>
  var perm = undefined;
  function autoFillPerm(obj) {
    if (perm)
      perm.forEach(function (v) {
        document.querySelector('#'+v).click();
      });

    var z = obj.options[obj.selectedIndex];

    switch (z.innerHTML) {
      case "Administrator":
        perm = [
          @foreach (App\User::getPerms()['admin'] as $perm)
            "{{ $perm }}",
          @endforeach
        ];
        break;
      case "Human Resources Manager":
        perm = [
          @foreach (App\User::getPerms()['hr'] as $perm)
            "{{ $perm }}",
          @endforeach
        ];
        break;
      default: perm = ['dtr_View'];
    }

    @foreach (['department', 'company', 'employee', 'position', 'dtr', 'payroll', 'rate', 'schedule', 'deduction', 'earning'] as $perm)
      @foreach (['Create', 'View', "Modify", "Delete"] as $op)
        document.querySelector('#checkbox-{{$op}}-{{$perm}}').classList.contains('checked') ? 
          document.querySelector('#checkbox-{{$op}}-{{$perm}}').classList.remove('checked') : '';
      @endforeach
    @endforeach

    perm.forEach(function (v) {
      document.querySelector('#'+v).click();
    });
  }

  function chsched(dep_id) {
    fetch ("/employee/add/schedules/" + dep_id).then(rep => rep.text()).then(text => {
      var schedule = document.querySelector("[name=schedule]");
      schedule.innerHTML = text;
      console.log(schedule);
      chtype(schedule.value, schedule.options[schedule.selectedIndex].innerHTML);
    });
  }

  function chtype(sched_id, type) {
    fetch ("/employee/add/schedules/" + sched_id + "/" + type + "/json").then(rep => rep.json()).then(json => {

        if (type == "Custom") {
          document.querySelector("[name=in_am]").value = "";
          document.querySelector("[name=out_am").value = "";
          document.querySelector("[name=in_pm]").value = "";
          document.querySelector("[name=out_pm]").value = "";
          return;
        }
        
        document.querySelector("[name=in_am]").value = json.in_am;
        document.querySelector("[name=out_am").value = json.out_am;
        document.querySelector("[name=in_pm]").value = json.in_pm;
        document.querySelector("[name=out_pm]").value = json.out_pm;

    });
  }


  chsched(document.querySelector(".company-dep").value);
  autoFillPerm(document.getElementsByName('position')[0]);

</script>
