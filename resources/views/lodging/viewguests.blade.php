@extends('layouts.app')

@section('content')
      <div class="py-4 text-center">
           <h3 class="text-center">Guests</h3>
      </div>
      <div class="col-md-12">
          <table class="table table-striped table-sm guestsTable">
                <thead>
                  <tr class="">
                    <th scope="col" class="text-center">Guest ID</th>
                    <th scope="col" class="text-center">Type</th>
                    <th scope="col" class="text-center">First Name</th>
                    <th scope="col" class="text-center">Last Name</th>
                    <th scope="col" class="text-center">Listed Under</th>
                    <th scope="col" class="text-center">No. of Pax</th>
                    <th scope="col" class="text-center">Contact Number</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @if(count($guest) > 1)
                  @foreach($guest as $guest)
                  <tr class="">
                    <td class="text-center">{{$guest->guestID}}</td>
                    <td class="text-center">{{$guest->serviceName}}</td>
                    <td class="text-center">{{str_limit($guest->firstName, $limit = 10, $end = '...')}}</td>
                    <td class="text-center">{{str_limit($guest->lastName, $limit = 10, $end = '...')}}</td>
                    <td class="text-center">{{$guest->listedUnder}}</td>
                    <td class="text-center">{{$guest->numberOfPax}}</td>
                    <td class="text-center">{{$guest->contactNumber}}</td>

                    <td class="text-center">
                        <button class="btn btn-info">Edit</button>
                    </td>
                  </tr>
                  @endforeach
                  @endif
            </table>
 @endsection