@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5 text-center">
        <h2>Add Users</h2>
    </div>
    <div class="col-sm-4 offset-sm-4 text-center">

    {{--div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">--}}
                    <form method="POST" action="{{ route('register') }}" class="form-inline justify-content-center">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                            {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">--}}
                                <input id="name" placeholder="Name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                                {{--<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    
                                <div class="col-md-6">--}}
                                    <input id="name" placeholder="Name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                <!--/div-->
                            </div>
                    </div>

                        <div class="form-group">
                            {{--<label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6"-->--}}
                                <input id="username" placeholder="Username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            <!--/div-->
                        </div>

                        <div class="form-group">
                            {{--<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">--}}
                                <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            <!--/div-->
                        </div>

                        <div class="form-group">
                            {{--<label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">--}}
                                <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                            <!--/div-->
                        </div>

                        <div class="form-group">
                            {{--<label for="contactNumber" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                            <div class="col-md-6">--}}
                                <input id="contactNumber" placeholder="Contact Number" type="contactNumber" class="form-control{{ $errors->has('contactNumber') ? ' is-invalid' : '' }}" name="contactNumber" required>

                                @if ($errors->has('contactNumber'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('contactNumber') }}</strong>
                                    </span>
                                @endif
                            <!--/div-->
                        </div>

                        <div class="form-group">
                            {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">--}}
                                <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            <!--/div-->
                        </div>

                        <div class="form-group">
                                {{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                                <div class="col-md-6">--}}
                            <select name="role" class="custom-select d-block w-100" required="required">
                                <option value="">Select Role:</option>
                                <option value="general">General Manager</option>
                                <option value="lodging">Lodging</option>
                                <option value="cashier">Cashier</option>
                            </select>
                        </div>
                        <!--/div--> 

                        <!--div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4"-->
                                <input type="submit" class="btn btn-primary" value="Submit">
                            <!--/div>
                        </div-->
                    </form>
                <!--/div>
            </div>
        </div-->

        {{--<form method="POST" action="{{ route('register') }}" class="form-inline justify-content-center">
            <div class="row">
                <div class="form-group col-md-6">
                    <!--input type="text" required="required" class="form-control" id="inputFirstname" placeholder="First name"-->
                    <input id="name" type="text" placeholder="First name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <input type="text" required="required" class="form-control" id="inputLastname" placeholder="Last name">
                </div>  
            </div> 
            <div class="form-group">
                <!--input type="text" required="required" class="form-control" id="inputUsername" placeholder="Username"-->
                <input id="username" type="text" placeholder="Username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <!--input type="password" required="required" class="form-control" id="inputPassword" placeholder="Password"-->
                <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" required="required" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password">
            </div>
            <div class="form-group">
            <!--input type="text" required="required" class="form-control" placeholder="Contact Number"-->
                <input id="contactNumber" type="text" placeholder="Contact Number" class="form-control{{ $errors->has('contactNumber') ? ' is-invalid' : '' }}" name="contactNumber" required>
                @if ($errors->has('contactNumber'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('contactNumber') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <!--input type="email" required="required" class="form-control" id="inputEmail" placeholder="Email"-->
                <input id="email" type="text" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <select name="role" class="custom-select d-block w-100" id="state" required="required">
                    <option value="">Select Role:</option>
                    <option>General Manager</option>
                    <option>Lodging</option>
                    <option>Cashier</option>
                </select>
            </div> 
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>--}}
    <!--/div-->
</div>
@endsection
