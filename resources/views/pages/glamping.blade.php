@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center lodging-tabs">
        <nav class="nav nav-pills centered-pills">
            <a class="nav-item nav-link active" style="background-color:#505050" href="#">Physical View</a>
            <a class="nav-item nav-link" style="color:#505050" href="#">Calendar View</a>
        </nav>
    </div>
    <div class="container lodging-tabs">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="/glamping">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" style="color:#505050;" href="/transient-backpacker">Transient Backpacker</a>
            </li>
        </ul>
    </div>
    
    @if(count($units) > 0)
    <div class="container" style="padding-top: 1em;">
        <div class="container">
            <div class="row">  

        @foreach($units as $unit)
            
            @if($unit->unitType == 'tent')          
            <div class="card" style="width:18rem;">
                <div class="card-body">

                @if($unit->status == 'occupied')
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>
                    </h5>
                    <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                    <p class="card-text">{{$unit->id}}</p>

                @elseif($unit->status == 'reserved')
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-secondary float-right" style="font-size:.55em;">Reserved</span>
                    </h5>
                    <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                    <p class="card-text">{{$unit->id}}</p>

                @else
                    <h5 class="card-title">
                        {{$unit->unitNumber}}
                        <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                    </h5>
                    <p class="card-text">Unit available</p>
                    <p></p>

                @endif
                <div class="text-right">
                    <a href="/units/{{$unit->id}}"><button type="button" class="btn btn-info logding-details-btn">View Details</button></a>
                </div>
            </div>
        </div>
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
 