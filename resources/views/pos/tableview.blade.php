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
            <a class="nav-item nav-link" style="color:#505050; cursor:pointer;" href="/create-order">Create Order</a>
            <a class="nav-item nav-link" style="color:#505050; cursor:pointer;" href="/view-order-slips">Order Slips</a>
            <a class="nav-item nav-link active" style="background-color:#060f0ed4;" href="#">View Tables</a>
        </nav>
    </div>
    <div class="container-fluid row col-md-12 px-5 pt-3 mx-0">
        <div class="col-md-7 scrollbar-near-moon" style="max-height:74vh; overflow-y:auto;">
            <div class="row" id="restaurantTableRow">
                @foreach ($tables as $table)
                
                <a style="cursor:pointer">
                    @if($table->status == 'available') 
                    <div class="card mx-2 restaurant-available-tables" id="{{$table->id}}" style="width:12.5rem; height:7em; background-image:url({{asset('')}}); background-size:cover; background-repeat:no-repeat;">
                    @elseif($table->status == 'occupied')
                    <div class="card mx-2 restaurant-occupied-tables" id="{{$table->id}}" style="width:12.5rem; height:7em; background-image:url({{asset('')}}); background-size:cover; background-repeat:no-repeat;">
                    @endif
                        <div class="card-body">
                            @if($table->status == 'available') 
                            <h5 class="card-title"> 
                                {{$table->tableNumber}}
                                <span class="badge badge-info float-right badgeStatus" style="font-size:.55em;">Available</span>
                            </h5>
                            @elseif($table->status == 'occupied')
                            <h5 class="card-title"> 
                                {{$table->tableNumber}}
                                <span class="badge badge-dark float-right badgeStatus" style="font-size:.55em;">Occupied</span>
                            </h5>
                            <p class="card-text pt-3"> 
                                Total bill: 
                                <span class="float-right"> ₱{{number_format($table->totalBill, 2)}} </span>
                            </p>
                            @endif
                        </div>
                    </div> 
                </a>
                @endforeach 
            </div>
        </div>
        <div class="col-md-5" id="tableOrders">
            <meta name="csrf-token" content="{{ Session::token() }}"> 
            <div class="mx-0 mt-2 pl-4">
                <div class="card p-0 m-0" style="min-height:70vh; max-height:70vh;">
                    <div class="row pt-2 pb-1 px-3">
                        <div class="col-md-6">
                            <div class="form-group my-1 row">
                                <label class="col-sm-5 pr-0 mr-0 pt-1" for="tableNumber">Table:</label>
                                <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                    <input class="form-control" type="number" name="orderTableNumber" id="orderTableNumber" min="1" max="30" placeholder="" value="{{$firstTable->id}}" disabled>
                                    <input class="form-control" type="number" name="oldTableNumber" id="oldTableNumber" value="{{$firstTable->id}}" style="display:none">
                                </div>        
                                @if(count($items) > 0)                            
                                <span id="editTableNumber" class="col-sm-2 input-group-addon hidden-elements px-3 mx-0" style="cursor:pointer">
                                    <i id="editTable" class="fa fa-pencil-alt" style="color:#3b3f44 !important;"></i>
                                </span>
                                @else                                
                                <span id="editTableNumber" class="col-sm-2 input-group-addon hidden-elements px-3 mx-0" style="display:none; cursor:pointer;">
                                    <i id="editTable" class="fa fa-pencil-alt" style="color:#3b3f44 !important;"></i>
                                </span>
                                @endif
                            </div>
                        </div>
                        @if(count($items) > 0)
                        <div class="hidden-elements col-md-6">
                        @else
                        <div class="hidden-elements col-md-6" style="display:none;">
                        @endif
                            <div class="form-group my-1 row">
                                <label class="col-sm-5 pr-0 mr-0 pt-1" for="queueNumber">Queue:</label>
                                <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                @if(isset($orderQueueNumber))
                                    <input class="form-control" type="number" name="orderQueueNumber" id="orderQueueNumber" min="1" max="50" placeholder="" value="{{$orderQueueNumber}}" disabled>
                                @else
                                    <input class="form-control" type="number" name="orderQueueNumber" id="orderQueueNumber" min="1" max="50" placeholder="" value="" disabled>  
                                @endif
                                </div>                                  
                                <span id="editQueueNumber" class="col-sm-2 input-group-addon px-3 mx-0" style="cursor:pointer">
                                    <i id="editQueue" class="fa fa-pencil-alt" style="color:#3b3f44 !important;"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0 m-0 scrollbar-near-moon" style="overflow-y:auto;">
                        <table class="table table-striped mb-0" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th scope="col" class="py-2" style="width:45%;">Description</th>
                                    <th scope="col" class="py-2">Qty.</th>
                                    <th scope="col" class="py-2">Price</th>
                                    <th scope="col" class="py-2">Total</th>
                                    <th scope="col" class="py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody id="orderSlip">
                                @php 
                                    $subTotal = 0; 
                                @endphp
                                @if(count($items) > 0)
                                    @foreach ($items as $item)
                                    <tr>
                                        <td class="py-2">{{$item->productName}}</td>
                                        <td class="text-right py-2">{{$item->quantity}}</td>
                                        @php 
                                            $subTotal += $item->totalPrice;

                                            $unitPrice = $item->totalPrice/$item->quantity;
                                        @endphp
                                        <td class="text-right py-2">{{number_format($unitPrice, 2)}}</td>
                                        <td class="text-right py-2 orderItemPrice">{{number_format($item->totalPrice, 2)}}</td>
                                        <td class="py-2">{{$item->paymentStatus}}</td>
                                    </tr>
                                    <input class="form-control" type="number" id="orderID" name="orderID" value="{{$item->orderID}}" style="display:none;">
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="py-2 text-center" colspan="5"> No order items to show </td> 
                                    </tr>
                                    <input class="form-control" type="number" id="orderID" name="orderID" value="" style="display:none;">
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 px-0 mx-0">
                        <table class="table table-striped" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">Subtotal:</th>
                                    <td class="py-2" id="ordersSubtotal" style="text-align:right;">
                                        ₱&nbsp;{{number_format($subTotal, 2)}}
                                    </td>
                                </tr>
                                <tr  class="text-primary">
                                    <th class="py-2" colspan="3" scope="row">Discount:</th>
                                    <td class="py-2" id="ordersDiscount" style="text-align:right;">
                                    @if(count($items) > 0)
                                        ₱&nbsp;{{number_format($item->discountAmount, 2)}}
                                    @else
                                        ₱&nbsp;0.00
                                    @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">TOTAL:</th>
                                    <th class="py-2" id="ordersGrandTotal" style="text-align:right;">
                                    @if(count($items) > 0)
                                        ₱&nbsp;{{number_format($item->totalBill, 2)}}
                                    @else
                                        ₱&nbsp;0.00
                                    @endif
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="row mx-1" id="orderSlipButtons">
                            @if(count($items) > 0)
                            <div class="col-md-6 px-1">
                                <a href="/add-order/{{$items[0]->orderID}}" style="text-decoration:none">
                                    <button type="button" class="btn btn-primary btn-block" id="addOrder" style="text-align:center;">
                                        Add Order
                                    </button>
                                </a>
                            </div>
                            @else
                            <div class="col-md-6 px-1">                                
                                <a href="/create-order/" style="text-decoration:none">
                                    <button type="button" class="btn btn-primary btn-block" id="addOrder" style="text-align:center;">
                                        Add Order
                                    </button>
                                </a>
                            </div>
                            @endif
                            @if(count($items) > 0)
                            <div class="col-md-6 px-1">
                                <a href="/bill-out/{{$items[0]->orderID}}" style="text-decoration:none">
                                    <button type="button" class="btn btn-success btn-block" id="billOut" style="text-align:center;">
                                        Bill Out
                                    </button>
                                </a>
                            </div>
                            @else
                            <div class="col-md-6 px-1">
                                <button type="button" class="btn btn-success btn-block" id="billOut" style="text-align:center;" disabled>
                                    Bill Out
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
