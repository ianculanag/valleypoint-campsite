@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center lodging-tabs">
        <nav class="nav nav-pills centered-pills">
            <a class="nav-item nav-link" style="color:#505050" href="/backpacker">Physical View</a>
            <a class="nav-item nav-link active" style="background-color:#060f0ed4;" href="#">Calendar View</a>
        </nav>
    </div>
    <div class="container-fluid lodging-tabs mx-1 pt-1">
        <ul class="nav nav-tabs w-100 pt-0">
            <li class="nav-item">
                <a class="nav-link" style="color:#505050;" href="/calendar-glamping">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/calendar-backpacker">Backpacker</a>
            </li>
        </ul>
    </div>    
    <form method="POST" action="/reload-calendar-backpacker">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="container col-md-6 offset-3 row px-5" style="padding-left:5.5em;">
            <div class="form-group px-2 col-md-5">
                <!--label class="mb-0" for="checkin" style="padding-right:0;">Check-in date</label-->
                <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                        </span>
                    </div>
                    @if(isset($from))
                    <input class="form-control backpackerCalendarInputs" id="backpackerCalendarFrom" type="date" name="backpackerCalendarFrom" maxlength="15" placeholder="" value="{{$from}}" required>
                    @else
                    <input class="form-control backpackerCalendarInputs" id="backpackerCalendarFrom" type="date" name="backpackerCalendarFrom" maxlength="15" placeholder="" value="<?php echo date("Y-m-d");?>" required>
                    @endif
                </div>
            </div>
            <span>-</span>
            <div class="form-group px-2 col-md-5">
                <!--label class="mb-0" for="checkout" style="padding-right:0;">Check-out date</label-->
                <div class="input-group input-group-sm mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fa fa-calendar-alt" aria-hidden="true"></i>
                        </span>
                    </div>
                    @if(isset($to))
                    <input class="form-control backpackergCalendarInputs" id="backpackerCalendarTo" type="date" name="backpackerCalendarTo" maxlength="15" placeholder="" value="{{$to}}" required>
                    @else
                    <input class="form-control backpackerCalendarInputs" type="date" id="backpackerCalendarTo" name="backpackergCalendarTo" maxlength="15" placeholder="" value="" required>
                    @endif
                </div>
            </div>
            <div class="col-md-1 px-1">
                <button class="btn btn-sm btn-success" type="submit">
                    <i class="fa fa-calendar-check" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="container-fluid scrollbar-near-moon p-0" style="overflow-y:auto; max-height:57vh; max-width:77vw; overflow-x:auto;">
        <table class="table table-sm m-0">
        <thead id="glampingCalendarHead">
            <th style="text-align:center; position:fixed; background-color:rgb(233, 236, 239); z-index:101; min-width:6.1em; min-height:3.7em; border:none;"></th>            
            <tr class="pt-5">
            <th style="text-align:center; position:sticky; background-color:rgb(233, 236, 239); z-index:101; min-width:6em; min-height:3.7em; border:none;"></th>   
            @if(count($dates) > 0)
            @foreach($dates as $date)
                <td style="text-align:center; position:sticky; top:0; background-color:rgb(233, 236, 239); z-index:100; min-width:4.3em;" scope="col" colspan="2">
                    {{\Carbon\Carbon::parse($date)->format('D')}}
                    <hr class="py-0 my-0">
                    {{\Carbon\Carbon::parse($date)->format('M j')}}
                </td>
            @endforeach
            @endif
            </tr>
        </thead>
        <tbody>
            <!--tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td></td>
            </tr-->
            @if(count($units) > 0)
            @foreach($units as $unit)
                <tr>
                <td scope="row" style="text-align:center; position:sticky; left:0; background-color:rgb(233, 236, 239); min-width:6em;">{{$unit->unitNumber}}</td>
                @foreach($dates as $date)
                @php
                    $idAM = $unit->unitNumber.(string)$date.'AM';
                    $idPM = $unit->unitNumber.(string)$date.'PM';

                    $hitAM = false;
                    $hitPM = false;

                    $hit = false;

                    $occupiedColor = 'rgb(255, 109, 135)';
                    $reservedColor = 'rgb(47, 228, 180)';

                    $isAccommodation = false;
                    $isReservation = false;

                    for($index = 0; $index < count($blockDates); $index++) {

                        if($unit->unitNumber == $blockDates[$index]->unitNumber) {
                            if($date == \Carbon\Carbon::parse($blockDates[$index]->checkinDatetime)->format('Y-m-d')) {
                                $hitPM = true;
                            } else if ($date == \Carbon\Carbon::parse($blockDates[$index]->checkoutDatetime)->format('Y-m-d')) {
                                $hitAM = true;
                            } else if (($date > \Carbon\Carbon::parse($blockDates[$index]->checkinDatetime)->format('Y-m-d') &&
                                       ($date < \Carbon\Carbon::parse($blockDates[$index]->checkoutDatetime)->format('Y-m-d')))) {
                                $hit = true;
                            }

                            if (isset($blockDates[$index]->accommodationID)) {
                                $isAccommodation = true;
                            } else if (isset($blockDates[$index]->reservationID)) {
                                $isReservation = true;
                            }
                        }
                    }
                @endphp
                @if($isAccommodation)
                    @if($hitPM)
                    <td scope="col" id="{{$idAM}}"></td>                
                    <td scope="col" id="{{$idPM}}" style="background-color:{{$occupiedColor}}"></td>
                    
                    @elseif($hitAM)
                    <td scope="col" id="{{$idAM}}" style="background-color:{{$occupiedColor}}"></td>                
                    <td scope="col" id="{{$idPM}}"></td>
                    
                    @elseif($hit)
                    <td scope="col" id="{{$idAM}}" style="background-color:{{$occupiedColor}}"></td>                
                    <td scope="col" id="{{$idPM}}" style="background-color:{{$occupiedColor}}"></td>

                    @else
                    
                    <td scope="col" id="{{$idAM}}"></td>                
                    <td scope="col" id="{{$idPM}}"></td>
                    @endif
                @elseif($isReservation)
                    @if($hitPM)
                    <td scope="col" id="{{$idAM}}"></td>                
                    <td scope="col" id="{{$idPM}}" style="background-color:{{$reservedColor}}"></td>
                    
                    @elseif($hitAM)
                    <td scope="col" id="{{$idAM}}" style="background-color:{{$reservedColor}}"></td>                
                    <td scope="col" id="{{$idPM}}"></td>
                    
                    @elseif($hit)
                    <td scope="col" id="{{$idAM}}" style="background-color:{{$reservedColor}}"></td>                
                    <td scope="col" id="{{$idPM}}" style="background-color:{{$reservedColor}}"></td>

                    @else
                    
                    <td scope="col" id="{{$idAM}}"></td>                
                    <td scope="col" id="{{$idPM}}"></td>
                    @endif
                @else
                    <td scope="col" id="{{$idAM}}"></td>                
                    <td scope="col" id="{{$idPM}}"></td>
                @endif
                @endforeach
                </tr>
            @endforeach
            @endif
        </tbody>
        </table>                  
    </div>
    <div class="container legend text-center pt-2">
        <span class="px-5">
            <i class="fa fa-square" style="color:{{$occupiedColor}}" aria-hidden="true"></i>
            Occupied
        </span>
        <span class="px-5">
            <i class="fa fa-square" style="color:{{$reservedColor}}" aria-hidden="true"></i>
            Reserved
        </span>
    </div>
@endsection
 