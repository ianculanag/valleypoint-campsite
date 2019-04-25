@extends('layouts.app')

@section('content')
    <div class="container row pb-5 pt-3">
        <!--div class="pt-3 pb-3 text-center">
            <a href="/glamping">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
        </div--> 
        <div class="col-md-2 float-right mx-5 pl-5 pt-2" style="position:fixed; right:0;">
            <nav class="nav nav-pills nav-stacked mb-5 pb-5" style="display:block;">
                <a class="nav-item nav-link reports-tabs text-center active" style="background-color:#060f0ed4;" href="#">Daily</a>
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="#">Weekly</a>
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="#">Monthly</a>
            </nav>
            <div class="card mt-5 py-3 px-0 mx-0">
                <form method="POST" action="#">
                    @csrf
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <h6 class="text-center pb-1 mb-0"> Date </h6>
                    <div class="form-group px-2 py-1 my-0">
                        <!--label class="mb-1 text-center" for="checkin" style="">Date</label-->
                        <div class="input-group input-group-sm my-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                                 </span>
                            </div>
                            @if(isset($display))
                            <input class="form-control lodgingReportDateInputs" id="lodgingReportDate" type="date" name="lodgingReportDate" maxlength="15" placeholder="" value="{{$display}}" required>
                            @else
                            <input class="form-control lodgingReportDateInputs" id="lodgingReportDate" type="date" name="lodgingReportDate" maxlength="15" placeholder="" value="<?php echo date("Y-m-d");?>" required>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="container col-md-10">
            <div class="card col-md-10 offset-md-1 py-4 ">
                <div class="row">
                    <div class="col-md-7 col-sm-4">
                        <img src={{asset('logo.jpg')}} class="float-left" style="height:7.5em; width:9.75em;" aria-hidden="true"></img>
                    </div>
                    <div class="col-md-5 col-sm-8 px-5 pt-3">
                        <h6>Valleypoint Campsite</h6>
                        <h6>{{\Carbon\Carbon::now()->format('F j, o')}}</h6>
                    </div>
                </div>
                <div class="card-body">
                    <h6> Today's Figures </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-sm table-bordered" style="font-size:.90em;">
                                <thread>
                                    <tr>
                                        <th colspan="2"> Glamping Accommodation </th>
                                    </tr>
                                <thread>
                                <tbody>
                                    @php
                                        $occupiedTentCount = 0;
                                        $totalTents = 0;
                                        $totalGlampingGuests = 0;
                                        $glampingArrivalCount = 0;
                                        $glampingDepartureCount = 0;
                                    @endphp
                                    <tr>
                                        <td> Occupied tents </td>
                                        @foreach ($occupiedTents as $tentsOccupied)
                                            @php
                                                $occupiedTentCount++;
                                            @endphp
                                        @endforeach
                                        <td class="text-right"> {{$occupiedTentCount}} </td>
                                    </tr>
                                    <tr>
                                        <td> Unoccupied tents </td>
                                        @foreach ($tents as $tent)
                                            @php
                                                $totalTents++;
                                            @endphp
                                        @endforeach
                                        <td class="text-right"> {{$totalTents-$occupiedTentCount}} </td>
                                    </tr>
                                    <tr>
                                        <td> Checked-in guests </td>
                                        @foreach ($glampingAccommodations as $glampingAccommodation)
                                            @php
                                                $totalGlampingGuests += $glampingAccommodation->numberOfPax;
                                            @endphp
                                        @endforeach
                                        <td class="text-right"> {{$totalGlampingGuests}} </td>
                                    </tr>
                                    <tr>
                                        <td> Arrivals </td>
                                        @foreach ($glampingArrivals as $glampingArrival)
                                            @php
                                                $glampingArrivalCount++;
                                            @endphp
                                        @endforeach
                                        <td class="text-right"> {{$glampingArrivalCount}} </td>
                                    </tr>
                                    <tr>
                                        <td> Departures </td>
                                        @foreach ($glampingDepartures as $glampingDeparture)
                                            @php
                                                $glampingDepartureCount++;
                                            @endphp
                                        @endforeach
                                        <td class="text-right"> {{$glampingDepartureCount}} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-sm table-bordered" style="font-size:.90em;">
                                <thread>
                                    <tr>
                                        <th colspan="2"> Backpacker Accommodation </th>
                                    </tr>
                                <thread>
                                <tbody>
                                    @php
                                        $occupiedRoomCount = 0;
                                        $totalRooms = 0;
                                        $totalBackpackerGuests = 0;
                                        $backpackerArrivalCount = 0;
                                        $backpackerDepartureCount = 0;
                                    @endphp
                                    <tr>
                                        <td> Occupied rooms </td>
                                        @foreach ($occupiedRooms as $roomsOccupied)
                                            @php
                                                $occupiedRoomCount++;
                                            @endphp
                                        @endforeach
                                        <td class="text-right"> {{$occupiedRoomCount}} </td>
                                    </tr>
                                    <tr>
                                        <td> Unoccupied rooms </td>
                                        @foreach ($rooms as $room)
                                            @php
                                                $totalRoomss++;
                                            @endphp
                                        @endforeach
                                        <td class="text-right"> {{$totalRooms-$occupiedRoomCount}} </td>
                                    </tr>
                                    <tr>
                                        <td> Checked-in guests </td>
                                        @foreach ($backpackerAccommodations as $backpackerAccommodation)
                                            @php
                                                $totalBackpackerGuests += $backpackerAccommodation->numberOfPax;
                                            @endphp
                                        @endforeach
                                        <td class="text-right"> {{$totalBackpackerGuests}} </td>
                                    </tr>
                                    <tr>
                                        <td> Arrivals </td>
                                        @foreach ($backpackerArrivals as $backpackerArrival)
                                            @php
                                                $backpackerArrivalCount++;
                                            @endphp
                                        @endforeach
                                        <td class="text-right"> {{$backpackerArrivalCount}} </td>
                                    </tr>
                                    <tr>
                                        <td> Departures </td>
                                        @foreach ($backpackerDepartures as $backpackerDeparture)
                                            @php
                                                $backpackerDepartureCount++;
                                            @endphp
                                        @endforeach
                                        <td class="text-right"> {{$backpackerDepartureCount}} </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        <h6> Today's Guest Arrivals </h6>
                        <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <thread>
                                <tr>
                                    <th colspan="6"> Glamping Accommodation </th>
                                </tr>
                            <thread>
                            <tbody>
                                <tr>
                                    <td class="text-center"> Tent no. </td>
                                    <td class="text-center"> Guest name </td>
                                    <td class="text-center"> Package availed </td>
                                    <td class="text-center"> Status </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <thread>
                                <tr>
                                    <th colspan="6"> Backpacker Accommodation </th>
                                </tr>
                            <thread>
                            <tbody>
                                <tr>
                                    <td class="text-center"> Room no. </td>
                                    <td class="text-center"> Guest name </td>
                                    <td class="text-center"> No. of pax </td>
                                    <td class="text-center"> Status </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h6> Today's Transactions </h6>
                        <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <!--thread>
                                <tr>
                                    <th class="text-center" colspan="6"> Glamping Accommodation </th>
                                </tr>
                            <thread-->
                            <tbody>
                                <tr>
                                    <td class="text-center"> Guest name </td>
                                    <td class="text-center"> Accommodation </td>
                                    <td class="text-center"> Package availed </td>
                                    <td class="text-center"> Quantity </td>
                                    <td class="text-center"> Amount paid </td>
                                    <td class="text-center"> Balance </td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection