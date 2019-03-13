@extends('layouts.master')

@section('title', 'Profile')

@section('content')
<div class="col-md-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>User Information</h5>
            </div>
            <div>
                <div class="ibox-content no-padding border-left-right">
                    <img alt="image" class="img-responsive" src="img/mars.jpg">
                </div>
                <div class="ibox-content profile-content">
                    <h4><strong>John Denver</strong></h4>
                    <p><i class="fa fa-map-marker"></i> Riviera State 32/106</p>
                    <h5>
                        About me
                    </h5>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitat.
                    </p>
                    <div class="row m-t-lg">
                        <div class="col-md-4">
                            <h5><strong>Birthday :</strong> 11-10-1994</h5>
                        </div>
                        <div class="col-md-4">
                            <h5><strong>Gender :</strong> Male</h5>
                        </div>
                        
                        <div class="col-md-4">
                            <h5><strong>Age :</strong> 24</h5>
                        </div>

                        <div class="col-md-4">
                                <h5><strong>Contact :</strong> 09000000001</h5>
                            </div>
                    </div>
                    <div class="user-button">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-cog"></i> Edit</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-comment"></i> Send a message </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
        </div>




@endsection