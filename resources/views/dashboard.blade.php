@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@php

  $profile = App\Profile::where('user_id', auth()->user()->id)->first();
  $contact = App\Contact::where('user_id', auth()->user()->id)->first();

@endphp
<div class='col-md-4 col-lg-4 col-sm-4'>
  <div class="ibox float-e-margins">
      <div class="ibox-title">
          <h5>User Information</h5>
      </div>
      <div>
          <div class="ibox-content no-padding border-left-right">
            @if ($profile->image != '')
              <img alt="image" class="img-responsive" src="{{ $profile->image }}">
            @else
              <img class='img-responsive' src='/img/landing/avatar_anonymous.png'>
            @endif
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
                  <div class="col-md-4">
                      <h5><strong>Birthday : </strong>{{ $profile->birthdate }}</h5>
                  </div>
                  <div class="col-md-4">
                      <h5><strong>Gender : </strong>{{ ($profile->gender?'Male' : 'Female') }}</h5>
                  </div>
                  
                  <div class="col-md-4">
                      <h5><strong>Age : </strong> {{ ($profile->age? $profile->age : 'How old are you?') }}</h5>
                  </div>

                  <div class="col-md-4">
                          <h5><strong>Contact :</strong> {{ $contact->phone }}</h5>
                      </div>
              </div>
              <div class="user-button">
                  <div class="row">
                      <div class="col-md-6">
                          <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-cog"></i> Edit</button>
                      </div>
                      <div class="col-md-6">
                          <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-comment"></i> Send a message</button>
                      </div>
                  </div>
              </div>
          </div>
    </div>
  </div>
</div>

@endsection