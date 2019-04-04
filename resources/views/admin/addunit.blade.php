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
        <form method="POST" action="/addUnit">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                   

            <div class="col-md-4 offset-md-4 text-center">
                <div class="pt-3 pb-4 text-center">
                    <h3>Add Unit</h3>
                </div>
                <div class="form-group">
                    <select class="custom-select d-block w-100" id="state" required="required">
                        <option value="">Tent</option>
                        <option>Room</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" required="required" class="form-control" placeholder="Unit Number" min=1 max=10>
                </div>
                <div class="form-group">
                    <input type="number" required="required" class="form-control" placeholder="Capacity" min=1 max=10>
                </div>
                <button type="submit" class="btn btn-block btn-success mt-4">Submit</button>
            </div>
        </form>
    </div>
@endsection