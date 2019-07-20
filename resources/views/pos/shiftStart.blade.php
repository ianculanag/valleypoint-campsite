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
                <h3>{{Auth::user()->name}}</h3>
            {{-- <h2>Login to Valleypoint Campsite</h2> --}}
        </div>
        <form method="" action="/started-shift" style="">
            @csrf
        <div class="container px-5">
        <div class="form-group">
    <button  class="btn btn-primary" style="margin-left: 6em">Start Shift</button>
        </form>
        <form method="" action="/logout">
            <button  class="btn btn-secondary" style="margin-left: 5em; margin-top: 1em">Change Account</button> 
        </form>                                                          
                </div>
                <div class="form-group my-2">
                {{-- <a href="#forgotPass" class="forgetPass">
                    <p class="text-center pb-4">Forgot Password?</p>
                </a> --}}
            </div>
        
   </div> 
</div>
@endsection