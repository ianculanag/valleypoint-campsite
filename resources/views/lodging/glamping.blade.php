@extends('layouts.app')

@section('content')
<div class="col-md-12 text-center lodging-tabs mx-1">
    <nav class="nav nav-pills centered-pills">
        <a class="nav-item nav-link active" style="background-color:#060f0ed4;" href="/glamping">Physical View</a>
        <a class="nav-item nav-link" style="color:#505050" href="/calendar-glamping">Calendar View</a>
    </nav>
</div>
<div class="container-fluid col-md-9 mx-1 pb-5 pt-1">
    <div class="row">
            {{--<div class="container" style="position:absolute;">
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
                        <a class="nav-link" style="color:#505050;" href="/backpacker">Backpacker</a>
                    </li>
                </ul>
            </div>
            @if(count($units) > 0)
            <div class="container" style="padding-top:1em;">
                <div class="container scrollbar-near-moon pb-4" style="position:fixed; max-height:68.5vh; max-width:55%; overflow-y:auto;">
                    <div class="row">  

                @php                    
                    $unitArray = array(); 
                    array_push($unitArray, 0);   
                @endphp

                @foreach($units as $unit)
                    @if($unit->unitType == 'tent')   
                        @if($unit->status == 'ongoing')
                        <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-glamping-details" id={{$unit->unitID}}>       
                        <div class="card mx-2" style="width:16rem; height:7.5em; background-image:url({{asset('tent.png')}}); background-size:cover; background-repeat:no-repeat;">
                            <div class="card-body">
                            <h5 class="card-title">
                                {{$unit->unitNumber}}
                                @php
                                    $withPendingCharges = false;
                                @endphp
                                @foreach ($charges as $charge)
                                    @if($charge->accommodationID == $unit->accommodationID)
                                        @if($charge->balance > 0)
                                            @php
                                                $withPendingCharges = true;
                                            @endphp 
                                        @endif
                                    @endif
                                @endforeach
                                @if($withPendingCharges == true)
                                <span class="badge badge-info float-right" style="font-size:.55em; width:5em;">Pending</span>   
                                @else
                                <span class="badge badge-success float-right" style="font-size:.55em; width:5em;">Paid</span>  
                                @endif
                            </h5>

                            @php
                                $today = \Carbon\Carbon::today();
                                $currentDate = \Carbon\Carbon::parse($today)->format('Y-m-d');
                            @endphp

                            @if((\Carbon\Carbon::parse($unit->checkoutDatetime)->format('Y-m-d') == $currentDate))
                                <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                                <p class="card-text" style="color:#fdc000; font-style:italic;">Checks-out today!</p>
                            @elseif((\Carbon\Carbon::parse($unit->checkoutDatetime)->format('Y-m-d') < $currentDate))
                                <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                                <p class="card-text" style="color:red; font-style:italic;">Overdue!</p>
                            @else
                                <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                                <p class="card-text" style="color:green; font-style:italic;"> {{$unit->serviceName}}</p>
                            @endif

                        @else
                            <a data-toggle="modal" data-target="#checkin-reserve" style="cursor:pointer; text-decoration:none !important;" class="load-glamping-available-unit" id={{$unit->unitID}}>       
                            <div class="card mx-2" style="width:16rem; height:7.5em; background-image:url({{asset('tent-empty.png')}}); background-size:cover; background-repeat:no-repeat;">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{$unit->unitNumber}}
                                        {{--<span class="badge badge-success float-right" style="font-size:.55em;">Available</span>--}}
                                    </h5>
                            @php
                                $reservationCount = 0; 
                                $today = \Carbon\Carbon::today();
                                $currentDate = \Carbon\Carbon::parse($today)->format('Y-m-d');
                            @endphp

                            @if(count($reservations) > 0) 
                                @foreach($reservations as $reservation)
                                    @if(($reservation->id == $unit->unitID) && (\Carbon\Carbon::parse($reservation->checkinDatetime)->format('Y-m-d') == $currentDate))
                                        @if(array_search($unit->unitID, $unitArray) == false)
                                        <p class="card-text">{{$reservation->firstName}} {{$reservation->lastName}}</p>
                                        <p class="card-text" style="color:lightseagreen; font-style:italic;">Checks-in today!</p>
                                        @php
                                            array_push($unitArray, $unit->unitID);
                                        @endphp
                                        @endif
                                    @elseif($reservation->id == $unit->unitID)
                                        @if(array_search($unit->unitID, $unitArray) == false)
                                            @if(\Carbon\Carbon::parse($reservation->checkinDatetime)->format('Y-m-d') < $currentDate)
                                            <p class="card-text">{{$reservation->firstName}} {{$reservation->lastName}}</p>
                                            <p class="card-text" style="color:red; font-style:italic;">
                                                Update reservation!
                                                {{--\Carbon\Carbon::parse($reservation->checkinDatetime)->format('F j, Y')--}}
                                            </p>
                                            @else
                                            <p class="card-text" style="color:lightseagreen; font-style:italic;">
                                                Next checkin:<br>
                                                {{\Carbon\Carbon::parse($reservation->checkinDatetime)->format('F j, Y')}}
                                            </p>
                                            @endif
                                        @php
                                            array_push($unitArray, $unit->unitID);
                                        @endphp
                                        @endif
                                    @endif
                                @endforeach
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
        <div class="container-fluid col-md-3 m-0 p-0" id="unitFinder" style="padding-top:25em;">
            <div class="card p-0 mx-0" style="font-size:0.9em; {{--background-color:#e1fdec66;--}}">
                <div class="card-body">
                    <h4 class="text-center pb-1">Tent Finder</h4>
                    <form method="POST">
                        @csrf
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                            <label class="col-sm-4 mb-0 mt-2" for="checkin" style="padding-right:0;">Check-in date</label>
                            <div class="input-group input-group-sm mb-1 col-sm-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control finderInputs" id="finderCheckinDate" type="date" name="checkin" maxlength="15" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 mb-0 mt-2" for="checkout" style="padding-right:0;">Check-out date</label>
                            <div class="input-group input-group-sm mb-1 col-sm-8">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control finderInputs" type="date" id="finderCheckoutDate" name="checkout" maxlength="15" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label class="col-sm-4 mb-0 mt-2" for="unitCount">No. of tents</label>
                            <div class="input-group input-group-sm mb-1 col-sm-8">
                                <input class="form-control finderInputs" type="number" id="finderUnitCount" name="unitCount" maxlength="15" placeholder="" value="" required>
                            </div>
                        </div>
                        <hr class="my-3">
                        <h6 class="text-center mb-1">Available Tents</h6>
                        <div class="card p-0 mx-0 scrollbar-near-moon" style="font-size:0.9em; min-height:33vh; max-height:20vh; overflow-y:auto;">
                            <div class="card-body pb-0" id="availableUnitsContainer" style="display:block;">
                                <div class="available-units-list" id="divAvailableUnitsList" style="font-size:1.1em">
                                    {{--<div class="custom-control custom-checkbox mb-1">
                                        <input type="checkbox" class="custom-control-input" id="availableUnit1">
                                        <label class="custom-control-label" for="availableUnit1">Tent 1</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-1">
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
                        <input type="hidden" id="checkedUnits" name="checkedUnits" value="hello">
                        {{--<div class="card p-0 mx-0 scrollbar-near-moon" style="font-size:0.9em; min-height:20vh; max-height:20vh; overflow-y:auto; overflow-x:auto;">
                            <div class="card-body p-0" id="unavailableUnitsContainer" style="display:block;">
                                <div class="unavailable-units-list" id="divUnavailableUnitsList" style="font-size:1.1em">
                                    <table class="table table-bordered table-sm nowrap m-0" style="border-collapse:collapse;">
                                        <thead id="calendarHead">
                                        </thead>
                                        <tbody id="calendarBody">
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>--}}
                        <div class="row pt-2">
                            <div class="col-md-6">
                                <button type="submit" formaction="reserve-glamping-finder" class="btn btn-block btn-primary" id="finderReserve" style="float:left;" disabled>Add Reservation</button>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" formaction="checkin-glamping-finder" class="btn btn-block btn-secondary" id="finderCheckin" style="float:right;" disabled>Checkin</button>
                            </div>
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
                <div class="modal-body scrollbar-near-moon-wide" id="modal-body">
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
                <div class="modal-body scrollbar-near-moon-wide" id="modal-body-empty">
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
 