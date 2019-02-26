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
                <a class="nav-link" style="color:#505050;" href="/glamping/">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/transient-backpacker">Transient Backpacker</a>
            </li>
        </ul>
    </div>
    
    @if(count($units) > 0)
    <div class="container" style="padding-top: 1em;">
        <div class="container">
        
        @foreach($units as $unit)
            
            @if($unit->unitType == 'room')

                @if($unit->capacity == 4)  
                <h5 class="unit-heading">4 pax</h5>
                <div class="row">         
                    <div class="card" style="width: 18rem;">
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
                </div>

                @elseif($unit->capacity == 6)   
                <h5 class="unit-heading">6 pax</h5>
                <div class="row">         
                    <div class="card" style="width: 18rem;">
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
                </div>

                @elseif($unit->capacity == 10)   
                <h5 class="unit-heading">10 pax</h5>
                <div class="row">         
                    <div class="card" style="width: 18rem;">
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
                </div>
                @endif
            @endif
            </div>
        @endforeach
        </div>
    @else
        <p>No units found</p>
    @endif
@endsection
 