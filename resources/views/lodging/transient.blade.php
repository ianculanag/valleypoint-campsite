@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center lodging-tabs pb-0">
        <nav class="nav nav-pills centered-pills">
            <a class="nav-item nav-link active" style="background-color:#505050" href="#">Physical View</a>
            <a class="nav-item nav-link" style="color:#505050" href="#">Calendar View</a>
        </nav>
    </div>
    <div class="container" style="position:absolute;">
        <form style="float:right; padding-right:3em;">
            <div class="form-group row mb-0">
                <label for="staticEmail" class="col-md-5 col-form-label" style="padding-left:0; padding-right:.5;">Sort by:</label>
                <div class="col-md-7 p-0" style="width:8em;;">
                    <select class="form-control" style="padding-left:1">
                        <option>Capacity</option>
                        <option>Status</option>
                        <option>Guest</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
    <div class="container lodging-tabs">
        <ul class="nav nav-tabs w-100 pt-0">
            <li class="nav-item">
                <a class="nav-link" style="color:#505050;" href="/glamping/">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/transient-backpacker">Backpacker</a>
            </li>
        </ul>
    </div>
    
    @if(count($units) > 0)
    <div class="container">
        <div class="container">
            <h5 class="unit-heading">4 pax</h5> 
                <div class="row"> 
        
        @foreach($units as $unit)   
            @if($unit->unitType == 'room' && $unit->capacity == 4)                                       
                @if($unit->status == 'occupied') 
                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-details" id={{$unit->unitID}}>
                    <div class="card" style="width: 18rem;height:7.5em;">
                        <div class="card-body">
                <h5 class="card-title">
                    {{$unit->unitNumber}}
                    <span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>
                </h5> 
                <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                <p class="card-text" style="color:green; font-style:italic;"> {{$unit->numberOfPax}} out of {{$unit->capacity}} occupied</p>

                {{--@elseif($unit->status == 'reserved')
                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-details" id={{$unit->unitID}}>
                    <div class="card" style="width: 18rem;height:7.5em;">
                        <div class="card-body">
                <h5 class="card-title">
                    {{$unit->unitNumber}}
                    <span class="badge badge-secondary float-right" style="font-size:.55em;">Reserved</span>
                </h5>
                <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                <p class="card-text" style="color:green; font-style:italic;"> {{$unit->numberOfPax}} out of {{$unit->capacity}} reserved</p>
                --}}
                @else
                <a data-toggle="modal" data-target="#checkin-reserve" style="cursor:pointer; text-decoration:none !important" class="load-unit" id={{$unit->unitID}}>   
                    
                    <div class="card" style="width: 18rem;height:7.5em;">
                        <div class="card-body">
                <h5 class="card-title">
                    {{$unit->unitNumber}}
                    <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                </h5>
                <p class="card-text" style="color:lightseagreen; font-style:italic;"> 0 out of {{$unit->capacity}} occupied</p>
                <p></p>

                @endif
                </div>
            </div>
            </a>
            @endif
        @endforeach
        </div>
    </div>

    <div class="container">
        <h5 class="unit-heading">6 pax</h5> 
            <div class="row"> 
        @foreach($units as $unit)   
            @if($unit->unitType == 'room' && $unit->capacity == 6)                               
                @if($unit->status == 'occupied') 
                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-details" id={{$unit->unitID}}>        
                <div class="card" style="width: 18rem;height:7.5em;">
                    <div class="card-body">
                
                <h5 class="card-title">
                    {{$unit->unitNumber}}
                    <span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>
                </h5>
                <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                <p class="card-text" style="color:green; font-style:italic;"> {{$unit->numberOfPax}} out of {{$unit->capacity}} occupied</p>

                {{--@elseif($unit->status == 'reserved')
                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-details" id={{$unit->unitID}}>        
                <div class="card" style="width: 18rem;height:7.5em;">
                    <div class="card-body">
                <h5 class="card-title">
                    {{$unit->unitNumber}}
                    <span class="badge badge-secondary float-right" style="font-size:.55em;">Reserved</span>
                </h5>
                <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                <p class="card-text" style="color:green; font-style:italic;"> {{$unit->numberOfPax}} out of {{$unit->capacity}} reserved</p>
                --}}
                @else
                <a data-toggle="modal" data-target="#checkin-reserve" style="cursor:pointer; text-decoration:none !important" class="load-unit" id={{$unit->unitID}}>   
                    <div class="card" style="width: 18rem;height:7.5em;">
                        <div class="card-body">
                <h5 class="card-title">
                    {{$unit->unitNumber}}
                    <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                </h5>
                <p class="card-text" style="color:lightseagreen; font-style:italic;"> 0 out of {{$unit->capacity}} occupied</p>
                <p></p>

                @endif
                </div>
            </div>
            </a>
            @endif
        @endforeach
        </div>
    </div>

    <div class="container">
        <h5 class="unit-heading">10 pax</h5> 
            <div class="row"> 
        @foreach($units as $unit)   
            @if($unit->unitType == 'room' && $unit->capacity == 10)
                            
                @if($unit->status == 'occupied')  
                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-details" id={{$unit->unitID}}>          
                <div class="card" style="width: 18rem;height:7.5em;">
                    <div class="card-body">
                <h5 class="card-title">
                    {{$unit->unitNumber}}
                    <span class="badge badge-dark float-right" style="font-size:.55em;">Occupied</span>
                </h5>
                <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                <p class="card-text" style="color:green; font-style:italic;"> {{$unit->numberOfPax}} out of {{$unit->capacity}} occupied</p>

                {{--@elseif($unit->status == 'reserved') 
                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-details" id={{$unit->unitID}}>          
                <div class="card" style="width: 18rem;height:7.5em;">
                    <div class="card-body">
                <h5 class="card-title">
                    {{$unit->unitNumber}}
                    <span class="badge badge-secondary float-right" style="font-size:.55em;">Reserved</span>
                </h5>
                <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                <p class="card-text" style="color:green; font-style:italic;"> {{$unit->numberOfPax}} out of {{$unit->capacity}} reserved</p>
                --}}
                @else
                <a data-toggle="modal" data-target="#checkin-reserve" style="cursor:pointer; text-decoration:none !important" class="load-unit" id={{$unit->unitID}}>   
                    <div class="card" style="width: 18rem;height:7.5em;">
                        <div class="card-body">
                <h5 class="card-title">
                    {{$unit->unitNumber}}
                    <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                </h5>
                <p class="card-text" style="color:lightseagreen; font-style:italic;"> 0 out of {{$unit->capacity}} occupied</p>
                <p></p>

                @endif
                </div>
            </div>
            </a>
            @endif
        @endforeach
        @else
            <div class="container" style="padding-top:1em; padding-left:2em;">
                <p>No units found</p>
            </div>
        @endif
            </div>
        </div>
    </div>

<!-- Details Modal -->
<div class="modal fade right" id="view-details" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
            <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <!--p class="heading lead">Tent 1</p-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="white-text">×</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body" id="modal-body">
            </div>
            <!--Footer-->
            <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-info">Edit</button>
                <button type="button" class="btn btn-danger">Check-out</button>
            </div>
        </div>
    </div>
</div>
<!-- Check-in or reserve modal -->
    <div class="modal fade right" id="checkin-reserve" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">×</span>
                    </button>
                </div>
                <!--Body-->
                <div class="modal-body" id="modal-body">
                    <div class="col-md-12">
                        <h5 class="text-center mb-4">Choose action:</h5>
                        <div style="width:80%; padding-left:20%;">
                            <a href="" id="checkin">
                                <button type="button" class="btn btn-primary btn-md btn-block mb-2">Check-in</button>
                            </a>
                            <a href="" id="reserve">
                                <button type="button" class="btn btn-secondary btn-md btn-block mb-2">Reserve</button>
                            </a>
                        </div>
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer justify-content-right">
                </div>
            </div>
        </div>
    </div>
@endsection
 