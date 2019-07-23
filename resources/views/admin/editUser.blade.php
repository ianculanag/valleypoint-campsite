@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <div class="pt-3 pb-3 text-center">
            <a href="{{ URL::previous() }}">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
        </div> 
        @foreach ($userInfo as $user)       
        <form method="POST" action="/update-user">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">     
            <input style="display:none" class="form-control" type="text" name="userID" value="{{$user->id}}">
            <div class="col-md-6 offset-md-3">
                <div class="card col-md-10 offset-md-1 py-4 ">
                    <div class="card-body">
                        <div class="pb-4 text-center">
                            <h3>User Details</h3>
                        </div>
                        <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label">Name</label>
                        <input type="text" required="required" class="form-control col-sm-7 ml-3" name="newName" placeholder="{{$user->name}}" value="" minlength=3 maxlength=10>
                        </div>
                        <div class="form-group row">
                                <label for="contactNumber" class="col-md-5 col-form-label">Contact Number</label>
                                <input type="number" required="required" class="form-control col-sm-5 ml-3" name="newContactNumber" placeholder="{{$user->contactNumber}}" value="" minlength=11 maxlength=11>
                                </div>
                        <div class="form-group row">
                        <label for="username" class="col-sm-4 col-form-label">Username</label>
                        <input type="text" required="required" class="form-control col-sm-7 ml-3" name="newUserName" placeholder="{{$user->username}}" value="" minlength=3 maxlength=10>
                        </div>
                        <div class="form-group row">
                                <label for="email" class="col-sm-4 col-form-label">email</label>
                                <input type="text" required="required" class="form-control col-sm-7 ml-3" name="newEmail" placeholder="{{$user->email}}" value="" minlength="" maxlength="">
                        </div>
                        <div class="form-group row">
                        <label for="role" class="col-sm-4 col-form-label">role</label>
                        <div class="form-group pb-3">
                        <select class="custom-select d-block w-100" id="state" required="required" name="newRole" placeholder="{{$user->role}}">
                                    <option value="general">General Manager</option>
                                    <option value="lodging">Lodging Manager</option>
                                    <option value="cashier">Cashier</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div class="form-group row pb-3">
                            <label for="capacity" class="col-sm-4 col-form-label">Capacity</label>
                            <input type="number" required="required" class="form-control col-sm-7 ml-3" name="capacity" placeholder="" value="" min=1 max=20>
                        </div> --}}
                        <button type="submit" class="btn btn-block btn-success mt-4" style="margin-right:3em;">Update</button>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
    </div>
@endsection