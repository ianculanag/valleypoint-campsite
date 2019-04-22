@extends('layouts.app')
@section('content')
    <div class="container pt-3 pb-5">

        <div class="container row">
            <h4 class="pt-2"> Users </h4> 
            <a class="btn btn-sm btn-success my-2 mx-3 " href="/add-user">Add user</a>
        </div>
        <div class="row px-2">
            <a style="cursor:pointer" class="user-management-card" id="adminCard">       
                <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url({{--asset('')--}}); background-size:cover; background-repeat:no-repeat;">
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
                <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url({{--asset('')--}}); background-size:cover; background-repeat:no-repeat;">
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
        </div>

        <div class="container row">
            <h4 class="pt-2"> Units </h4>
            <a class="btn btn-sm btn-success my-2 mx-3 " href="/add-unit">Add unit</a>
        </div>
        <div class="row px-2">
            <a style="cursor:pointer" class="lodging-units-card" id="tentCard">       
                <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url({{--asset('tent.png')--}}); background-size:cover; background-repeat:no-repeat;">
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
                <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url({{--asset('')--}}); background-size:cover; background-repeat:no-repeat;">
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
        </div>

        <div class="container row">
            <h4 class="pt-2"> Services </h4>
            <a class="btn btn-sm btn-success my-2 mx-3 " href="/add-service">Add service</a>
        </div>
        <div class="row px-2">
            <a style="cursor:pointer" class="services-card" id="packageCard">       
                <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url({{--asset('')--}}); background-size:cover; background-repeat:no-repeat;">
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
                <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url({{--asset('')--}}); background-size:cover; background-repeat:no-repeat;">
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
                <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url({{--asset('')--}}); background-size:cover; background-repeat:no-repeat;">
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
                <div class="card mx-2" style="width:14rem; height:7.5em; background-image:url({{--asset('')--}}); background-size:cover; background-repeat:no-repeat;">
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
        </div>
    </div>
@endsection