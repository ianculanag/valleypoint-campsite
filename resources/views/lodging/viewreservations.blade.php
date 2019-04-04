@extends('layouts.app')

@section('content')
<div class="container" style="position:fixed;">
    <div class="pt-3 pb-3">
        <a href="/glamping">
            <span style="float:left;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <strong>Back</strong>
            </span>
        </a>
        <h3 class="text-center">Reservations</h3>
    </div>
    <div class="col-md-12">
        <table data-order='[[ 1, "asc" ]]' class="table table-sm dataTable stripe compact" cellspacing="0" id="reservationTable">
            <thead>
                <tr>
                    <!--th scope="col">Type</th-->                    
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact No.</th>
                    <th>No. of Pax</th>
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
                <td>{{$reservation->id}}</td>
                <td>{{$reservation->firstName}}</td>
                <td>{{$reservation->lastName}}</td>
                <td>{{$reservation->contactNumber}}</td>
                <td>{{$reservation->numberOfPax}}</td>
                <td>{{$reservation->checkinDatetime}}</td>
                    <td><button class="btn btn-sm btn-success">Check-in</button>
                        <button class="btn btn-sm btn-info">Edit</button>
                        <button class="btn btn-sm btn-danger">Cancel</button>
                    </td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
@endsection