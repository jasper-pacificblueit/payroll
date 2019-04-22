@extends("layouts/master")

@section("title", "Edit Profile")


@section("content")
@php

	use Carbon\Carbon;

	$profile->image = (array)json_decode($profile->image);

@endphp
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Edit Profile</h2>
        <ol class="breadcrumb">
		        <li class="active">
		            <a href="/">Dashboard</a>
		        </li>
		        <li>
		            <a href="#"><strong>Edit Profile</strong></a>
		        </li>
		    </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight no-padding">
    <div class="wrapper wrapper-content animated fadeInRight no-padding">
        <div class="row">
        	<div class='col-lg-12'>
            <div class="no-padding">
            		<div class='row'>
            			<div class='col-lg-6'></div>
            			<div class='col-lg-5 col-xl-5 col-md-5 hidden-xs hidden-sm hidden-md text-center'>
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
                            <form method="post" class="form-horizontal" id='profile-form' action="/editprofile" enctype="multipart/form-data">
                            	{{ csrf_field() }}
                                <div class="fileinput fileinput-exists input-group" data-provides="fileinput">
									    <div class="form-control" data-trigger="fileinput">
									    		<span class="fileinput-new">Upload a Profile Picture</span>
									        <i class="glyphicon glyphicon-file fileinput-exists"></i>
									    <span class="fileinput-filename">{{ basename($profile->image['path']) }}</span>
									    </div>
									    <span class="input-group-addon btn btn-default btn-file">
									    		<input type="file" accept="image/*" name="image" onchange="image_ch()"/>
									        <span class="fileinput-new">Upload</span>
									        <span class="fileinput-exists">Change</span>
									    </span>
									</div>

									<label>Age</label>
									<input class='form-control' name='age' type='text' onchange="(function(e) {
										document.getElementById('age').innerHTML = '<strong>Age : </strong>' + 
										(e.value != '' ? e.value : 'How old are you?');
									})(this)" placeholder="Age" value="{{ $profile->age }}" required>
									<br>
									<br>
									<label>Address</label>
									<input class='form-control' name='address' type='text' placeholder="Address" onchange="(function(e) {


										if (e.value == '')
											document.getElementById('_address').innerHTML = 'Where do you live?';
										else
											document.getElementById('_address').innerHTML = e.value;



									})(this)" value="{{ $contact->address }}">
									<label>Phone</label>
									<input class='form-control' name='phone' type='text' placeholder="Phone" onchange="(function(e) {

										document.getElementById('phoneNumber').innerHTML = e.value;


									})(this)"  value="{{ $contact->phone }}" required>
									<label>Mobile</label>
									<input class='form-control' name='mobile' type='text' placeholder="Mobile" onchange="(function(e) {

										document.getElementById('mobileNumber').innerHTML = e.value;

									})(this)" value="{{ $contact->mobile }}" required>
									<label>Email</label>
									<input class='form-control' name='email' type='email' placeholder="Email" onchange="(function(e) {

										if (e.value == '')
											document.getElementById('emailAddress').innerHTML = 'What is your email?';
										else
											document.getElementById('emailAddress').innerHTML = e.value;


									})(this)" value="{{ $contact->email }}" required>
									<br>
									<br>

									<label>About</label>
									<textarea class='form-control' id='aboutEmployee' name='about' onchange="(function(e) {

											if (e.value == '')
												document.getElementById('aboutMe').innerHTML = 'Write something about yourself.';
											else
												document.getElementById('aboutMe').innerHTML = e.value;

									})(this)">{{ $profile->about }}</textarea>
									<br>
									<div class='text-right'>
										<div class='btn-group'>
											<a class='btn btn-success' href='{{ route('profile') }}'>Discard</a>
											<input class='btn btn-success' type='submit' value='Save'>
										</div>
									</div>

                            </form>
                        </div>	
                    </div>
                </div>
                	
                	{{-- Preview --}}
                	<div class='col-lg-5 col-xl-5'>
                	<h2 class="text-center hidden-lg">Preview</h2>
  <div class="ibox float-e-margins">
	    <div class="ibox-title">
	        <h5>User Information</h5>
	    </div>
	    <div>
	        <div class="ibox-content no-padding border-left-right text-center">
	          <img alt="image" class="img-responsive" id="user-image" style='margin: auto; min-height: 400px' src="{{ $profile->image['data'] }}">
	        </div>
	        <div class="ibox-content profile-content">
	            <h4 id='fullName'><strong>
	            	
	            	<span id='firstName'>{{ $profile->fname }}</span> 
	            	<span id='middleName'>{{ $profile->mname }}</span> 
	            	<span id='lastName'>{{ $profile->lname }}</span>

	            </strong></h4>
	            <p><i class="fa fa-map-marker"></i> 
	            	<span id='_address'>{{ $contact->address }}</span>
	            </p>
	            <h5>
	                About Me
	            </h5>
	            <p style='word-wrap: break-word;'>
	                <span id='aboutMe'>{{ ($profile->about ? $profile->about : 'Write something about yourself.') }}</span>
	            </p>
	            <div class="row m-t-lg">
	                <div class="col-md-12">
	                  <h5><strong>Birthdate : </strong>{{ (new Carbon($profile->birthdate))->toFormattedDateString() }}</h5>
	                  <h5><strong>Gender : </strong>{{ ($profile->gender? 'Male' : 'Female') }}</h5>
	                  <h5 id='age'><strong>Age : </strong>{{ ($profile->age? $profile->age : 'How old are you?') }}</h5>
	                  <h5><strong>Contact :</strong> <span id='phoneNumber'>{{ $contact->phone }}</span> / <span 	id='mobileNumber'>{{ $contact->mobile }}</span></h5>
	                  <h5><strong>Email :</strong> <span id='emailAddress'>{{ $contact->email }}</span></h5>
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

<script>
	
	function image_ch() {


		var rdr = new FileReader();

		rdr.addEventListener('load', async function(e) {
			var out = document.getElementById('user-image');
			out.src = e.target.result;
		}); 

		if (document.getElementsByName('image')[0].files) {
			rdr.readAsDataURL(document.getElementsByName('image')[0].files[0]);
		} else
			document.getElementById('user-image').src = "/img/landing/avatar_anonymous.png";

	}

</script>

@endsection