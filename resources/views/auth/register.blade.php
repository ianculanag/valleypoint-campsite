@extends('layouts.logapp')

@section('content')
<div class="container">
    <div class="py-5 text-center">
        <h2>Add Users</h2>
    </div>
    <div class="col-sm-4 offset-sm-4 text-center">
        <form method="POST" action="{{ route('register') }}" class="justify-content-center">
            @csrf
                {{--<div class="row">--}}
                    <div class="form-group"><!--col-md-6-->
                        <input id="name" placeholder="Name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{--<div class="form-group col-md-6">
                        <input id="name" placeholder="Name" type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>--}}

                <div class="form-group">
                    <input id="username" placeholder="Username" type="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('username') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>

                 <div class="form-group">
                    <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group">
                    <input id="contactNumber" placeholder="Contact Number" type="contactNumber" class="form-control{{ $errors->has('contactNumber') ? ' is-invalid' : '' }}" name="contactNumber" required>
                        @if ($errors->has('contactNumber'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('contactNumber') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group">
                    <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <select name="role" class="custom-select d-block w-100" required="required">
                        <option value="">Select Role:</option>
                        <option value="general">General Manager</option>
                        <option value="lodging">Lodging Manager</option>
                        <option value="cashier">Cashier</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
        </form>
    </div>
</div>
@endsection
