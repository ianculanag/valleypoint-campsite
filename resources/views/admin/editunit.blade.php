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
        @foreach ($units as $unit)       
        <form method="POST" action="/update-unit">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">     
            <input style="display:none" class="form-control" type="text" name="unitID" value="{{$unit->unitID}}">
            <div class="col-md-6 offset-md-3">
                <div class="card col-md-10 offset-md-1 py-4 ">
                    <div class="card-body">
                        <div class="pb-4 text-center">
                            <h3>Unit Details</h3>
                        </div>
                        <div class="form-group row">
                            <label for="unitType" class="col-md-4 col-form-label">Unit type</label>
                            <select class="custom-select d-block w-100 col-md-7 ml-3" id="unitType" name="unitType" required="required">
                                @if($unit->unitType == 'tent') 
                                <option value="tent" selected>Tent</option>
                                <option value="room">Room</option>
                                @else
                                <option value="tent">Tent</option>
                                <option value="room" selected>Room</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="unitNumber" class="col-sm-4 col-form-label">Unit number</label>
                            <input type="text" required="required" class="form-control col-sm-7 ml-3" name="unitNumber" placeholder="" value="{{$unit->unitNumber}}" minlength=3 maxlength=10>
                        </div>
                        <div class="form-group row pb-3">
                            <label for="capacity" class="col-sm-4 col-form-label">Capacity</label>
                            <input type="number" required="required" class="form-control col-sm-7 ml-3" name="capacity" placeholder="" value="{{$unit->capacity}}" min=1 max=20>
                        </div>
                        <button type="submit" class="btn btn-block btn-success mt-4" style="margin-right:3em;">Update</button>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
    </div>
@endsection