
@php($company = App\Company::all())
<div class="row">
<div class="col-lg-12">
  <form method="post" action="/employee/keep">
    {{ csrf_field() }}
      <div class="row">
      		<div class="col-lg-12">
    				<h2>Employee Information</h2>
    				<br>
    			</div>
          <div class="col-lg-6 col-sm-6">
             <label>First name</label>
             <input type="text" name="firstName" class="form-control p-2" required>

             <label>Last name</label>
             <input type="text" name="lastName" class="form-control p-2" required>

             <label>Middle name</label>
             <input type="text" name="middleName" class="form-control p-2" required>

             <label>E-mail</label>
             <input type="email" name="email" class="form-control p-2" required>

             <label>Mobile number</label>
             <input type="text" name="mobile" class="form-control p-2" required>
          </div>

          <div class="col-lg-6 col-sm-6">
              <label>Gender</label>
              <select class='form-control' name='gender' required>
                <option value='1'>Male</option>
                <option value='0'>Female</option>
              </select>
              <label>Birthdate</label>
              <input type="date" name="birthdate" class="form-control" required>

              <label>Age</label>
              <input type="text" name="age" class="form-control" required>

              <label>Address</label>
              <input type="text" name="address" class="form-control" required>

              
          </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="row">
      	<div class="col-lg-12">
      		<h2>User Account & Permissions</h2>
      	</div>
      	<div class="col-lg-6">
              

              <label>Employee Username</label>
              <input type="text" name="user" class="form-control" required>

              <label>Biometric ID</label>
              <input type="text" name="bio" class="form-control">

        </div>
        <div class="col-lg-6">

              <label>Employee Password</label>
              <input type="password" name="pass" class="form-control" required>

        </div>

      </div>
      <div class="hr-line-dashed"></div>
      <div class="row">
      	<div class="col-lg-12">
      		<h2>Workplace & Schedule</h2>
      	</div>
      	<div class="col-lg-6 col-sm-6">
              
      		<label>Company</label>
          <select class="form-control" name="company" onchange="chdep()" required>
            @foreach($company as $i)
              <option value="{{ $i->id }}">{{ $i->name }}</option>
            @endforeach
          </select>

        </div>
        <div class="col-lg-6 col-sm-6">
        	<label>Department</label>
          <select class="form-control company-dep" name="department" required>
            @foreach($company[0]->departments as $dep)
              <option value="{{ $dep->id }}">{{$dep->name}}</option>
            @endforeach       
          </select>
        </div>

      </div>
      <div class="hr-line-dashed"></div>
      <div class="row">
      	<div class="col-lg-12">
      		<h2>Positions & Rates</h2>
      	</div>
      	<div class="col-lg-6 col-sm-6">
      	 <label>Position</label>
         <select class='form-control' name='position' required>
            @foreach (App\Positions::where('id', '!=', 1)->get() as $position)
              <option value={{ $position->id }}>{{ $position->title }}</option>
            @endforeach
         </select>
      	</div>
        <div class="col-lg-2 col-sm-2">
          <label>Hourly</label>
          <input class="form-control" type="text" name="hourly_rate">
        </div>
        <div class="col-lg-2 col-sm-2">
          <label>Overtime</label>
          <input class="form-control" type="text" name="ot_rate">
        </div>
        <div class="col-lg-2 col-sm-2">
          <label>Nightshift</label>
          <input class="form-control" type="text" name="nightdiff_rate">
        </div>
      </div>
      <div class="hr-line-dashed"></div>
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

@foreach($company as $i)
    <template id="dep-option-{{ $i->id }}">
    @foreach($i->departments as $dep)
      <option value="{{ $dep->id }}">{{ $dep->name }}</option>
    @endforeach
    </template>
@endforeach