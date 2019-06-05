@extends('layouts.logapp')

@section('content')
<style>
    body {
        background-image: url('valleypoint.png');
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>
<div class="container col-md-5 col-sm-10 pt-5 mt-4">
    <div class="card mt-5" style="background-color: #ffffffb3;">
        <div class="mt-4 mb-3 text-center">
            <img src="{{asset('logo.png')}}" style="width: 12em;">
            {{-- <h2>Login to Valleypoint Campsite</h2> --}}
        </div>
        <form method="POST" action="{{ route('login') }}" style="">
            @csrf
            <div class="container px-5">
                <div class="form-group my-2">
                    <input id="username" type="text" placeholder="Username" maxlength="25" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username"  autocomplete = "off" value="{{ old('username') }}" required autofocus>
                    @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif   
                </div>
                <div class="form-group my-2">
                    <input id="password" type="password" placeholder="Password" maxlength="25" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete = "off" required>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block mt-4 mb-5">
                    {{ __('Login') }}
                </button>
                {{-- <a href="#forgotPass" class="forgetPass">
                    <p class="text-center pb-4">Forgot Password?</p>
                </a> --}}
            </div>
        </form>
   </div> 
</div>
@endsection