@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center lodging-tabs">
        <nav class="nav nav-pills centered-pills">
            <a class="nav-item nav-link" style="color:#505050" href="/glamping">Physical View</a>
            <a class="nav-item nav-link active" style="background-color:#505050" href="#">Calendar View</a>
        </nav>
    </div>
    <div class="container-fluid lodging-tabs mx-1 pt-1">
        <ul class="nav nav-tabs w-100 pt-0">
            <li class="nav-item">
                <a class="nav-link active" href="/calendar-glamping">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:#505050;" href="/calendar-backpacker">Backpacker</a>
            </li>
        </ul>
    </div>    
    <div class="container-fluid pb-5" style="padding-top:1em;">
        <table class="table table-sm table-bordered">
        <thead>
            <tr>
            <th scope="col"></th>            
            @if(count($dates) > 0)
            @foreach($dates as $date)
                <td style="text-align: center;" scope="col" colspan="2">{{\Carbon\Carbon::parse($date)->format('D')}}
                                        <hr class="py-0 my-0">{{\Carbon\Carbon::parse($date)->format('M j')}}</td>
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
                <td scope="row" style="text-align: center;">{{$unit->unitNumber}}</td>
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

                    $guestName = '';

                    for($index = 0; $index < count($blockDates); $index++) {

                        if(($unit->unitNumber == $blockDates[$index]->unitNumber) &&
                           ($date >= \Carbon\Carbon::parse($blockDates[$index]->checkinDatetime)->format('Y-m-d')) &&
                           ($date <= \Carbon\Carbon::parse($blockDates[$index]->checkoutDatetime)->format('Y-m-d'))) {
                            
                            $guestName = '';
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
                                $isReservation = false;
                                $selectedUnitID = $blockDates[$index]->unitID;
                                $guestName = $blockDates[$index]->firstName.' '.$blockDates[$index]->lastName;
                            } else if (isset($blockDates[$index]->reservationID)) {
                                $isReservation = true;      
                                $isAccommodation = false;                     
                                $selectedUnitID = $blockDates[$index]->unitID;
                                $reservationID = $blockDates[$index]->reservationID;
                                $guestName = $blockDates[$index]->firstName.' '.$blockDates[$index]->lastName;
                            }
                        }
                    }
                @endphp
                @if($isAccommodation)
                    @if($hitPM)
                    <td scope="col" id="{{$idAM}}"></td>                
                    <td scope="col" id="{{$idPM}}" style="background-color:{{$occupiedColor}}; padding:0;">
                        <a data-toggle="tooltip" data-placement="bottom" title="{{$guestName}}" href="/edit-details/{{$selectedUnitID}}" style="height:100%;width:100%;display: block; text-decoration:none;">&nbsp;</a>
                    </td>
                    
                    @elseif($hitAM)                
                    <td scope="col" id="{{$idAM}}" style="background-color:{{$occupiedColor}}; padding:0;">
                        <a data-toggle="tooltip" data-placement="bottom" title="{{$guestName}}" href="/edit-details/{{$selectedUnitID}}" style="height:100%;width:100%;display: block; text-decoration:none;">&nbsp;</a>
                    </td>
                    <td scope="col" id="{{$idPM}}"></td>
                    
                    @elseif($hit)                
                    <td scope="col" id="{{$idAM}}" style="background-color:{{$occupiedColor}}; padding:0;">
                        <a data-toggle="tooltip" data-placement="bottom" title="{{$guestName}}" href="/edit-details/{{$selectedUnitID}}" style="height:100%;width:100%;display: block; text-decoration:none;">&nbsp;</a>
                    </td>                
                    <td scope="col" id="{{$idPM}}" style="background-color:{{$occupiedColor}}; padding:0;">
                        <a data-toggle="tooltip" data-placement="bottom" title="{{$guestName}}" href="/edit-details/{{$selectedUnitID}}" style="height:100%;width:100%;display: block; text-decoration:none;">&nbsp;</a>
                    </td>

                    @else
                    
                    <td scope="col" id="{{$idAM}}"></td>                
                    <td scope="col" id="{{$idPM}}"></td>
                    @endif
                @elseif($isReservation)
                    @if($hitPM)
                    <td scope="col" id="{{$idAM}}"></td>                
                    <td scope="col" id="{{$idPM}}" style="background-color:{{$reservedColor}}; padding:0;">
                        <a data-toggle="tooltip" data-placement="bottom" title="{{$guestName}}" href="/view-reservation-details/{{$selectedUnitID}}/{{$reservationID}}" style="height:100%;width:100%;display: block; text-decoration:none;">&nbsp;</a>
                    </td>
                    
                    @elseif($hitAM)
                    <td scope="col" id="{{$idAM}}" style="background-color:{{$reservedColor}}; padding:0;">
                        <a data-toggle="tooltip" data-placement="bottom" title="{{$guestName}}" href="/view-reservation-details/{{$selectedUnitID}}/{{$reservationID}}" style="height:100%;width:100%;display: block; text-decoration:none;">&nbsp;</a>
                    </td>                
                    <td scope="col" id="{{$idPM}}"></td>
                    
                    @elseif($hit)
                    <td scope="col" id="{{$idAM}}" style="background-color:{{$reservedColor}}; padding:0;">
                        <a data-toggle="tooltip" data-placement="bottom" title="{{$guestName}}" href="/view-reservation-details/{{$selectedUnitID}}/{{$reservationID}}" style="height:100%;width:100%;display: block; text-decoration:none;">&nbsp;</a>
                    </td>                
                    <td scope="col" id="{{$idPM}}" style="background-color:{{$reservedColor}}; padding:0;">
                        <a data-toggle="tooltip" data-placement="bottom" title="{{$guestName}}" href="/view-reservation-details/{{$selectedUnitID}}/{{$reservationID}}" style="height:100%;width:100%;display: block; text-decoration:none;">&nbsp;</a>
                    </td>

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
@endsection
 