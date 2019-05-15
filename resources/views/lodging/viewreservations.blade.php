@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="pt-3 pb-3">
        {{--<a href="{{ URL::previous() }}">
            <span style="float:left;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <strong>Back</strong>
            </span>
        </a>--}}
        <h3 class="text-center">Reservations</h3>
    </div>
    <div class="col-md-12">
        <table data-order='[[ 0, "asc" ]]' class="table table-sm dataTable stripe compact" cellspacing="0" id="reservationTable">
            <thead>
                <tr>
                    <!--th scope="col">Type</th-->                    
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact No.</th>
                    <th>Unit No.</th>
                    <th>Check-in Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @if(count($reservations) > 0)
                @foreach($reservations as $reservation)
                <tr>
                {{--<td class="text-center">{{$reservations->unitID}}</td>
                <td>{{$reservation->serviceName}}</td>--}}                
                <td>{{$reservation->reservationID}}</td>
                <td>{{$reservation->firstName}}</td>
                <td>{{$reservation->lastName}}</td>
                <td>{{$reservation->contactNumber}}</td>
                <td>{{$reservation->unitNumber}}</td>
                <td>{{\Carbon\Carbon::parse($reservation->checkinDatetime)->format('M j, Y')}}</td>
                <td><a href="/checkin/{{$reservation->unitID}}/{{$reservation->id}}"><button class="btn btn-sm btn-success">Check-in</button></a>
                        <button class="btn btn-sm btn-info">Edit</button>
                    <a id="{{$reservation->reservationID}}-{{$reservation->unitID}}" class="cancel-reservation-modal" data-toggle="modal" data-target="#removeReservationModal">
                        <button class="btn btn-sm btn-danger">Cancel</button>
                    </a>
                    </td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Cancel reservation modal -->
<div class="modal fade" id="removeReservationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel Reservation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="cancelReservationModalBody">
                {{--<p> <strong>Warning!</strong> Are you sure you want to cancel this reservation? This operation cannot be undone.</p>
                <div class="card">
                    <div class="card-body px-0">
                        <table class="table table-sm borderless">
                            <tr>
                                <td rowspan="4" style="font-weight:bold; width:7%"></td>
                                <td style="width:28%">Guest name: </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td style="width:28%">Service: </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Check-in: </td>
                                <td style="color:green; font-syle:italic;"></td>
                            </tr>
                            <tr>
                                <td>Check-out: </td>
                                <td style="color:green; font-syle:italic;"></td>
                            </tr>
                        </table>
                    </div>
                </div>--}}
            </div>
            <div class="modal-footer">
                <a href="" id="confirmCancel"><button type="button" class="btn btn-danger" style="width:5em;">Yes</button></a>
                <button type="button" class="btn btn-primary" style="width:5em;" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
@endsection