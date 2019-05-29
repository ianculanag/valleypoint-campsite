@extends('layouts.app')
@section('content')
<div class="container-fluid p-0 m-0">
    <div class="container mx-2 px-5">
        <h3 class="px-4 pt-3">Welcome, {{ Auth::user()->name }}!</h3>
    </div>
    <div class="container row pt-3 pb-4 mx-3 px-5">
        <div class="container col-md-6 px-3">
            <div class="container row">
                <h4 class="pt-2"> Users </h4> 
                <a class="btn btn-sm btn-success my-2 mx-3 " href="/add-user">Add user</a>
            </div>
            <ul class="list-group pb-3">
                <li class="list-group-item">
                    <a href="/view-users" style="cursor:pointer; color:inherit; text-decoration:none !important;">
                        <span style="float:left">
                            <img src={{asset('admin.png')}} style="height:5em;" aria-hidden="true"></img>
                        </span>
                        <h6 class="pt-3 mb-0 px-3 text-right"> Administrator </h6>
                        @php
                            $adminCount = 0;
                        @endphp
                        @foreach ($admin as $admins)
                            @php
                                $adminCount++;
                            @endphp
                        @endforeach
                        <h3 class="px-3 text-right" style="color:lightseagreen;">{{$adminCount}}</h3>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="/view-users" style="cursor:pointer; color:inherit; text-decoration:none !important;">
                        <span style="float:left">
                            <img src={{asset('lodging-manager.png')}} style="height:5em;" aria-hidden="true"></img>
                        </span>
                        <h6 class="pt-3 mb-0 px-3 text-right"> Lodging Manager </h6>
                        @php
                            $lodgingCount = 0;
                        @endphp
                        @foreach ($lodging as $lodgingManager)
                            @php
                                $lodgingCount++;
                            @endphp
                        @endforeach
                        <h3 class="px-3 text-right" style="color:lightseagreen;">{{$lodgingCount}}</h3>    
                    </a>
                </li>
            </ul>
            {{--<div class="row px-2">
                <a style="cursor:pointer" class="user-management-card" id="adminCard">       
                    <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url({{asset('admin.png')}}); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">
                                Administrator
                            </h5>
                            @php
                                $adminCount = 0;
                            @endphp
                            @foreach ($admin as $admins)
                                @php
                                    $adminCount++;
                                @endphp
                            @endforeach
                            <h3 class="mt-3" style="color:lightseagreen;">{{$adminCount}}</h3>
                        </div>
                    </div>
                </a>
                <a style="cursor:pointer" class="user-management-card" id="lodgingManagerCard">       
                    <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url(); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">
                                Lodging Manager
                            </h5>
                            @php
                                $lodgingCount = 0;
                            @endphp
                            @foreach ($lodging as $lodgingManager)
                                @php
                                    $lodgingCount++;
                                @endphp
                            @endforeach
                            <h3 class="mt-3" style="color:lightseagreen;">{{$lodgingCount}}</h3>
                        </div>
                    </div>
                </a>
            </div>--}}

            <div class="container row">
                <h4 class="pt-2"> Units </h4>
                <a class="btn btn-sm btn-success my-2 mx-3 " href="/add-unit">Add unit</a>
            </div>
            <ul class="list-group pb-3">
                <li class="list-group-item">
                    <a href="/view-units-tent" style="cursor:pointer; color:inherit; text-decoration:none !important;">
                        <span style="float:left">
                            <img src={{asset('tent-list.png')}} style="height:5em;" aria-hidden="true"></img>
                        </span>
                        <h6 class="pt-3 mb-0 px-3 text-right"> Tents </h6>
                        @php
                            $tentCount = 0;
                        @endphp
                        @foreach ($tents as $tent)
                            @php
                                $tentCount++;
                            @endphp
                        @endforeach
                        <h3 class="px-3 text-right" style="color:lightseagreen;">{{$tentCount}}</h3>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="/view-units-room" style="cursor:pointer; color:inherit; text-decoration:none !important;">
                        <span style="float:left">
                            <img src={{asset('room-list.png')}} style="height:5em;" aria-hidden="true"></img>
                        </span>
                        <h6 class="pt-3 mb-0 px-3 text-right"> Rooms </h6>
                        @php
                            $roomCount = 0;
                        @endphp
                        @foreach ($rooms as $room)
                            @php
                                $roomCount++;
                            @endphp
                        @endforeach
                        <h3 class="px-3 text-right" style="color:lightseagreen;">{{$roomCount}}</h3>
                    </a>
                </li>
            </ul>
            {{--<div class="row px-2">
                <a style="cursor:pointer" class="lodging-units-card" id="tentCard">       
                    <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url(); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">
                                Tents
                            </h5>
                            @php
                                $tentCount = 0;
                            @endphp
                            @foreach ($tents as $tent)
                                @php
                                    $tentCount++;
                                @endphp
                            @endforeach
                            <h3 class="mt-3" style="color:lightseagreen;">{{$tentCount}}</h3>
                        </div>
                    </div>
                </a>
                <a style="cursor:pointer" class="lodging-units-card" id="roomCard">       
                    <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url(); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">
                                Rooms
                            </h5>
                            @php
                                $roomCount = 0;
                            @endphp
                            @foreach ($rooms as $room)
                                @php
                                    $roomCount++;
                                @endphp
                            @endforeach
                            <h3 class="mt-3" style="color:lightseagreen;">{{$roomCount}}</h3>
                        </div>
                    </div>
                </a>
            </div>--}}
        </div>
        <div class="col-md-6 px-3">
            <div class="container row">
                <h4 class="pt-2"> Services </h4>
                <a class="btn btn-sm btn-success my-2 mx-3 " href="/add-service">Add service</a>
            </div>
            <ul class="list-group pb-3">
                <li class="list-group-item">
                    <a href="/view-services-package" style="cursor:pointer; color:inherit; text-decoration:none !important;">
                        <span style="float:left">
                            <img src={{asset('package-list.png')}} style="height:5em;" aria-hidden="true"></img>
                        </span>
                        <h6 class="pt-3 mb-0 px-3 text-right"> Packages </h6>
                        @php
                            $packageCount = 0;
                        @endphp
                        @foreach ($packages as $package)
                            @php
                                $packageCount++;
                            @endphp
                        @endforeach
                        <h3 class="px-3 text-right" style="color:lightseagreen;">{{$packageCount}}</h3>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="/view-services-service" style="cursor:pointer; color:inherit; text-decoration:none !important;">
                        <span style="float:left">
                            <img src={{asset('service-list.png')}} style="height:5em;" aria-hidden="true"></img>
                        </span>
                        <h6 class="pt-3 mb-0 px-3 text-right"> Services </h6>
                        @php
                            $serviceCount = 0;
                        @endphp
                        @foreach ($services as $service)
                            @php
                                $serviceCount++;
                            @endphp
                        @endforeach
                        <h3 class="px-3 text-right" style="color:lightseagreen;">{{$serviceCount}}</h3>
                    </a>
                </li>
            </ul>
            <div class="container row">
                <h4 class="pt-2"> Utilities </h4>
                <a class="btn btn-sm btn-success my-2 mx-3 " href="/add-service">Add service</a>
            </div>
            <ul class="list-group pb-3">
                <li class="list-group-item">
                    <a href="/view-services-extra" style="cursor:pointer; color:inherit; text-decoration:none !important;">
                        <span style="float:left">
                            <img src={{asset('extra-list.png')}} style="height:5em;" aria-hidden="true"></img>
                        </span>
                        <h6 class="pt-3 mb-0 px-3 text-right"> Extra Utilities </h6>
                        @php
                            $extraEquipmentCount = 0;
                        @endphp
                        @foreach ($extra as $extraEquipment)
                            @php
                                $extraEquipmentCount++;
                            @endphp
                        @endforeach
                        <h3 class="px-3 text-right" style="color:lightseagreen;">{{$extraEquipmentCount}}</h3>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="/view-services-damage" style="cursor:pointer; color:inherit; text-decoration:none !important;">
                        <span style="float:left">
                            <img src={{asset('damage-list.png')}} style="height:5em;" aria-hidden="true"></img>
                        </span>
                        <h6 class="pt-3 mb-0 px-3 text-right"> Damage Fees </h6>
                        @php
                            $damagedEquipmentCount = 0;
                        @endphp
                        @foreach ($damage as $damagedEquipment)
                            @php
                                $damagedEquipmentCount++;
                            @endphp
                        @endforeach
                        <h3 class="px-3 text-right" style="color:lightseagreen;">{{$damagedEquipmentCount}}</h3>
                    </a>
                </li>
            </ul>
            {{--<div class="row px-2">
                <a style="cursor:pointer" class="services-card" id="packageCard">       
                    <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url(); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">
                                Packages
                            </h5>
                            @php
                                $packageCount = 0;
                            @endphp
                            @foreach ($packages as $package)
                                @php
                                    $packageCount++;
                                @endphp
                            @endforeach
                            <h3 class="mt-3" style="color:lightseagreen;">{{$packageCount}}</h3>
                        </div>
                    </div>
                </a>
                <a style="cursor:pointer" class="services-card" id="serviceCard">       
                    <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url(); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">
                                Services
                            </h5>
                            @php
                                $serviceCount = 0;
                            @endphp
                            @foreach ($services as $service)
                                @php
                                    $serviceCount++;
                                @endphp
                            @endforeach
                            <h3 class="mt-3" style="color:lightseagreen;">{{$serviceCount}}</h3>
                        </div>
                    </div>
                </a>
                <a style="cursor:pointer" class="extra-equipments-card" id="extraEquipmentCard">       
                    <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url(); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">
                                Extra Equipment
                            </h5>
                            @php
                                $extraEquipmentCount = 0;
                            @endphp
                            @foreach ($extra as $extraEquipment)
                                @php
                                    $extraEquipmentCount++;
                                @endphp
                            @endforeach
                            <h3 class="mt-3" style="color:lightseagreen;">{{$extraEquipmentCount}}</h3>
                        </div>
                    </div>
                </a>
                <a style="cursor:pointer" class="damages-card" id="damageCard">       
                    <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url(); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">
                                Damage
                            </h5>
                            @php
                                $damagedEquipmentCount = 0;
                            @endphp
                            @foreach ($damage as $damagedEquipment)
                                @php
                                    $damagedEquipmentCount++;
                                @endphp
                            @endforeach
                            <h3 class="mt-3" style="color:lightseagreen;">{{$damagedEquipmentCount}}</h3>
                        </div>
                    </div>
                </a>
            </div>--}}
        </div>
    </div>
</div>
@endsection