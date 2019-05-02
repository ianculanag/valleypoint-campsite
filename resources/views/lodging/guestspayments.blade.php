@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <div class="py-3 text-center">
            <a href="/edit-details/1">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>View Payment Details</h3>
        </div>        
        <form class="form" method="POST" action="/updateDetails">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                    
        {{--<input type="hidden" name="accommodationID" value="{{$guestDetails->accommodationID}}">--}}

          
@endsection