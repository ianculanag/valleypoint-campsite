@extends('layouts.app')

@section('content')
<h1>Point-of-Sales</h1>
<div class="container-fluid col-md-9 mx-1 pb-5 pt-1">
    <div class="row">
        <div class="container lodging-tabs">
            <ul class="nav nav-tabs pt-0" style="width:93%" >
                <li class="nav-item">
                    <a class="nav-link active" href="">View Tables</a>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#505050"; href="/MakeOrder">New order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#505050"; href="/CashierShiftReport">View Sales</a>
                    </li>
                </li>
            </ul>
        </div>
        <div class="container-center" style="float:left;">
            <div class="row">
              <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="load-restaurant-details" id=>
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; margin-left: 5em; background-image:url({{asset('table.png')}});">
                    <div class="card-body">
                        <h5 class="card-title">Table 1
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                     </div>
                </div>  </a>

                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 2
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                    </div>
                </div> </a>

                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 3
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                       </div>
                </div> </a>

                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; margin-left: 5em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 4
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                        </div>
                </div> </a>
                
                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 5
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                       </div>
                </div> </a>

                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 6
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                        </div>
                </div></a>

                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; margin-left: 5em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 7 
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                        </div>
                </div> </a>

                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 8
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                        </div>
                </div></a>

                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 9
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                        </div>
                </div></a>

                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; margin-left: 5em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 10
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                        </div>
                </div></a>

                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 11
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                       </div>
                </div></a>

                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">
                <div class="card" style="width: 16rem; height: 8em; margin: 1em; background-image:url({{asset('table.png')}})">
                    <div class="card-body">
                        <h5 class="card-title">Table 12
                            <span class="badge badge-success float-right" style="font-size:.55em;">Available</span>
                        </h5>
                        <p class="card-text">Status: </p>
                        <p class="card-text">Amount: </p>
                     </div>
                </div></a>
@endsection
