@extends('layouts.app')

@section('content')
            <div class="py-4 text-center">
                <h3 class="text-center">Reservations</h3>
            </div>
            <div class="col-md-12">
                <table class="table table-striped table-sm reservationTable">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">ID</th>
                            <th scope="col" class="text-center">Type</th>
                            <th scope="col" class="text-center">First Name</th>
                            <th scope="col" class="text-center">Last Name</th>
                            <th scope="col" class="text-center">Contact No.</th>
                            <th scope="col" class="text-center">No. of Pax</th>
                            <th scope="col" class="text-center">Check-in Date</th>
                            <th scope="col" colspan="3" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            @if(count($reserve) > 0)
                            @foreach($reserve as $reservations)
                        <tr>
                        <td class="text-center">{{$reservations->unitID}}</td>
                        <td class="text-center">{{$reservations->serviceName}}</td>
                        <td class="text-center">{{$reservations->firstName}}</td>
                        <td class="text-center">{{$reservations->lastName}}</td>
                        <td class="text-center">{{$reservations->contactNumber}}</td>
                        <td class="text-center">{{$reservations->numberOfPax}}</td>
                        <td class="text-center">{{$reservations->checkinDatetime}}</td>
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