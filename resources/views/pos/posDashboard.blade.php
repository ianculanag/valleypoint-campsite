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
                        <a class="nav-link" style="color:#505050"; href="/make-order">New order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color:#505050"; href="/cashier-shift-report">View Sales</a>
                    </li>
                </li>
            </ul>
        </div>

        <div class="container-center">
            <div class="row">
                @for($index = 1; $index <=12; $index++) 
                <a data-toggle="modal" data-target="#exampleModal" style="cursor:pointer">
                    <div class="card mx-2 restaurant-tables" id="table{{$index}}" style="width:16rem; height:7.5em; background-image:url({{asset('table.png')}}); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">Table {{$index}}
                            <span class="badge badge-success float-right badgeStatus" style="font-size:.55em;" id="badge{{$index}}">Available</span>
                            </h5>
                            <p class="card-text">Status: </p>
                            <p class="card-text">Amount: </p>
                         </div>
                    </div> 
                </a>
                @endfor 
                </div>

         <!-- Modal -->
    <div class="dynamicModal">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Table #{{$index}}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    <strong>Table status:</strong> Available<br>
                    <strong>Capacity:</strong> 4pax    
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary">Occupy</button>
                    </div>
                  </div>
                </div>
              </div>
              </div>
@endsection
