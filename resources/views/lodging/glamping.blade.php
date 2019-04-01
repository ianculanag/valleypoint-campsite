@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center lodging-tabs">
        <nav class="nav nav-pills centered-pills">
            <a class="nav-item nav-link active" style="background-color:#505050" href="#">Physical View</a>
            <a class="nav-item nav-link" style="color:#505050" href="#">Calendar View</a>
        </nav>
    </div>
    <div class="container" style="position:absolute;">
        <form style="float:right; padding-right:3em;">
            <div class="form-group row mb-0">
                <label for="staticEmail" class="col-md-5 col-form-label" style="padding-left:0; padding-right:.5;">Sort by:</label>
                <div class="col-md-7 p-0" style="width:8em;;">
                    <select class="form-control" style="padding-left:1">
                        <option>Capacity</option>
                        <option>Status</option>
                        <option>Guest</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="container lodging-tabs">
        <ul class="nav nav-tabs w-100 pt-0">
            <li class="nav-item">
                <a class="nav-link active" href="/glamping/">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:#505050;" href="/transient-backpacker">Backpacker</a>
            </li>
        </ul>
    </div>
    
    @if(count($units) > 0)
    <div class="container" style="padding-top:1em;">
        <div class="container">
            <div class="row">  

        @foreach($units as $unit)
            
            @if($unit->unitType == 'tent')   

                @if($unit->status == 'ongoing')
                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-glamping-details" id={{$unit->unitID}}>       
                    <div class="card" style="width:18rem;height:7.5em;">
                        <div class="card-body">
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>
                    </h5>
                    <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                    <p class="card-text" style="color:green; font-style:italic;"> {{$unit->serviceName}}</p>

                {{--@elseif($unit->status == 'reserved')
                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-details" id={{$unit->unitID}}>       
                    <div class="card" style="width:18rem;height:7.5em;">
                        <div class="card-body">
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-secondary float-right" style="font-size:.55em;">Reserved</span>
                    </h5>
                    <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                    @php
                        $checkedIn = new DateTime($unit->checkinDatetime);
                        $checkedInAt = $checkedIn->format("F j, o");
                    @endphp
                    <p class="card-text" style="color:green; font-style:italic;"> Checks in on {{$checkedInAt}} </p>

                @else
                <a href="/checkin/{{$unit->id}}" style="cursor:pointer;text-decoration:none !important" class="load-details" id={{$unit->unitID}}>       
                    <div class="card" style="width:18rem;height:7.5em;">
                        <div class="card-body">
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                    </h5>
                    <p class="card-text" style="color:lightseagreen; font-style:italic;"> 0 out of {{$unit->capacity}} occupied</p>
                    <p></p>

                @endif--}}
                @else
                <a data-toggle="modal" data-target="#checkin-reserve" style="cursor:pointer; text-decoration:none !important" class="load-unit" id={{$unit->unitID}}>       
                    <div class="card" style="width:18rem;height:7.5em;">
                        <div class="card-body">
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                    </h5>
                    <p class="card-text" style="color:lightseagreen; font-style:italic;">No Reservations</p>
                    <p></p>
                @endif
                </div>
            </div>
            </a>
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
                    <a href="" id="editDetails">
                        <button type="button" class="btn btn-info">Edit</button>
                    </a>
                    <a href="" id="checkout">
                        <button type="button" class="btn btn-danger">Check-out</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Check-in or reserve modal -->
    <div class="modal fade right" id="checkin-reserve" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">×</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body" id="modal-body">
                    <div class="col-md-12">
                        <h5 class="text-center mb-4">Choose action:</h5>
                        <div style="width:80%; padding-left:20%;">
                            <a href="" id="checkin">
                                <button type="button" class="btn btn-primary btn-md btn-block mb-2">Check-in</button>
                            </a>
                            <a href="" id="reserve">
                                <button type="button" class="btn btn-secondary btn-md btn-block mb-2">Reserve</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer justify-content-right">
                </div>
            </div>
        </div>
    </div>
@endsection
 