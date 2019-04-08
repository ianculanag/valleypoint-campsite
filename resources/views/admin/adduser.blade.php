@extends('layouts.app')

@section('content')
    <div class="container" style="position:fixed;">
        <div class="pt-3 pb-3 text-center">
            <a href="/view-users">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
        </div>        
        <form method="POST" action="/register">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                   

            <div class="col-md-4 offset-md-4 text-center">
                <div class="pt-3 pb-4 text-center">
                    <h3>Add User</h3>
                </div>
                <div class="form-group">
                    <input type="text" required="required" class="form-control" name="name" placeholder="Name" maxlength=25>
                </div>
                <div class="form-group">
                    <input type="text" required="required" class="form-control" name="username" placeholder="Username" maxlength=15>
                </div>
                <div class="form-group">
                    <input type="password" required="required" class="form-control" name="password" placeholder="Password" minlength=6 maxlength=25>
                </div>
                <div class="form-group">
                    <input type="password" required="required" class="form-control" name="confirmPassword" placeholder="Confirm Password" minlength=6 maxlength=25>
                </div>
                <div class="form-group">
                    <input type="text" required="required" name="contactNumber" class="form-control" placeholder="Contact Number" minlength=11 maxlength=11>
                </div>
                <div class="form-group">
                    <input type="email" required="required" class="form-control" name="inputEmail" placeholder="Email" minlength=10 maxlength=25>
                </div>
                <div class="form-group">
                    <select class="custom-select d-block w-100" id="state" required="required" name="role">
                        <option value="general">General Manager</option>
                        <option value="lodging">Lodging Manager</option>
                        <option value="cashier">Cashier</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-block btn-success mt-4">Submit</button>
            </div>
        </form>
    </div>
@endsection