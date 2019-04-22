@extends('layouts.master')

@section('title', App\Profile::getFullName(auth()->user()->id))

@section('content')
@php

  use Carbon\Carbon;

  $profile = App\Profile::where('user_id', auth()->user()->id)->first();
  $contact = App\Contact::where('user_id', auth()->user()->id)->first();

  $profile->image = (array)json_decode($profile->image);

@endphp
<div class="wrapper wrapper-content">
<div class='row'>
  <div class='col-lg-4 col-md-5 col-4 col-xs-12 col-sm-12'>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>User Information</h5>
        </div>
        <div class="ibox-content no-padding border-left-right text-center">
          <img alt="image" class="img-responsive" 
                    src="{{ $profile->image['data'] }}" style='margin: auto'>
        </div>
        <div class="ibox-content profile-content">
            <h4><strong>{{ App\Profile::getFullName(auth()->user()->id) }}</strong></h4>
            <p><i class="fa fa-map-marker"></i> {{ $contact->address }}</p>
            <h5>
                About Me
            </h5>
            <p style='word-wrap: break-word;'>
                {{ ($profile->about ? $profile->about : 'Write something about yourself.') }}
            </p>
            <div class="row m-t-lg">
                <div class="col-md-12">
                  <h5><strong>Birthdate : </strong> {{ (new Carbon($profile->birthdate))->toFormattedDateString() }}</h5>
                  <h5><strong>Gender : </strong> {{ ($profile->gender? 'Male' : 'Female') }}</h5>
                  <h5><strong>Age : </strong> {{ ($profile->age? $profile->age : 'How old are you?') }}</h5>
                  <h5><strong>Contact : </strong> {{ $contact->phone }} / {{ $contact->mobile }}</h5>
                  <h5><strong>Email : </strong> {{ $contact->email }}</h5>
                  <br>
                  <div class="text-right">
                    <div class="btn-group">
                      <a href="/editprofile" class="btn btn-success btn-sm">
                        <i class="fa fa-cog"></i> Edit Profile
                      </a>
                      <button type="button" data-toggle="modal" data-target="#chpasswd" class="btn btn-success btn-sm">
                        <i class="fa fa-key"></i> Change Password
                      </button>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<div class="modal inmodal fade" id="chpasswd" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <div class="modal-header no-padding">
              <button type="button" style="padding:10px" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
             <h4 style="padding:10px">Change password</h4>
             
          </div>
          <form method="POST" action="/editprofile/chpasswd">
          {{ csrf_field() }}
          {{ method_field('PUT') }}
          <div class="modal-body">
             <div class="row">
                 <div class="col-lg-12">
                    <input type="password" class="form-control" name="current" placeholder="Current password" required/>
                    <br>
                    <input type="password" class="form-control" name="newpasswd" placeholder="New password" required/>
                    <br>
                    <input type="password" class="form-control" name="repasswd" placeholder="Retype password" required/>
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
</div>  
@endsection


@section('scripts')
<!-- Custom and plugin javascript -->
{!! Html::script('js/inspinia.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/sweetalert/sweetalert.min.js') !!}
{!! Html::script('js/plugins/pace/pace.min.js') !!}
{!! Html::script('js/plugins/footable/footable.all.min.js') !!} 
@endsection


  