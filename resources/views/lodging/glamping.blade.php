@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="container-fluid col-md-9 mx-2">
            {{--<div class="col-md-12 text-center lodging-tabs">
                <nav class="nav nav-pills centered-pills">
                    <a class="nav-item nav-link active" style="background-color:#505050" href="/glamping">Physical View</a>
                    <a class="nav-item nav-link" style="color:#505050" href="/calendar">Calendar View</a>
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
            <h3 class="px-3 pt-2">Dashboard</h3>--}}
            <div class="container lodging-tabs">
                <ul class="nav nav-tabs pt-0" style="width:93%">
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
                        <div class="card mx-2" style="width:16rem; height:7.5em; background-image:url({{asset('tent.png')}}); background-size:cover; background-repeat:no-repeat;">
                            <div class="card-body">
                            <h5 class="card-title">
                                {{$unit->unitNumber}}
                                <span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>
                            </h5>
                            <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                            <p class="card-text" style="color:green; font-style:italic;"> {{$unit->serviceName}}</p>
                        @else
                            <a data-toggle="modal" data-target="#checkin-reserve" style="cursor:pointer; text-decoration:none !important;" class="load-glamping-available-unit" id={{$unit->unitID}}>       
                            <div class="card mx-2" style="width:16rem; height:7.5em; background-image:url({{asset('tent-empty.png')}}); background-size:cover; background-repeat:no-repeat;">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{$unit->unitNumber}}
                                        <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                                    </h5>
                            @php
                                $reservationCount = 0; 
                                $today = \Carbon\Carbon::today();
                                $currentDate = \Carbon\Carbon::parse($today)->format('Y-m-d');
                            @endphp
                            @foreach($reservations as $reservation)
                                @if($reservation->id == $unit->unitID)
                                    @php                                  
                                        $reservationCount++;
                                    @endphp
                                    @if(\Carbon\Carbon::parse($reservation->checkinDatetime)->format('Y-m-d') == $currentDate)
                                        @php
                                            $currentReservation = 0;
                                            $currentReservation++;
                                            $firstName = $reservation->firstName;
                                            $lastName = $reservation->lastName;
                                        @endphp
                                    @else
                                    @endif
                                @else
                                @endif
                            @endforeach
                            @if($reservationCount > 0)   
                                @if($currentReservation = 1)
                                    @if($reservationCount == 1)
                                        <p class="card-text" style="color:lightseagreen; font-style:italic;">{{$firstName}} {{$lastName}} checks-in today!</p>                     
                                    @elseif($reservationCount == 2)
                                        <p class="card-text" style="color:lightseagreen; font-style:italic;">{{$firstName}} {{$lastName}} checks-in today!</p>
                                        <p class="card-text" style="color:lightseagreen; font-style:italic;">1 other reservation</p>    
                                    @else
                                        <p class="card-text" style="color:lightseagreen; font-style:italic;">{{$firstName}} {{$lastName}} checks-in today!</p>
                                        <p class="card-text" style="color:lightseagreen; font-style:italic;">{{$reservationCount-1}} other reservations</p>                        
                                    @endif
                                @else          
                                    @if($reservationCount == 1)
                                        <p class="card-text" style="color:lightseagreen; font-style:italic;">1 reservation</p>                            
                                    @else
                                        <p class="card-text" style="color:lightseagreen; font-style:italic;">{{$reservationCount}} reservations</p>                            
                                    @endif
                                @endif
                            @else
                                        <p class="card-text" style="color:lightseagreen; font-style:italic;">No Reservations</p>
                            @endif
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
        </div>
        <div class="container-fluid col-md-3 m-0 p-0" id="unitFinder" style="padding-top:15em;">
            <div class="card p-0 mx-0" style="font-size:0.9em">
                <div class="card-body">
                    <h4 class="text-center py-2">Unit Finder</h4>
                    <form>
                        <div class="form-group row">
                            <label class="col-sm-3 mb-0 mt-2" for="checkin" style="padding-right:0;">Check-in</label>
                            <div class="input-group mb-1 col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control finderInputs" id="finderCheckinDate" type="date" name="checkin" maxlength="15" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 mb-0 mt-2" for="checkout" style="padding-right:0;">Check-out</label>
                            <div class="input-group mb-1 col-sm-9">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control finderInputs" type="date" id="finderCheckoutDate" name="checkout" maxlength="15" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 mb-0 mt-2" for="unitCount">Number of units</label>
                            <div class="input-group mb-1 col-sm-7">
                                <input class="form-control finderInputs" type="number" id="finderUnitCount" name="unitCount" maxlength="15" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="card p-0 mx-0" style="font-size:0.9em; min-height:34vh">
                            <div class="card-body" id="AvailableUnitsContainer" style="display:none;">
                                <h5 class="text-center">Available Units</h5>
                                <div class="availableUnitsList px-3" style="font-size:1.1em">
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="availableUnit1">
                                        <label class="custom-control-label" for="availableUnit1">Tent 1</label>
                                    </div>
                                    {{--<div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="availableUnit2">
                                        <label class="custom-control-label" for="availableUnit2">Tent 2</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="availableUnit3">
                                        <label class="custom-control-label" for="availableUnit3">Tent 3</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="availableUnit4">
                                        <label class="custom-control-label" for="availableUnit4">Tent 4</label>
                                    </div>--}}
                                </div>
                            </div>
                        </div>
                        <div class="pt-2">
                            <a href="" id="checkinSelectedTents">
                                <button type="button" class="btn btn-secondary" id="finderCheckin" style="width:9em; float:right;" disabled>Checkin</button>
                            </a> 
                            <a href="" id="reserveSelectedTents">
                                <button type="button" class="btn btn-primary" id="finderReserve" style="width:9em; float:left;" disabled>Add Reservation</button>
                            </a> 
                        </div>
                    <form>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div class="modal fade right" id="view-details" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <h4 id="modal-head1"><h4>
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
                    <a href="" id="reserve">
                        <button type="button" class="btn btn-success">Add Reservation</button>
                    </a>
                    <!--a href="" id="editDetails">
                        <button type="button" class="btn btn-info">View Details</button>
                    </a>
                    <a href="" id="checkout">
                        <button type="button" class="btn btn-danger">Check-out</button>
                    </a-->
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
                    <h4 id="modal-head2"><h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">×</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body" id="modal-body-empty">
                    <!--div class="col-md-12">
                        <h5 class="text-center mb-4">Choose action:</h5>
                    </div-->
                </div>
                <!--Footer-->
                <div class="modal-footer justify-content-right">
                    <a href="" id="checkinMain">
                        <button type="button" class="btn btn-primary">Check-in</button>
                    </a>
                    <a href="" id="reserveEmpty">
                        <button type="button" class="btn btn-secondary">Add reservation</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
@endsection
 