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
                <a class="nav-link active" href="/glamping">Glamping</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/transient-backpacker">Transient Backpacker</a>
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
            @if($unit->unitType == 'tent')            
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$unit->unitNumber}}</h5>
                    
                    @if($unit->status == 'occupied')
                    <p class="card-text">{{$unit->firstName}} {{$unit->lastName}}</p>
                    <p class="card-text">{{$unit->unitID}}</p>

                    @else
                    <p class="card-text">Guest Name</p>
                    <p class="card-text">Guest ID</p>

                    @endif

                    <div class="text-right">
                    <!--a href="/units/{{--$unit->id--}}"-->
                    <button type="button" class="btn btn-info logding-details-btn load-details"
                    data-toggle="modal" data-target="#view-details" id="{{$unit->unitID}}">View Details</button>
                    <!--/a-->

                    <!--button type="button" class="btn btn-warning getRequest"
                    id="{{--$unit->unitID--}}"">getRequest</button-->

                    </div>
                </div>
            </div>
            @endif
        @endforeach
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
            <div class="modal-body">
                <p class="text-center">
                    Hello
                </p>
            </div>
            <!--Footer-->
            <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-info">Edit</button>
                <button type="button" class="btn btn-danger">Check-out</button>
            </div>
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
        <script src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('.load-details').click(function(){
                //alert($(this).text());
                jQuery.get('loadDetails/'+$(this).attr('id'), function(data){
                    console.log(data[0].lastName);
                })
            });
        }); 
        </script>
    @else
        <p>No units found</p>
    @endif
@endsection
 