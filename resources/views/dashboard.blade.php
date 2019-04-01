@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
@php

  use Carbon\Carbon;

  $profile = App\Profile::where('user_id', auth()->user()->id)->first();
  $contact = App\Contact::where('user_id', auth()->user()->id)->first();

@endphp
  <div class='row'>
    <div class='col-lg-4 col-md-5 col-4 col-xs-12 col-sm-12'>
      <div class="ibox float-e-margins">
          <div class="ibox-title">
              <h5>User Information</h5>
          </div>
          <div>
              <div class="ibox-content no-padding border-left-right text-center">
                <img alt="image" class="img-responsive" src="{{ $profile->image }}" style='margin: auto'>
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
                        <h5><strong>Contact : </strong> {{ $contact->phone }} / {{ $contact->mobile }}</h5>
                        <h5><strong>Email :</strong> {{ $contact->email }}</h5>
                      </div>
                  </div>
                  <div class="user-button">
                      <div class="row">
                          <div class='col-md-6'></div>
                          <div class="col-md-6">
                              <a href="/editprofile" type="button" class="btn btn-success btn-sm btn-block"><i class="fa fa-cog"></i> Edit</a>
                          </div>
                      </div>
                  </div>
              </div>
        </div>
      </div>
    </div>
  </div>

@endsection