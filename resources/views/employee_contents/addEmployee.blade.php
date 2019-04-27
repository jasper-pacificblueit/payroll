
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
          <div class="col-lg-6">
             <label>First name</label>
             <input type="text" name="firstName" class="form-control p-2">

             <label>Last name</label>
             <input type="text" name="lastName" class="form-control p-2">

             <label>Middle name</label>
             <input type="text" name="middleName" class="form-control p-2">

             <label>E-mail</label>
             <input type="email" name="email" class="form-control p-2">

             <label>Mobile number</label>
             <input type="text" name="mobile" class="form-control p-2">

          </div>

          <div class="col-lg-6">
              <label>Gender</label>
              <select class='form-control' name='gender'>
                <option value='1'>Male</option>
                <option value='0'>Female</option>
              </select>
              <label>Birthdate</label>
              <input type="date" name="birthdate" class="form-control">

              <label>Address</label>
              <input type="text" name="address" class="form-control">

              
          </div>
      </div>
      <div class="hr-line-dashed"></div>
      <div class="row">
      	<div class="col-lg-12">
      		<h2>User Account & Permissions</h2>
      	</div>
      	<div class="col-lg-6">
              

              <label>Employee username</label>
              <input type="text" name="user" class="form-control">

        </div>
        <div class="col-lg-6">

              <label>Employee password</label>
              <input type="password" name="pass" class="form-control">

        </div>

      </div>
      <div class="hr-line-dashed"></div>
      <div class="row">
      	<div class="col-lg-12">
      		<h2>Workplace</h2>
      	</div>
      	<div class="col-lg-6">
              
      		<label>Company</label>
          <select class="form-control" name="company" onchange="chdep()">
            @foreach($company as $i)
              <option value="{{ $i->id }}">{{ $i->name }}</option>
            @endforeach
          </select>

        </div>
        <div class="col-lg-6">
        	<label>Department</label>
          <select class="form-control company-dep" name="department">
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
      	<div class="col-lg-6">
      	 <label>Position</label>
         <select class='form-control' name='position'>
            @if (auth()->user()->position == 'hr')
              <option value='employee'>Employee</option>
            @elseif (auth()->user()->position == 'admin')
              <option value='hr'>HR</option>
              <option value='employee'>Employee</option>
            @endif
         </select>
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