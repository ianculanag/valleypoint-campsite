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
        <h3 class="text-center">Guests</h3>
    </div>
    <div class="col-md-12">
        <table id="guestsTable" data-order='[[ 0, "asc" ]]' class="table table-sm dataTable stripe compact" cellspacing="0">
              <thead>
                <tr class="">
                  <th>Guest ID</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Contact Number</th>
                  <th>Accommodation</th>
                  <th>Unit Number</th>
                  <th>Number of units</th>
                  
                </tr>
              </thead>
              <tbody>
                
                @if(count($guest) > 1)
                @foreach($guest as $guest)
                <tr class="">
                  <td>{{$guest->guestID}}</td>
                  <td>{{str_limit($guest->firstName, $limit = 10, $end = '...')}}</td>
                  <td>{{str_limit($guest->lastName, $limit = 10, $end = '...')}}</td>
                  <td>{{$guest->contactNumber}}</td>                    
                  <td>{{$guest->serviceName}}</td>
                  <td>{{$guest->unitNumber}}</td>
                  <td>{{$guest->numberOfUnits}}</td>
                </tr>
                @endforeach
                @endif
          </table>
        </div>
 @endsection