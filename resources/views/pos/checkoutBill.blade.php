@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pt-3 pb-3 text-center">
            <a href="{{ URL::previous() }}">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a> 
            {{-- <h3>Bill Out</h3> --}}
        </div>   
        <form method="POST" action="/finish-order-transaction">            
        <input type="hidden" name="orderID" value="{{$order->id}}">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        
        <div class="row">
            <div class="col-md-6 offset-3 mb-3" >
                <div class="card p-0 m-0" style="min-height:80vh; max-height:80vh;">
                    <div class="container row">
                    {{-- <h4 class="text-muted text-center col-sm-12 pt-3 pb-1">Bill Out</h4> --}}
                        <div class="col-md-5 form-group mt-3 mb-2 row">
                        @if(isset($order->tableNumber)) 
                            <label class="col-sm-5 pr-0 mr-0 pt-1" for="tableNumber">Table:</label>
                            <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                <p class="py-1 my-0"> {{$order->tableNumber}} </p>
                                {{-- <input class="form-control" type="number" name="tableNumber{{$order->id}}" id="tableNumber{{$order->id}}" min="1" max="30" value="{{$order->tableNumber}}"> --}}
                            </div>   
                        @else
                            <label class="col-sm-5 pr-0 mr-0 py-2 mb-3" for="tableNumber"> </label>
                        @endif
                        </div>
                        <input class="form-control col-sm-4 mt-2 mr-2" type="text" style="position:absolute;right:0" maxlength="16" value="" id="referenceNumber" name="referenceNumber" autocomplete="off">
                    </div>
                    <!--h4 class="text-muted text-center pt-3 pb-1">Bill Out</h4-->

                    <div class="card-body p-0 m-0 scrollbar-near-moon" style="overflow-y:auto;">
                        <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <th scope="col" style="width:50%;">Description</th>
                                    <th scope="col" class="text-center">Qty.</th>
                                    <th scope="col" class="text-center">Price</th>
                                    <th scope="col" class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody id="orderSlip">
                                @php
                                    $subTotal = 0;
                                @endphp
                                @foreach ($items as $item)
                                <tr>
                                    <td> {{$item->productName}} </td>
                                    <td class="text-right"> {{$item->quantity}} </td>
                                    @php 
                                        $subTotal += $item->totalPrice;

                                        $unitPrice = $item->totalPrice/$item->quantity;
                                    @endphp
                                    <td class="text-right"> {{number_format($unitPrice, 2)}} </td>
                                    <td class="text-right"> {{number_format($item->totalPrice, 2)}} </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 px-0 mx-0">
                        <table class="table table-striped" >
                            <thead>
                                <tr id="subtotalRow">
                                    <th class="py-2" colspan="3" scope="row">Subtotal:</th>
                                    <td class="py-2" id="ordersSubtotal" style="text-align:right;">
                                        ₱&nbsp;{{number_format($subTotal, 2)}}
                                    </td>
                                </tr>
                                <tr class="text-primary"  id="discountRow">
                                    <th class="py-2" colspan="3" scope="row">Discount:</th>
                                    <td class="py-2" id="ordersDiscount" style="text-align:right;">
                                        ₱&nbsp;{{number_format($item->discountAmount, 2)}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">TOTAL:</th>
                                    <th class="py-2" id="ordersGrandTotal" style="text-align:right;">
                                        ₱&nbsp;{{number_format($item->totalBill, 2)}}
                                    </th>
                                </tr>
                            </thead>
                            <thead id="paymentContainer" style="display:none">
                                <tr class="text-primary">
                                    <th class="py-2" colspan="3" scope="row">Amount Tendered:</th>
                                    <th class="py-2" id="amountTenderedDisplay" style="text-align:right;">
                                    </th>
                                </tr>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">Change:</th>
                                    <th class="py-2" id="changeDisplay" style="text-align:right;">
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="row mx-2">
                            <div class="col-md-6 mb-1 px-1">
                                <button type="button" data-toggle="modal" data-target="#paymentModal" class="btn btn-primary btn-block" style="text-align:center;" id="getPayment">
                                    Get Cash Payment
                                </button>
                            </div>
                            <div class="col-md-6 px-1">
                                <button type="button" data-toggle="modal" data-target="#discountModal" class="btn btn-secondary btn-block" style="text-align:center;" id="discountButton">
                                    Discount
                                </button>
                            </div>
                            <div class="col-md-12 px-1">
                                <button type="submit" class="btn btn-success btn-block" style="text-align:center;" id="discountButton">
                                    Finish Transaction
                                </button>
                            </div>
                        </div>
                        <!-- Code below catches the payments and discounts -->
                        <input id="totalBill" name="totalBill" type="hidden" value="{{$order->totalBill}}">
                        <input id="discountAmount" name="discountAmount" type="hidden" value="{{$order->discountAmount}}">
                        
                        <input id="tenderedAmount" name="tenderedAmount" type="hidden" value="">
                        <input id="changeDue" name="changeDue" type="hidden" value="">
                        <!-- Ends here -->
                        <!--Code below records the orders that has been listed in the order slip, although hidden-->
                        <div id="ordersContainer" style="display:none;">              
                            <input id="numberOfOrders" name="numberOfOrders" type="number" value="{{count($items)}}">

                            @foreach($items as $orderItem)
                            <div id="itemOrderDiv{{$loop->iteration}}">
                                <input type="number" value="{{$orderItem->productID}}" id="productID{{$loop->iteration}}" name="productID{{$loop->iteration}}">
                                <input type="number" value="{{$orderItem->quantity}}" id="quantity{{$loop->iteration}}" name="quantity{{$loop->iteration}}">
                                <input type="number" value="{{$orderItem->totalPrice}}" id="productID{{$loop->iteration}}" name="totalPrice{{$loop->iteration}}">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>

    <div id="discountModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Discount</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless" >
                        <tbody>
                            <tr>
                                <td>                                        
                                    <label class="switch text-center">
                                        <input type="checkbox" id="discountMethod">
                                        <span class="slider-alt round"></span>
                                    </label>
                                    <span id="discountMethodLabel">%</span>
                                </td>
                            </tr>
                        </tbody>
                        <tbody id="discountRateBody">
                            <tr>
                                <th>Total to Pay</th>
                                <th class="text-right"><h4 id="amountToPayDiscount"></h4></th>
                            </tr>
                            <tr>
                                <th class="pt-4" style="width:50%;">Number of Pax</th>
                                <th class="input-group">
                                    <input type="number" class="form-control form-control-lg text-right" min="1" value="1" id="numberOfPax">
                                </th>
                            </tr>
                            <tr>
                                <th class="pt-4" style="width:50%;">Discount Rate</th>
                                <th class="input-group">
                                    <input type="number" class="form-control form-control-lg text-right input-group-prepend" id="discountRate">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </th>
                            </tr>
                            <tr class="text-primary">
                                <th>Total Discount</th>
                                <th class="text-right"><h4 id="totalDiscount">₱&nbsp;0.00</h4></th>
                            </tr>
                        </tbody>
                        <tbody id="discountRatePeso"  style="display:none">
                            <tr>
                                <th>Total to Pay</th>
                                <th class="text-right"><h4 id="amountToPayDiscountPeso"></h4></th>
                            </tr>
                            <th class="pt-4" style="width:50%;">Senior Citizen Id/Pwd Id</th>
                            <th class="input-group">
                                <input type="text" class="form-control form-control-lg text-right input-group-prepend" id="SeniorPwdId">
                            </th><tr></tr>
                            <th class="pt-4 text-primary" style="width:50%;">Discount Amount</th>
                            <th class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input type="number" class="form-control form-control-lg text-right input-group-prepend" id="discountPesoAmount">
                            </th>
                        </tbody>
                    </table>
                    <table class="table table-borderless"  id="discountHelperTable">
                        <tbody>
                            <tr>
                                <th class="px-1 py-1" style="width:25%"><button type="button" class="btn btn-lg btn-info btn-block discountButtons">5%</button></th>
                                <th class="px-1 py-1" style="width:25%"><button type="button" class="btn btn-lg btn-info btn-block discountButtons">10%</button></th>
                                <th class="px-1 py-1" style="width:25%"><button type="button" class="btn btn-lg btn-info btn-block discountButtons">15%</button></th>
                                <th class="px-1 py-1" style="width:25%"><button type="button" class="btn btn-lg btn-info btn-block discountButtons">20%</button></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="saveDiscountButton">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div id="paymentModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-center">Payment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless" >
                        <tbody>
                            <tr>
                                <th>Total to Pay</th>
                                <th class="text-right"><h4 id="amountToPay"></h4></th>
                            </tr>
                            <tr>
                                <th class="pt-4" style="width:50%;">Amount Tendered</th>
                                <th class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="number" class="form-control form-control-lg text-right" id="amountTendered">
                                </th>
                            </tr>
                            <tr>
                                <th>Change</th>
                                <th class="text-right"><h5 id="changeToGive">₱&nbsp;0.00</h5></th>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-borderless" >
                        <tbody>
                            <tr>
                                <th class="px-1 py-1" style="width:33.33%"><button type="button" class="btn btn-lg btn-info btn-block" id="exactPayment">Exact</button></th>
                                <th class="px-1 py-1" style="width:33.33%"><button type="button" class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;1.00</button></th>
                                <th class="px-1 py-1" style="width:33.33%"><button type="button" class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;5.00</button></th>
                            </tr>
                            <tr>
                                <th class="px-1 py-1" style="width:33.33%"><button type="button" class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;10.00</button></th>
                                <th class="px-1 py-1" style="width:33.33%"><button type="button" class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;20.00</button></th>
                                <th class="px-1 py-1" style="width:33.33%"><button type="button" class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;50.00</button></th>
                            </tr>
                            <tr>
                                <th class="px-1 py-1" style="width:33.33%"><button type="button" class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;100.00</button></th>
                                <th class="px-1 py-1" style="width:33.33%"><button type="button" class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;500.00</button></th>
                                <th class="px-1 py-1" style="width:33.33%"><button type="button" class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;1000.00</button></th>
                            </tr>
                            <tr>
                                <th class="px-1 py-1" style="width:33.33%"></th>
                                <th class="px-1 py-1" style="width:33.33%"><button type="button" class="btn btn-lg btn-warning btn-block" id="clearPayment">Clear</button></th>
                                <th class="px-1 py-1" style="width:33.33%"></th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal" id="savePaymentButton">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection