@extends('layouts.head')

@section('title', env("APP_NAME") . ' | Login')

@section('content')
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div class='ibox-content' style='border-radius: 3px'>
            <div>

    <div class="dropdown profile-element"> <span>
            <img alt="image" class="img-box" src="/img/pacific.jpg" style="width: 100%;" /> 
                        
            </div>
            <h2 align="center"><b style="font-size: 18px; color: white;">Welcome to PBIT Payroll</b></h2>
            <p>Please Log-In</p>
            <form class="m-t" role="form"  method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('user') ? ' has-error' : '' }}">
                    <input id="user"  type="text" class="form-control" placeholder="Username" name="user" value="{{ old('user') }}" required autofocus>
                    @if ($errors->has('user'))
                        <span class="help-block">
                            <strong>{{ $errors->first('user') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-success block full-width m-b">Login</button>

                {{--<a href="{{ route('password.request') }}"><small>Forgot password?</small></a>--}}
                {{--<p class="text-muted text-center"><small>Do not have an account?</small></p>--}}
                {{--<a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create an account</a>--}}
            </form>
            <p class="m-t"> <a href="#"><small>Powered by <strong>Pacific Blue IT</strong> &copy; {{Date("Y")}}</small></a> </p>
            
        </div>
    </div>
@endsection
