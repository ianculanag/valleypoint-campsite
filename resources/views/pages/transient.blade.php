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
                <a class="nav-link" href="/glamping/">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/transient-backpacker/">Transient Backpacker</a>
            </li>
        </ul>
    </div>
    <!--h1>Lodging Monitoring</h1-->
    @if(count($units) > 0)
    <div class="container" style="padding-top: 1em;">
        <div class="container">
            <h5 class="unit-heading">4 pax</h5>
            <div class="row">
    <!--h2>Rooms</h2-->
        @foreach($units as $unit)
            {{--insert frontend loop here--}}
            @if($unit->unitType == 'room' && $unit->capacity == 4)            
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$unit->unitNumber}}</h5>
                    <p class="card-text">Guest Name</p>
                    <p class="card-text">Guest ID</p>
                    <div class="text-right">
                    <a href="/units/{{$unit->id}}"><button type="button" class="btn btn-info logding-details-btn">View Details</button></a>
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

            <!-- 6 pax -->

            <h5 class="unit-heading">6 pax</h5>
            <div class="row">
    <!--h2>Rooms</h2-->
        @foreach($units as $unit)
            {{--insert frontend loop here--}}
            @if($unit->unitType == 'room' && $unit->capacity == 6)            
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$unit->unitNumber}}</h5>
                    <p class="card-text">Guest Name</p>
                    <p class="card-text">Guest ID</p>
                    <div class="text-right">
                    <a href="/units/{{$unit->id}}"><button type="button" class="btn btn-info logding-details-btn">View Details</button></a>
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

        <!-- 10 pax -->
        <h5 class="unit-heading">10 pax</h5>
            <div class="row">
    <!--h2>Rooms</h2-->
        @foreach($units as $unit)
            {{--insert frontend loop here--}}
            @if($unit->unitType == 'room' && $unit->capacity == 10)            
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$unit->unitNumber}}</h5>
                    <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                    <p class="card-text">{{$unit->id}}</p>
                    <div class="text-right">
                    <a href="/units/{{$unit->id}}"><button type="button" class="btn btn-info logding-details-btn">View Details</button></a>
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
 