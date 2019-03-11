@extends('layouts.app')

@section('content')
<div class="py-4 text-center">
  <h3 class="text-center">Guests</h3>
</div>
<div class="col-md-12">
  <table class="table table-striped table-sm reservationTable">
                <thead>
                  <tr class="">
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Type</th>
                    <th scope="col" class="text-center">First Name</th>
                    <th scope="col" class="text-center">Last Name</th>
                    <th scope="col" class="text-center">Listed Under</th>
                    <th scope="col" class="text-center">No. Of Pax</th>
                    <th scope="col" class="text-center">Contact Number</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @if(count($guest) > 1)
                  @foreach($guest as $guest)
                  <tr class="">
                    <td class="text-center">{{$guest->guestID}}</td>
                    <td class="text-center">{{$guest->lastName}}</td>
                    <td class="text-center">{{$guest->firstName}}</td>
                    <td class="text-center">{{$guest->listedUnder}}</td>
                    <td class="text-center">{{$guest->contactNumber}}</td>

                    <td>
                        <button class="btn btn-info" class="text-center">Edit</button>
                    </td>
                  </tr>
                  @endforeach
                  @endif
{{-- 
                  <tr class="">
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td><button class="btn btn-success">Accept</button>
                      <button class="btn btn-warning">Reject</button>
                      <button class="btn btn-info">Edit</button>
                      <button class="btn btn-danger">Delete</button>
                  </td>
                </tr>                               
              </tbody> --}}

            </table>
    </div>
</div>

@endsection