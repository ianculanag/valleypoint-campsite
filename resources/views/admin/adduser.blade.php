@extends('layouts.app')

@section('content')
    <div class="container" style="position:fixed;">
        <div class="pt-3 pb-3 text-center">
            <a href="/glamping">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
        </div>        
        <form method="POST" action="/addUser">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                   

            <div class="col-md-4 offset-md-4 text-center">
                <div class="pt-3 pb-4 text-center">
                    <h3>Add User</h3>
                </div>
                <div class="form-group">
                    <input type="text" required="required" class="form-control" id="inputName" placeholder="Name" max=20>
                </div>
                <div class="form-group">
                    <input type="text" required="required" class="form-control" id="inputUsername" placeholder="Username" max=15>
                </div>
                <div class="form-group">
                    <input type="password" required="required" class="form-control" id="inputPassword" placeholder="Password" min=6 max=25>
                </div>
                <div class="form-group">
                    <input type="password" required="required" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password" min=6 max=25>
                </div>
                <div class="form-group">
                    <input type="text" required="required" class="form-control" placeholder="Contact Number" max=11>
                </div>
                <div class="form-group">
                    <input type="email" required="required" class="form-control" id="inputEmail" placeholder="Email" min=10 max=25>
                </div>
                <div class="form-group">
                    <select class="custom-select d-block w-100" id="state" required="required">
                        <option value="">General Manager</option>
                        <option>Lodging Manager</option>
                        <option>Cashier</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-block btn-success mt-4">Submit</button>
            </div>
        </form>
    </div>
@endsection