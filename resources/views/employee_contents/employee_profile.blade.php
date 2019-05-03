@extends('layouts.master')

@php

  use Carbon\Carbon;

  $profile = App\Profile::where('user_id', $employee->user_id)->first();
  $profile->image = json_decode($profile->image, 1);
  
  $contact = App\Contact::where("user_id", $employee->user_id)->first();
@endphp

@section('title', App\Profile::getFullName($employee->user_id))

@section('content')
<div class="wrapper wrapper-content">
<div class='row'>
  <div class='col-lg-3 col-md-6 col-xs-12 col-sm-8'>
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>User Information</h5>
        </div>
        <div class="ibox-content no-padding border-left-right text-center">
          <img alt="image" class="img-responsive" 
                    src="{{ $profile->image['data'] }}" style='margin: auto; min-height: 350px; min-width: auto;'>
        </div>
        <div class="ibox-content profile-content">
            <h4><strong>{{ App\Profile::getFullName($employee->user_id) }}</strong></h4>
            <p><i class="fa fa-map-marker"></i> {{ $contact->address }}</p>
            <h5>
                About {{ ucwords($profile->fname) }}
            </h5>
            <p style='word-wrap: break-word;'>
                {{ ($profile->about ? $profile->about : 'Write something about yourself.') }}
            </p>
            <div class="row m-t-lg">
                <div class="col-md-12">
                  <h5><strong>Birthdate : </strong> {{ (new Carbon($profile->birthdate))->toFormattedDateString() }}</h5>
                  <h5><strong>Gender : </strong> {{ ($profile->gender? 'Male' : 'Female') }}</h5>
                  <h5><strong>Age : </strong> {{ ($profile->age? $profile->age : 'How old are you?') }}</h5>
                  <h5><strong>Mobile : </strong> {{ $contact->mobile }}</h5>
                  <h5><strong>Email : </strong> {{ $contact->email }}</h5>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
</div>  
@endsection