
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

            <div class="col-lg-12">
             <label>E-mail</label>
             <input type="email" name="email" class="form-control p-2" required>
            </div>

            <div class="col-lg-12">
             <label>Mobile number</label>
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
              <div class="col-lg-4">
                <label>Birthdate</label>
                <input type="date" name="birthdate" class="form-control" required>
              </div>

              <div class="col-lg-4">
                <label>Age</label>
                <input type="text" name="age" class="form-control" required>
              </div>

              <div class="col-lg-12">
                <label>Address</label>
                <input type="text" name="address" class="form-control" required>
              </div>

          </div>
      </div>
      <hr style="margin: 5px">
      <div class="row">
      	<div class="col-lg-12" style="padding: 0px">
          <div class="col-lg-6">
            <h2>User Accounts</h2>
          </div>
          <div class="col-lg-6">
            <h2>Permissions</h2>
          </div>
      	</div>
      </div>
      <div class="row">
        <div class="col-lg-1">
          <label>Biometric ID</label>
          <input type="text" name="bio" class="form-control">
        </div>
        <div class="col-lg-2">
              <label>Employee Username</label>
              <input type="text" name="user" class="form-control" required>
        </div>
        <div class="col-lg-3">
              <label>Employee Password</label>
              <input type="password" name="pass" class="form-control" required>
        </div>

        <div class="col-lg-6 pull-right">
          <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Department</th>
                <th>Company</th>
                <th>Employee</th>
                <th>Positions</th>
                <th>Payroll</th>
                <th>DTR</th>
              </tr>
            </thead>
            <tbody class="i-checks">
                <tr>
                  @foreach(['department', 'company', 'employee', 'position', 'payroll', 'dtr'] as $tmp)
                    <td>
                      @foreach(["Create", "Modify", "View", "Delete"] as $perm)
                      <label class="text-muted">{{ $perm }}</label>
                      <div class="icheckbox_square-green pull-right" id="checkbox-{{ $perm }}-{{ $tmp }}" style="position: relative;">
                        <input type="hidden" name="{{ $tmp }}_{{ $perm }}" style="position: absolute; opacity: 0;" value=false>
                        <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;" title="{{ $perm }}" onclick="
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
      	<div class="col-lg-12">
      		<h2>Workplace & Schedule</h2>
      	</div>
      	<div class="col-lg-3 col-sm-6">
              
      		<label>Company</label>
          <select class="form-control" name="company" onchange="chdep()" required>
            @foreach($company as $i)
              <option value="{{ $i->id }}">{{ $i->name }}</option>
            @endforeach
          </select>

        </div>
        <div class="col-lg-3 col-sm-6">
        	<label>Department</label>
          <select class="form-control company-dep" name="department" required>
            @foreach($company[0]->departments as $dep)
              <option value="{{ $dep->id }}" selected>{{$dep->name}}</option>
            @endforeach       
          </select>
        </div>

      </div>
      <hr style="margin: 5px">
      <div class="row">
      	<div class="col-lg-12" style="padding: 0px">
      		<div class="col-lg-6">
            <h2>Positions</h2>
          </div>
          <div class="col-lg-6">
            <h2>Rates</h2>
          </div>
      	</div>
      </div>
      <div class="row">
      	<div class="col-lg-6 col-sm-6">
      	 <label>Position</label>
         <select class='form-control' name='position' required>
            @foreach (App\Positions::where('id', '!=', 1)->get() as $position)
              <option value={{ $position->id }}>{{ $position->title }}</option>
            @endforeach
         </select>
      	</div>

        <br class="hidden-lg">

        <div class="col-lg-6 col-sm-6" style="padding: 0">
          <div class="col-lg-3 col-xs-3">
            <label>Hourly</label>
            <input class="form-control" type="text" name="hourly_rate" placeholder="Rate">
          </div>
          <div class="col-lg-3 col-xs-3">
            <label>Overtime</label>
            <input class="form-control" type="text" name="ot_rate" placeholder="Rate">
          </div>
          <div class="col-lg-3 col-xs-3">
            <label>Holiday</label>
            <input class="form-control" type="text" name="holiday" placeholder="Rate">
          </div>
          <div class="col-lg-3 col-xs-3">
            <label title="Night Differential">Night Diff.</label>
            <input class="form-control" type="text" name="nightdiff_rate" placeholder="Rate">
          </div>
        </div>

        <div class="col-lg-6"></div>
        <div class="col-lg-6">



        </div>
        
      </div>

      <div class="row">

      </div>

      <hr style="margin: 5px">
      <div class="row">
          <div class="col-lg-12">
              
              <div class="form-group text-right">
                  <div >
                      <button class="btn btn-success" type="submit">Submit</button>
                  </div>
              </div>
          </div>
      </div>
  </form>
</div>
</div>
