@extends('layouts.app')

@section('content')
    <div class="py-4 text-center">
        <h3 class="text-center">Reservations</h3>
    </div>
    <!--div class="container">
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
    </div-->
    <div class="col-md-12">
        <table id="reservationTable" class="table table-striped table-sm reservationTable" cellspacing="0">
            <thead>
                <tr>
                    <!--th scope="col">Type</th-->                    
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Contact No.</th>
                    <th scope="col">No. of Pax</th>
                    <th scope="col">Check-in Date</th>
                    <th scope="col" colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                    @if(count($reservations) > 0)
                    @foreach($reservations as $reservation)
                <tr>
                {{--<td class="text-center">{{$reservations->unitID}}</td>
                <td>{{$reservation->serviceName}}</td>--}}                
                <td class="text-center">{{$reservation->id}}</td>
                <td>{{$reservation->firstName}}</td>
                <td>{{$reservation->lastName}}</td>
                <td>{{$reservation->contactNumber}}</td>
                <td>{{$reservation->numberOfPax}}</td>
                <td>{{$reservation->reservationDatetime}}</td>
                    <td><button class="btn btn-success">Check-in</button>
                        <button class="btn btn-info">Edit</button>
                        <button class="btn btn-danger">Cancel</button>
                    </td>
                </tr>
                    @endforeach
                    @endif
            </tbody>
        </table>
    </div>
@endsection