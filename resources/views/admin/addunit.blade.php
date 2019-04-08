@extends('layouts.app')

@section('content')
    <div class="container" style="position:fixed;">
        <div class="pt-3 pb-3 text-center">
            <a href="/view-units">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
        </div>        
        <form method="POST" action="/unit-added">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                   

            <div class="col-md-4 offset-md-4 text-center">
                <div class="pt-3 pb-4 text-center">
                    <h3>Add Unit</h3>
                </div>
                <div class="form-group">
                    <select class="custom-select d-block w-100" id="unitType" name="unitType" required="required">
                        <option value="tent">Tent</option>
                        <option value="room">Room</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" required="required" class="form-control" name="unitNumber" placeholder="Unit Number" minlength=5 maxlength=10>
                </div>
                <div class="form-group">
                    <input type="number" required="required" class="form-control" name="capacity" placeholder="Capacity" minlength=1 maxlength=20>
                </div>
                <button type="submit" class="btn btn-block btn-success mt-4">Submit</button>
            </div>
        </form>
    </div>
@endsection