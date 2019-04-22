@extends('layouts.app')
@section('content')
    <div class="container pb-5">
        <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="user-management-card" id={{$unit->unitID}}>       
            <div class="card mx-2" style="width:16rem; height:7.5em; background-image:url({{--asset('')--}}); background-size:cover; background-repeat:no-repeat;">
                <div class="card-body">
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>
                    </h5>
                    <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                    <p class="card-text" style="color:green; font-style:italic;"> {{$unit->serviceName}}</p>
                </div>
            </div>
        </a>
    </div>
@endsection