@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center lodging-tabs">
        <nav class="nav nav-pills centered-pills">
            <a class="nav-item nav-link active" href="#">Physical View</a>
            <a class="nav-item nav-link" href="#">Calendar View</a>
        </nav>
    </div>
    <div class="container lodging-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="physical view (glamping).html">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">Transient Backpacker</a>
            </li>
        </ul>
    </div>
    <!--h1>Lodging Monitoring</h1-->
    @if(count($units) > 0)
    <div class="container" style="padding-top: 1em;">
        <div class="container">
            <div class="row">
    <!--h2>Rooms</h2-->
        @foreach($units as $unit)
            {{--insert frontend loop here--}}
            @if($unit->unitType == 'room')            
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$unit->unitNumber}}</h5>
                    <p class="card-text">Guest Name</p>
                    <p class="card-text">Guest ID</p>
                    <p class="card-text">Status: {{$unit->status}}</p>
                    <div class="text-right">
                        <button type="button" class="btn btn-info logding-details-btn">View Details</button>
                    </div>
                </div>
            </div>
            <!--div class="card">
                    <h3><a href="/units/{{--$unit->id}}">{{$unit->unitNumber}}<a></h3>
                    <p>Capacity: {{$unit->capacity}}</p>
                    <p>Status: {{$unit->status}}</p>
                    <p>Type: {{$unit->unitType--}}</p>
            </div-->
            @endif
        @endforeach
            </div>
        </div>
    </div>
        <!--h2>tent</h2-->
        {{--@foreach($units as $unit)
        {{--insert frontend here--
        @if($unit->unitType == 'tent')
        <div class="card">
                <h3><a href="/units/{{$unit->id}}">{{$unit->unitNumber}}<a></h3>
                <p>Capacity: {{$unit->capacity}}</p>
                <p>Status: {{$unit->status}}</p>
                <p>Type: {{$unit->unitType}}</p>
        </div>
        @endif--}}
        {{--$units->links()--}}
    @else
        <p>No units found</p>
    @endif
@endsection
 