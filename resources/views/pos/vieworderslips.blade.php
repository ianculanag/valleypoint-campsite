@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center pos-tabs">
        <nav class="nav nav-pills centered-pills py-2">
            <a class="nav-item nav-link" style="color:#505050; cursor:pointer;" href="/create-order">Create Order</a>
            <a class="nav-item nav-link active" style="background-color:#060f0ed4; cursor:pointer;" href="#">Order Slips</a>
            <a class="nav-item nav-link" style="color:#505050; cursor:pointer;" href="/view-tables">View Tables</a>
        </nav>
    </div>
    <div class="row pb-2 px-5">
        <div class="col-md-9">
            <h6>Order count: {{count($items)}}</h6>
        </div>
        <div class="col-md-3">
            <div class="form-group my-0 row">
                <label class="col-sm-4 pr-0 mr-0 pt-1" for="searchOrder">Search</label>
                <div class="input-group input-group-sm col-sm-8 pl-0 pr-4 mx-0">
                    <input class="form-control" type="text" name="searchOrder" id="searchOrder" minlength="1" maxlength="20" placeholder="" value="">
                </div>
            </div>
        </div>  
    </div>
    <div class="container-fluid col-md-12 pb-2 pt-0 px-5 scrollbar-near-moon-wide" style="max-height:73vh; overflow-x:auto;">      
        <div class="row">
            @if(isset($orders))
            @foreach ($orders as $order)
            <div class="col-md-4 mb-2 mx-0" >
                <div class="card p-0 m-0" style="min-height:70vh; max-height:70vh;">
                    <div class="row pt-2 pb-1 px-3">
                        <div class="col-md-6 pr-4">
                            <div class="form-group my-1 row">
                                <label class="col-sm-5 pr-0 mr-0 pt-1" for="tableNumber">Table:</label>
                                <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                    <input class="form-control" type="number" name="tableNumber{{$order->id}}" id="tableNumber{{$order->id}}" min="1" max="30" value="{{$order->tableNumber}}" disabled>
                                    <input class="form-control" type="number" name="oldTableNumber{{$order->id}}" id="oldTableNumber{{$order->id}}" value="{{$order->tableNumber}}" style="display:none">
                                </div>       
                                <span id="editTableNumber-{{$order->id}}" class="edit-table-number col-sm-2 input-group-addon hidden-elements px-3 mx-0" style="cursor:pointer">
                                    <i id="editTable-{{$order->id}}" class="fa fa-pencil-alt" style="color:#3b3f44 !important;"></i>
                                </span>  
                            </div>
                        </div>
                        <div class="col-md-6 pl-1 pr-3">
                            <div class="form-group my-1 row">
                                <label class="col-sm-5 pr-0 mr-0 pt-1" for="queueNumber">Queue:</label>
                                <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                    <input class="form-control" type="number" name="queueNumber{{$order->id}}" id="queueNumber{{$order->id}}" min="1" max="50" value="{{$order->queueNumber}}" disabled>
                                </div>                                
                                <span id="editQueueNumber-{{$order->id}}" class="edit-queue-number col-sm-2 input-group-addon px-3 mx-0" style="cursor:pointer">
                                    <i id="editQueue-{{$order->id}}" class="fa fa-pencil-alt" style="color:#3b3f44 !important;"></i>
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
                                </tr>
                            </thead>
                            <tbody id="orderSlip">
                                @php 
                                    $subTotal = 0; 
                                @endphp

                                @foreach ($items[$loop->index] as $item)
                                <tr>
                                    <td class="py-2">{{$item->productName}}</td>
                                    <td class="py-2">{{$item->quantity}}</td>
                                    @php 
                                        $subTotal += $item->totalPrice;

                                        $unitPrice = $item->totalPrice/$item->quantity;
                                    @endphp
                                    <td class="py-2">{{number_format($unitPrice, 2)}}</td>
                                    <td class="py-2">{{number_format($item->totalPrice, 2)}}</td>
                                </tr>
                                @endforeach
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
                                        ₱&nbsp;{{number_format($order->discountAmount, 2)}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">TOTAL:</th>
                                    <th class="py-2" id="ordersGrandTotal" style="text-align:right;">
                                        ₱&nbsp;{{number_format($order->totalBill, 2)}}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="row mx-1">
                            <div class="col-md-6 px-1">
                                <a href="/add-order/{{$order->id}}" style="text-decoration:none">
                                    <button type="button" class="btn btn-primary btn-block" id="addOrder" style="text-align:center;">
                                        Add Order
                                    </button> 
                                </a>
                            </div>
                            <div class="col-md-6 px-1">
                                <a href="/bill-out/{{$order->id}}" style="text-decoration:none">
                                    <button type="button" class="btn btn-success btn-block" style="text-align:center;">
                                        Bill Out
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            @endforeach   
            @else
            <div class="container px-5">
                <p style="font-style:italic;"> No current orders to show </p>
            </div>
            @endif   
        </div>
    </div>
@endsection