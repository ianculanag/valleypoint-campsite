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
                    <!--a href="/units/{{--$unit->id--}}"-->
                    <button type="button" class="btn btn-info logding-details-btn load-details"
                    data-toggle="modal" data-target="#view-details" id={{$unit->unitID}}>View Details</button>
                    <!--/a-->
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
                jQuery.get('loadDetails/'+$(this).attr('id'), function(data){
                    console.log(data);
                    /*<div class="container">
                        <p>
                            Tent ID: 00001
                        </p>
                        <p>
                            Tent number: 1
                        </p>
                        <p>
                            Capacity: 4 pax
                        </p>
                    </div>
                    <hr>
                    <h5 class="text-center">
                        Guest Details
                    </h5>
                    <div class="container">
                        <p>
                            Guest ID: 00001
                        </p>
                        <p>
                            Guest name: Dawn Cundangan
                        </p>
                        <p>
                            Contact number: 09000000000
                        </p>
                        <p>
                            Number of pax: 2 pax
                        </p>
                        <p style="font-style: italic; color: green;">
                            Checked-in *date* at *time*
                        </p>
                    </div>*/
                    let modal = document.getElementById('modal-body');
                    modal.innerHTML = ""

                    let hr = document.createElement('HR');

                    let tentH5 =  document.createElement('H5');
                    tentH5.classList.add('text-center');
                    let tentH5Body = document.createTextNode('Tent Details');
                    tentH5.appendChild(tentH5Body);
                    
                    //first div
                    let firstDiv = document.createElement('DIV');
                    firstDiv.classList.add('container');
                    
                    //repeat all inside container
                    let tentID = document.createElement('P');
                    let tentIDLabel = 'Tent ID: ';
                    let tentIDBody = document.createTextNode(tentIDLabel+data[0].unitID);
                    tentID.appendChild(tentIDBody);

                    //repeat all inside container
                    let tentNumber = document.createElement('P');
                    let tentNumberLabel = 'Tent number: ';
                    let tentNumberBody = document.createTextNode(tentNumberLabel+data[0].unitNumber);
                    tentNumber.appendChild(tentNumberBody);

                    //repeat all inside container
                    let capacity = document.createElement('P');
                    let capacityLabel = 'Tent number: ';
                    let capacityBody = document.createTextNode(capacityLabel+data[0].capacity);
                    capacity.appendChild(capacityBody);

                    firstDiv.appendChild(tentH5);
                    firstDiv.appendChild(tentID);
                    firstDiv.appendChild(tentNumber);
                    firstDiv.appendChild(capacity);
                    firstDiv.appendChild(hr);

                     //second div
                    let secondDiv = document.createElement('DIV');
                    secondDiv.classList.add('container');

                    let guestH5 =  document.createElement('H5');
                    guestH5.classList.add('text-center');
                    let guestH5Body = document.createTextNode('Guest Details');
                    guestH5.appendChild(guestH5Body);
                    
                    //repeat all inside container
                    let guestID = document.createElement('P');
                    let guestIDLabel = 'Guest ID: ';
                    let guestIDBody = document.createTextNode(guestIDLabel+data[0].id);
                    guestID.appendChild(guestIDBody);

                    //repeat all inside container
                    let guestName = document.createElement('P');
                    let guestNameLabel = 'Guest name: ';
                    let guestNameBody = document.createTextNode(guestNameLabel+data[0].firstName);
                    guestName.appendChild(guestNameBody);

                    //repeat all inside container
                    let contactNumber = document.createElement('P');
                    let contactNumberLabel = 'Contact number: ';
                    let contactNumberBody = document.createTextNode(contactNumberLabel+data[0].contactNumber);
                    contactNumber.appendChild(contactNumberBody);
                    
                    //repeat all inside container
                    let pax = document.createElement('P');
                    let paxLabel = 'Number of Pax: ';
                    let paxBody = document.createTextNode(paxLabel+data[0].numberOfPax);
                    pax.appendChild(paxBody);

                    //repeat all inside container
                    let checkIn = document.createElement('P');
                    //checkIn.style(color.green);
                    let checkInLabel = 'Checked in on ';
                    let checkInBody = document.createTextNode(checkInLabel+data[0].checkinDatetime);
                    checkIn.appendChild(checkInBody);


                    secondDiv.appendChild(guestH5);
                    secondDiv.appendChild(guestID);
                    secondDiv.appendChild(guestName);
                    secondDiv.appendChild(contactNumber);
                    secondDiv.appendChild(pax);
                    secondDiv.appendChild(checkIn);
                    
                    modal.appendChild(firstDiv);
                    modal.appendChild(secondDiv);
                    //append everything

                })
            });
        }); 
        </script>
    @else
        <p>No units found</p>
    @endif
@endsection
 