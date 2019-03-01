@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center lodging-tabs">
        <nav class="nav nav-pills centered-pills">
            <a class="nav-item nav-link active" style="background-color:#505050" href="#">Physical View</a>
            <a class="nav-item nav-link" style="color:#505050" href="#">Calendar View</a>
        </nav>
    </div>
    <div class="container lodging-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="/glamping">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:#505050;" href="/transient-backpacker">Transient Backpacker</a>
            </li>
        </ul>
    </div>
    
    @if(count($units) > 0)
    <div class="container" style="padding-top: 1em;">
        <div class="container">
            <div class="row">  

        @foreach($units as $unit)
            
            @if($unit->unitType == 'tent')          
            <div class="card" style="width:18rem;">
                <div class="card-body">

                @if($unit->status == 'occupied')
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>
                    </h5>
                    <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                    <p class="card-text" style="color:green; font-style:italic;"> {{$unit->numberOfPax}} out of {{$unit->capacity}} occupied</p>

                @elseif($unit->status == 'reserved')
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-secondary float-right" style="font-size:.55em;">Reserved</span>
                    </h5>
                    <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                    <p class="card-text" style="color:green; font-style:italic;"> {{$unit->numberOfPax}} out of {{$unit->capacity}} reserved</p>

                @else
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                    </h5>
                    <p class="card-text">Unit available</p>
                    <p></p>

                @endif
                <div class="text-right">
                    <!--a href="/units/{{--$unit->id--}}"-->
                    <button type="button" class="btn btn-info logding-details-btn load-details"
                    data-toggle="modal" data-target="#view-details" id={{$unit->unitID}}>View Details</button>
                    <!--/a-->
                </div>
            </div>
        </div>
            @endif
        @endforeach
        @else
            <div class="container" style="padding-top:1em; padding-left:2em;">
                <p>No units found</p>
            </div>
        @endif
            </div>
        </div>
    </div>
<!-- Details Modal -->
<div class="modal fade right" id="view-details" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <!--p class="heading lead">Tent 1</p-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body" id="modal-body">
            </div>
            <!--Footer-->
            <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-info">Edit</button>
                <button type="button" class="btn btn-danger">Check-out</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
@endsection
 