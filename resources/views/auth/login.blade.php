@extends('layouts.logapp')

@section('content')
        <div class="container">
            <div class="py-5 text-center">
                    <img src="{{asset('logo.jpg')}}" style="width: 12em;">
                    <h2>Login to Valleypoint Campsite</h2>
            </div>
        </div>
        <div class="container center-block">
            <form method="POST" action="{{ route('login') }}" style="display: flex; flex-direction: column; align-items: center;">
            @csrf

                <div class="mb-3 col-md-4">
                    <div class="form-group">
                <input id="username" type="text" placeholder="Username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
                @if ($errors->has('username'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('username') }}</strong>
                </span>
            @endif   
            </div>

                    <div class="form-group">
                            <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required><br>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="lower-card" style="display: flex; flex-direction: column; align-items: center;">
                     <div class="form-group">
                          <a href="#forgotPass" class="forgetPass"><p>Forgot Password?</p>
                      </a></div>

                      <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                    </div>
                </div>
                    </div>
                </div>
            </form>
        </div>  
    </div>
</div>
@endsection