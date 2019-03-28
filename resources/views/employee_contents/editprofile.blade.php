@extends("layouts/master")

@section("title", "Edit Profile")


@section("content")
@php

	use Carbon\Carbon;

@endphp
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Manage Attendance</h2>
    </div>
</div>
<br>
<div class="wrapper wrapper-content animated fadeInRight no-padding">
    <div class="wrapper wrapper-content animated fadeInRight no-padding">
        <div class="row">
        	<div class='col-lg-12'>
            <div class="no-padding">

            		<div class='row'>
            			<div class='col-lg-6'></div>
            			<div class='col-lg-5 hidden-xs hidden-sm hidden-md text-center'>
            				<h2>Preview</h2>
            			</div>
            		</div>
                <div class='row'>

                	<div class="col-lg-6">
                    <div class="ibox float-e-margins" style="border-radius: 5px">
                        <div class="ibox-title">
                            <h5></h5>
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal">
                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
															    <div class="form-control" data-trigger="fileinput">
															    		<span class="fileinput-new">Upload a Profile Picture</span>
															        <i class="glyphicon glyphicon-file fileinput-exists"></i>
															    <span class="fileinput-filename"></span>
															    </div>
															    <span class="input-group-addon btn btn-default btn-file">
															    		<input type="file" name="image"/>
															        <span class="fileinput-new">Upload</span>
															        <span class="fileinput-exists">Change</span>
															    </span>
															    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
															</div>

															<label>First name</label>
															<input class='form-control' name='fname' type='text' placeholder="First Name">

															<label>Last name</label>
															<input class='form-control' name='lname' type='text' placeholder="Last Name">

															<label>Middle name</label>
															<input class='form-control' name='mname' type='text' placeholder="Middle Name">
															<br>
															<br>
															<label>State/Province</label>
															<input class='form-control' name='state' type='text' placeholder="Middle Name">
															<label>City</label>
															<input class='form-control' name='city' type='text' placeholder="Middle Name">
															<label>Address</label>
															<input class='form-control' name='address' type='text' placeholder="Middle Name">
															<label>Phone</label>
															<input class='form-control' name='phone' type='text' placeholder="Middle Name">
															<label>Mobile</label>
															<input class='form-control' name='mobile' type='text' placeholder="Middle Name">
															<label>Email</label>
															<input class='form-control' name='email' type='email' placeholder="Middle Name">


															<br>
															<br>

															<label>About yourself?</label>
															<textarea class='form-control' name='about'></textarea>

                            </form>
                        </div>
                    </div>
                </div>
                	
                	{{-- Preview --}}
                	<div class='col-lg-5'>
                	<h2 class="text-center hidden-lg">Preview</h2>
  <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>User Information</h5>
      </div>
      <div>
          <div class="ibox-content no-padding border-left-right text-center">
            <img alt="image" class="img-responsive" style='margin: auto' src="{{ $profile->image }}">
          </div>
          <div class="ibox-content profile-content">
              <h4><strong>{{ App\Profile::getFullName(auth()->user()->id) }}</strong></h4>
              <p><i class="fa fa-map-marker"></i> {{ $contact->address }}</p>
              <h5>
                  About Me
              </h5>
              <p>
                  {{ ($profile->about ? $profile->about : 'Write something about yourself.') }}
              </p>
              <div class="row m-t-lg">
                  <div class="col-md-12">
                    <h5><strong>Birthdate : </strong>{{ (new Carbon($profile->birthdate))->toFormattedDateString() }}</h5>
                    <h5><strong>Gender : </strong>{{ ($profile->gender? 'Male' : 'Female') }}</h5>
                    <h5><strong>Age : </strong> {{ ($profile->age? $profile->age : 'How old are you?') }}</h5>
                    <h5><strong>Contact :</strong> {{ $contact->phone }} / {{ $contact->mobile }}</h5>
                    <h5><strong>Email :</strong> {{ $contact->email }}</h5>
                  </div>
              </div>
          </div>
    </div>
</div>
               	</div>

                </div>

            </div>
        </div>
    </div>
	</div>
</div>

@endsection