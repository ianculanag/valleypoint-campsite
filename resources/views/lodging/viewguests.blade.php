@extends('layouts.app')

@section('content')

<div class="table-responsive">
    <div class="container-fluid">
    <h1 class="display-4">Valleypoint Campsite</h1>
        <h4 class="text-muted">View Guests</h4>
            <table class="table table-bordered" >
                <thead>
                  <tr class="">
                    <th scope="col" class="text-center">Guests ID</th>
                    <th scope="col" class="text-center">Last Name</th>
                    <th scope="col" class="text-center">First Name</th>
                    <th scope="col" class="text-center">Listed Under</th>
                    <th scope="col" class="text-center">Contact Number</th>
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

                    <td><button class="btn btn-success">Accept</button>
                        <button class="btn btn-warning">Reject</button>
                        <button class="btn btn-info">Edit</button>
                        <button class="btn btn-danger">Delete</button>
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