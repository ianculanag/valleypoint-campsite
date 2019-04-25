@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center lodging-tabs mx-1">
        <nav class="nav nav-pills centered-pills">
            <a class="nav-item nav-link active" style="background-color:#060f0ed4;" href="/glamping">Physical View</a>
            <a class="nav-item nav-link" style="color:#505050" href="/calendar-backpacker">Calendar View</a>
        </nav>
    </div>
    <div class="container-fluid col-md-9 mx-1 pb-5 pt-1">
        <div class="row">
            <div class="container lodging-tabs">
                <ul class="nav nav-tabs pt-0" style="width:93%">
                    <li class="nav-item">
                        <a class="nav-link" style="color:#505050;" href="/glamping/">Glamping</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/transient-backpacker">Backpacker</a>
                    </li>
                </ul>
            </div>
    
            @if(count($rooms) > 0)
            <div class="container" style="padding-top:1em;">
                <div class="container scrollbar-near-moon pb-4" style="position:fixed; max-height:68.5vh; max-width:55%; overflow-y:auto;">
                @if(count($capacityArray) > 0) 
                @foreach($capacityArray as $capacity)
                <h5 class="unit-heading mb-0">{{$capacity}} pax</h5> 
                    <div class="row"> 
                        @foreach($rooms as $room)
                        @if($room->capacity == $capacity)
                        @if(count($roomAccommodations[$loop->index]) > 0) 
                        @php
                            $nameString = '';
                            $occupiedBeds = 0;
                            $notificationCount = 0;
                            for($index = 0; $index < count($roomAccommodations[$loop->index]); $index++) {
                                $occupiedBeds += $roomAccommodations[$loop->index][$index]->numberOfPax;
                            }

                            for($count = 0; $count < count($roomGuestNames[$loop->index]); $count++) {
                                if(count($roomGuestNames[$loop->index]) == 1) {                                    
                                    $nameString .= $roomGuestNames[$loop->index][$count]->firstName.' '.$roomGuestNames[$loop->index][$count]->lastName;
                                } else {
                                    if($count == count($roomGuestNames[$loop->index])-1) {
                                        $nameString .= $roomGuestNames[$loop->index][$count]->lastName;
                                    } else {                                    
                                        $nameString .= $roomGuestNames[$loop->index][$count]->lastName.', ';
                                    }
                                }                                
                            }

                            for($counter = 0; $counter < count($roomCheckoutDates[$loop->index]); $counter++) {
                                if(\Carbon\Carbon::parse($roomCheckoutDates[$loop->index][$counter]->checkoutDatetime)->format('Y-m-d') <= \Carbon\Carbon::now()->format('Y-m-d')) {
                                    $notificationCount++;
                                }
                            }

                            $reservationCount = 0;

                            //$earliestCheckin = \Carbon\Carbon::parse($roomCheckinDates[$loop->index][0]->checkinDatetime)->format('Y-m-d');

                            for($indexer = 0; $indexer < count($roomCheckinDates[$loop->index]); $indexer++) {
                                if(\Carbon\Carbon::parse($roomCheckinDates[$loop->index][$indexer]->checkinDatetime)->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d')) {
                                    $reservationCount++;
                                }
                            }

                            //echo $reservationCount;

                            //echo $occupiedBeds;
                        @endphp
                        <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-backpacker-details" id={{$room->id}}>
                            <div class="card mx-2" style="width:16rem; height:7.5em;  background-image:url({{asset('room.png')}}); background-size:cover; background-repeat:no-repeat;">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{$room->unitNumber}} 
                                        @if($notificationCount > 0)
                                        <span class="badge badge-danger float-right ml-1" ><i class="fa fa-bell"></i>  {{$notificationCount}}</span>

                                        @endif
                                        @if($reservationCount > 0)
                                        <span class="badge badge-info float-right"><i class="fa fa-bell"></i>  {{$reservationCount}}</span>
                                        
                                        @endif
                                        {{--<span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>--}}
                                    </h5>

                                    <p class="card-text" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">{{$nameString}}</p>
                                    <p class="card-text" style="color:green; font-style:italic;">{{$occupiedBeds}} out of {{$room->capacity}} occupied</p>
                                </div>
                            </div>
                        </a>
                        @elseif(count($roomReservations[$loop->index]) > 0)
                        @php
                            $nameString = '';
                            //$reservedBeds = 0;
                            $notificationCount = 0;
                            /*for($index = 0; $index < count($roomReservations[$loop->index]); $index++) {
                                $occupiedBeds += $roomReservations[$loop->index][$index]->numberOfPax;
                            }

                            for($count = 0; $count < count($roomGuestNames[$loop->index]); $count++) {
                                if($count == count($roomGuestNames[$loop->index])-1) {
                                    $nameString .= $roomGuestNames[$loop->index][$count]->lastName;
                                } else {                                    
                                    $nameString .= $roomGuestNames[$loop->index][$count]->lastName.', ';
                                }
                            }*/

                            $withCheckinToday = false;
                            
                            $needsAttentionCount = 0;

                            $earliestCheckin = \Carbon\Carbon::parse($roomCheckinDates[$loop->index][0]->checkinDatetime)->format('Y-m-d');
                            $earliestCheckout = \Carbon\Carbon::parse($roomCheckinDates[$loop->index][0]->checkoutDatetime)->format('Y-m-d');

                            for($counter = 0; $counter < count($roomCheckinDates[$loop->index]); $counter++) {
                                if(\Carbon\Carbon::parse($roomCheckinDates[$loop->index][$counter]->checkinDatetime)->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d')) {
                                    $notificationCount++;
                                }
                            }

                            if($earliestCheckin == \Carbon\Carbon::now()->format('Y-m-d')) {
                                $withCheckinToday = true;
                                for($count = 0; $count < count($roomCheckinsToday[$loop->index]); $count++) {
                                    if(count($roomCheckinsToday[$loop->index]) == 1) {                                    
                                        $nameString .= $roomCheckinsToday[$loop->index][$count]->firstName.' '.$roomCheckinsToday[$loop->index][$count]->lastName;
                                    } else {
                                        if($count == count($roomCheckinsTodays[$loop->index])-1) {
                                            $nameString .= $roomCheckinsToday[$loop->index][$count]->lastName;
                                        } else {                                    
                                            $nameString .= $roomCheckinsToday[$loop->index][$count]->lastName.', ';
                                        }
                                    }                                
                                }
                            }

                            $withExpiredReservation = false;
                            if($earliestCheckout < \Carbon\Carbon::now()->format('Y-m-d')) {
                                $withExpiredReservation = true;
                                $nameString .= $roomCheckinDates[$loop->index][0]->firstName.' '.$roomCheckinDates[$loop->index][0]->lastName;
                                $needsAttentionCount++;
                            }
                        
                            //echo $occupiedBeds;
                        @endphp
                        <a data-toggle="modal" data-target="#checkin-reserve" style="cursor:pointer" class="load-backpacker-available-details" id={{$room->id}}>
                            <div class="card mx-2" style="width:16rem; height:7.5em;  background-image:url({{asset('room.png')}}); background-size:cover; background-repeat:no-repeat;">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{$room->unitNumber}} 
                                        @if($needsAttentionCount > 0)
                                        <span class="badge badge-danger float-right ml 1-"><i class="fa fa-bell"></i>  {{$needsAttentionCount}}</span>
                                        @endif
                                        @if($notificationCount > 0)
                                        <span class="badge badge-info float-right"><i class="fa fa-bell"></i>  {{$notificationCount}}</span>
                                        @endif
                                        {{--<span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>--}}
                                    </h5>

                                    @if($withCheckinToday)
                                    <p class="card-text" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">{{$nameString}}</p> 
                                    <p class="card-text" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color:lightseagreen; font-style:italic;">Check-ins today!</p>
                                    @elseif($withExpiredReservation)
                                    <p class="card-text" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis;">{{$nameString}}</p> 
                                    <p class="card-text" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color:red; font-style:italic;">Update reservation!</p>
                                    @else
                                    <p class="card-text" style="white-space: nowrap; overflow: hidden;text-overflow: ellipsis; color:lightseagreen; font-style:italic;">Next check-in:<br>{{\Carbon\Carbon::parse($earliestCheckin)->format('F j, Y')}}</p>
                                    @endif
                                    {{--<p class="card-text" style="color:green; font-style:italic;">0 out of {{$room->capacity}} occupied</p>--}}
                                </div>
                            </div>
                        </a>
                        @else
                        <a data-toggle="modal" data-target="#checkin-reserve" style="cursor:pointer" class="load-backpacker-available-details" id={{$room->id}}>
                                <div class="card mx-2" style="width:16rem; height:7.5em;  background-image:url({{asset('room-empty.png')}}); background-size:cover; background-repeat:no-repeat;">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            {{$room->unitNumber}} <!--span class="badge badge-danger float-right"><i class="fa fa-bell"></i>  1</span-->
                                            {{--<span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>--}}
                                        </h5>
    
                                        {{--<p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>--}}
                                        <p class="card-text" style="color:green; font-style:italic;">0 out of {{$room->capacity}} occupied</p>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @endif
                        @endforeach
                    </div>
                @endforeach
                @endif   

                    </div>
                </div>
            @else
                <div class="container" style="padding-top:1em; padding-left:2em;">
                    <p>No units found</p>
                </div>
                @endif
            </div>
        </div>
        <div class="container-fluid col-md-3 m-0 p-0" id="unitFinder" style="padding-top:25em;">
            <div class="card p-0 mx-0" style="font-size:0.9em; {{--background-color:#e1fdec66;--}}">
                <div class="card-body">
                    <h4 class="text-center pb-1">Room Finder</h4>
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
                                <input class="form-control roomFinderInputs" id="roomFinderCheckinDate" type="date" name="checkin" maxlength="15" placeholder="" value="" required>
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
                                <input class="form-control roomFinderInputs" type="date" id="roomFinderCheckoutDate" name="checkout" maxlength="15" placeholder="" value="" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label class="col-sm-4 mb-0 mt-2" for="unitCount">No. of rooms</label>
                            <div class="input-group input-group-sm mb-1 col-sm-8">
                                <input class="form-control roomFinderInputs" type="number" id="roomFinderUnitCount" name="unitCount" maxlength="15" placeholder="" value="" required>
                            </div>
                        </div>
                        <hr class="my-3">
                        <h6 class="text-center mb-1">Available Rooms</h6>
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
                <a href="" id="checkin-backpacker">
                    <button type="button" class="btn btn-primary">Check-in</button>
                </a>
                <a href="" id="reserveBackpackerEmpty">
                    <button type="button" class="btn btn-secondary">Add reservation</button>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
 