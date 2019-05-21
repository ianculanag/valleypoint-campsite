@extends('layouts.app')

@section('content')
    {{-- Table View v1 by Kaye & Ervin --}}
    
    {{--<div class="col-md-12 text-center lodging-tabs mx-1">
        <nav class="nav nav-pills centered-pills py-2">
            <a class="nav-item nav-link" style="color:#505050" href="/create-order">Create Order</a>
            <a class="nav-item nav-link" style="color:#505050" href="/view-order-slips">Order Slips</a>
            <a class="nav-item nav-link active" style="background-color:#060f0ed4;" href="#">View Tables</a>
        </nav>
    </div>
    <div class="container-fluid col-md-12 px-4 pb-5 pt-3">
        <div class="container">
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
        </div>
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
    </div>--}}

    {{-- Table View v2 Dawn --}}
    <div class="col-md-12 text-center lodging-tabs mx-1">
        <nav class="nav nav-pills centered-pills py-2">
            <a class="nav-item nav-link" style="color:#505050" href="/create-order">Create Order</a>
            <a class="nav-item nav-link" style="color:#505050" href="/view-order-slips">Order Slips</a>
            <a class="nav-item nav-link active" style="background-color:#060f0ed4;" href="#">View Tables</a>
        </nav>
    </div>
    <div class="container-fluid row col-md-12 px-5 pt-3 mx-0">
        <div class="col-md-7 scrollbar-near-moon" style="max-height:74vh; overflow-y:auto;">
            <div class="row">
                @for($index = 1; $index <=12; $index++) 
                <a class="restaurant-tables" style="cursor:pointer">
                    <div class="card mx-2 restaurant-tables" id="{{$index}}" style="width:12.5rem; height:7em; background-image:url({{asset('')}}); background-size:cover; background-repeat:no-repeat;">
                        <div class="card-body">
                            <h5 class="card-title">Table {{$index}}
                            <span class="badge badge-success float-right badgeStatus" style="font-size:.55em;" id="badge{{$index}}">Available</span>
                            </h5>
                        </div>
                    </div> 
                </a>
                @endfor 
            </div>
        </div>
        <div class="col-md-5" id="tableOrders">
            <div class="mx-0 mt-2 pl-4">
                <div class="card p-0 m-0" style="min-height:70vh; max-height:70vh;">
                    <div class="row pt-2 pb-1 px-3">
                        <div class="col-md-6">
                            <div class="form-group my-1 row">
                                <label class="col-sm-6 pr-0 mr-0 pt-1" for="tableNumber">Table No:</label>
                                <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                    <input class="form-control" type="number" name="tableNumber" id="orderTableNumber" min="1" max="30" placeholder="" value="{{--$tables->id--}}" disabled>
                                </div>                                    
                                <span class="col-sm-1 input-group-addon px-2 mx-0" onclick="">
                                    <i class="fa fa-pencil-alt" style="color:#3b3f44 !important;"></i>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-1 row">
                                <label class="col-sm-6 pr-0 mr-0 pt-1" for="queueNumber">Queue:</label>
                                <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                    <input class="form-control" type="number" name="queueNumber" id="orderQueueNumber" min="1" max="50" placeholder="" value="{{--$order->queueNumber--}}" disabled>
                                </div>                                  
                                <span class="col-sm-1 input-group-addon px-2 mx-0" onclick="">
                                    <i class="fa fa-pencil-alt" style="color:#3b3f44 !important;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 m-0 scrollbar-near-moon" style="overflow-y:auto;">
                        <table class="table table-striped mb-0" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-2" style="width:40%;">Description</th>
                                    <th scope="col" class="py-2">Qty.</th>
                                    <th scope="col" class="py-2">Price</th>
                                    <th scope="col" class="py-2">Total</th>
                                    <th scope="col" class="py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody id="orderSlip">
                                {{--@php 
                                   $grandTotal = 0; 
                                @endphp

                                @foreach ($items[$loop->index] as $item)

                                @php 
                                   $grandTotal += $item->totalPrice; 
                                @endphp--}}

                                <tr>
                                    <td class="py-2">{{--$item->productName--}}</td>
                                    <td class="py-2">{{--$item->quantity--}}</td>
                                    <td class="py-2">{{--number_format((float)($item->price), 2, '.', '')--}}</td>
                                    <td class="py-2">{{--number_format((float)($item->totalPrice), 2, '.', '')--}}</td>
                                    <td class="py-2"></td>
                                </tr>
                                {{--@endforeach--}}
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 px-0 mx-0">
                        <table class="table table-striped" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th colspan="3" scope="row" class="py-2">TOTAL:</th>
                                    <th id="ordersGrandTotal" style="text-align:right;" class="py-2">₱{{--number_format((float)($grandTotal), 2, '.', '')--}}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" scope="row" class="py-2">Tendered:</th>
                                    <th id="tenderedCash" style="text-align:right;" class="py-2">₱0.00</th>
                                </tr>
                                <tr>
                                    <th colspan="3" scope="row" class="py-2">Change:</th>
                                    <th id="changeDue" style="text-align:right;" class="py-2">₱0.00</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="row mx-1">
                            <div class="col-md-6 px-1">
                                <button type="button" class="btn btn-primary btn-block" style="text-align:center;">
                                    Add Order
                                </button>
                            </div>
                            <div class="col-md-6 px-1">
                                <button type="button" class="btn btn-success btn-block" style="text-align:center;">
                                    Bill Out
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
