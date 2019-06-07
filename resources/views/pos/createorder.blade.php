@extends('layouts.app')

@section('content')
    <style>
    .modal-backdrop{
        opacity:0.1 !important;
    }
    </style>
    <div class="col-md-12 text-center pos-tabs pb-1">
        <nav class="nav nav-pills centered-pills py-2">
            <a class="nav-item nav-link active" style="background-color:#060f0ed4; cursor:pointer;" href="#">Create Order</a>
            <a class="nav-item nav-link" style="color:#505050; cursor:pointer;" href="/view-order-slips">Order Slips</a>
            <a class="nav-item nav-link" style="color:#505050; cursor:pointer;" href="/view-tables">View Tables</a>
        </nav>
    </div>
    <div class="container-fluid col-md-12 pb-2 pt-4 px-4">       
        @if(isset($order)) 
        <form method="POST" action="/save-additional-order">
        <input type="hidden" name="orderID" value="{{$order->id}}">
        @else        
        <form method="POST" action="/save-order">
        @endif
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-4 order-md-12 mb-3 mx-0" >
                <div class="card p-0 m-0" style="min-height:73.5vh; max-height:73.5vh;">
                    <h5 class="text-muted text-center pt-3 pb-1" style="font-size:1.2em;">Order Slip</h5>
                    <div class="card-body p-0 m-0 scrollbar-near-moon" style="overflow-y:auto;">
                        <table class="table table-striped" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:40%;">Description</th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="orderSlip">
                                @if(isset($items))
                                @foreach($items as $item)
                                @php
                                    $unitPrice = $item->totalPrice/$item->quantity;
                                @endphp
                                <tr class="items" id="orderSlipItem{{$loop->iteration}}">
                                    <td class="orderItemDescription py-2">{{$item->productName}}</td>
                                    <td style="text-align:right" class="orderItemQuantity py-2">{{$item->quantity}}</td>
                                    <td style="text-align:right" class="orderItemUnitPrice py-2">{{number_format($unitPrice, 2)}}</td>
                                    <td style="text-align:right" class="orderItemPrice py-2">{{number_format($item->totalPrice, 2)}}</td>
                                    <td style="cursor:pointer;" class="py-2 text-muted removeItem"><span class="fa fa-times-circle"></span></td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 px-0 mx-0">
                        <table class="table table-striped" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">Subtotal:</th>
                                    @if(isset($items))
                                    @php
                                        $subtotal = 0;

                                        for($index = 0; $index < count($items); $index++) {
                                            $subtotal += $items[$index]->totalPrice;
                                        }
                                    @endphp
                                    <td class="py-2" id="ordersSubtotal" style="text-align:right;">₱&nbsp;{{number_format($subtotal, 2)}}</td>
                                    @else
                                    <td class="py-2" id="ordersSubtotal" style="text-align:right;">₱&nbsp;0.00</td>
                                    @endif
                                </tr>
                                <tr  class="text-primary">
                                    <th class="py-2" colspan="3" scope="row">Discount:</th>
                                    @if(isset($order))
                                    <td class="py-2" id="ordersDiscount" style="text-align:right;">₱&nbsp;{{number_format($order->discountAmount, 2)}}</td>
                                    @else
                                    <td class="py-2" id="ordersDiscount" style="text-align:right;">₱&nbsp;0.00</td>
                                    @endif
                                </tr>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">TOTAL:</th>
                                    @if(isset($order))
                                    <th class="py-2" id="ordersGrandTotal" style="text-align:right;">₱&nbsp;{{number_format($order->totalBill, 2)}}</th>
                                    @else
                                    <th class="py-2" id="ordersGrandTotal" style="text-align:right;">₱&nbsp;0.00</th>
                                    @endif
                                </tr>
                            </thead>
                        </table>
                        <div class="row mx-2">
                            <div class="col-md-12 mb-1 px-1">
                                <button type="submit" class="btn btn-primary btn-block" style="text-align:center;" id="saveOrder" disabled>
                                    Save Order
                                </button>
                            </div>                            
                            <!--div class="col-md-4 px-1">
                                <button type="button" data-toggle="modal" data-target="#paymentModal" class="btn btn-success btn-block" style="text-align:center;" id="getPayment" disabled>
                                    Get Cash
                                </button>
                            </div-->
                            <div class="col-md-6 px-1">
                                <button type="button" data-toggle="modal" data-target="#discountModal" class="btn btn-info btn-block" style="text-align:center;" id="discountButton" disabled>
                                    Discount
                                </button>
                            </div>
                            <div class="col-md-6 px-1">
                                <button type="button" class="btn btn-danger btn-block" style="text-align:center;" id="clearItems" disabled>
                                    Clear
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Code below records the orders that has been listed in the order slip, although hidden-->
            <!--Starts here-->
            <div id="ordersContainer" style="display:none;">
                @if(isset($items))                
                <input id="numberOfOrders" name="numberOfOrders" type="number" value="{{count($items)}}">

                @foreach($items as $orderItem)
                <div id="itemOrderDiv{{$loop->iteration}}">
                    <input type="number" value="{{$orderItem->productID}}" id="productID{{$loop->iteration}}" name="productID{{$loop->iteration}}">
                    <input type="number" value="{{$orderItem->quantity}}" id="quantity{{$loop->iteration}}" name="quantity{{$loop->iteration}}">
                    <input type="number" value="{{$orderItem->totalPrice}}" id="productID{{$loop->iteration}}" name="totalPrice{{$loop->iteration}}">
                </div>
                @endforeach
                @else
                <input id="numberOfOrders" name="numberOfOrders" type="number" value="0">
                @endif
                <!--the insertOrderEntry() function in createorder.js handles this part of the code-->
                <!--it inserts hidden inputs containing the orders-->
            </div>
            
            @if(isset($order))
            <input id="totalBill" name="totalBill" type="hidden" value="{{$order->totalBill}}">
            <input id="discountAmount" name="discountAmount" type="hidden" value="{{$order->discountAmount}}">
            @else
            <input id="totalBill" name="totalBill" type="hidden" value="0">
            <input id="discountAmount" name="discountAmount" type="hidden" value="0">
            @endif
            <!--Handles total bill-->
            <!--Ends here-->
            <div class="col-md-8">
                <div class="container row py-0 mx-0 px-0">
                    <div class="col-md-3 py-2 pl-1 mr-0 pr-0">
                        <label class="switch mr-2">
                            <input type="checkbox" id="orderType">
                            <span class="slider round"></span>
                        </label>
                        <label id="orderTypeText">Walk-in</label>
                    </div>
                    <div class="col-md-3 px-0 ml-0">
                        <div class="form-group my-1 row pr-4">
                            <label class="col-sm-6 pr-0 mr-0 pt-1" for="tableNumber">Table No:</label>
                            <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                @if(isset($order))
                                <input class="form-control" type="number" name="tableNumber" id="tableNumber" min="1" max="30" maxlength="2" value="{{$order->tableNumber}}" oninput="maxLengthCheck(this)" disabled>
                                @else
                                <input class="form-control" type="number" name="tableNumber" id="tableNumber" min="1" max="30" maxlength="2" oninput="maxLengthCheck(this)">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 px-0 ml-0">
                        <div class="form-group my-1 row pr-4">
                            <label class="col-sm-7 pr-0 mr-0 pt-1" for="queueNumber">Queue No:</label>
                            <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                @if(isset($order))
                                <input class="form-control" type="number" name="queueNumber" id="queueNumber" min="1" max="99" maxlength="2" value="{{$order->queueNumber}}" oninput="maxLengthCheck(this)">
                                @else
                                <input class="form-control" type="number" name="queueNumber" id="queueNumber" min="1" max="99" maxlength="2" oninput="maxLengthCheck(this)">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 px-0 float-right">
                        <div class="form-group my-1 row">
                            <label class="col-sm-3 pr-0 pl-4 pt-1" for="queueNumber"><span class="fa fa-search text-secondary"></span></label>
                            <div class="input-group input-group-sm px-0 mx-0 col-sm-9">
                                <input class="form-control" type="text" name="searchFoodItem" id="searchFoodItem" maxlength="10" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-0 rounded-0">
                        <div class="list-group rounded-0">
                            <a href="#" id="allProducts" class='rounded-left rounded-0 list-group-item makeorder active' style="color:black">All</a>
                            @foreach($categories as $category)
                            @php
                                $displayNameSplit = preg_split('/(?=[A-Z])/', ucfirst($category)); 
                                $displayName = '';

                                for($index = 0; $index < count($displayNameSplit); $index++) {
                                    if(($index) + 1 == count($displayNameSplit)) {
                                        $displayName .= $displayNameSplit[$index];
                                    } else {
                                        $displayName .= $displayNameSplit[$index].' ';                                        
                                    }
                                }

                                if(!(substr($displayName, -1) == 's')) {
                                    $displayName .= 's';
                                }
                            @endphp
                            <a href="#" id="{{$category}}" class='rounded-left rounded-0 list-group-item makeorder' style="color:black">{{$displayName}}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-9 card m-0 ml-0 border-left-0 rounded-0 px-3" style="max-height:59.9vh;"> 
                        <div class="row p-3 scrollbar-near-moon" id="menu" style="overflow-y:auto;">
                        @foreach ($products as $product)
                        <a class="px-1 mx-1">       
                            <div class="card px-0 mx-1 menu-item" style="width:9.785rem; height:5.5em; cursor:pointer" id="{{$product->id}}">
                                <div class="card-body text-center pt-2">
                                    <h6 class="card-text">
                                        {{$product->productName}}
                                    </h6>
                                    <p>₱&nbsp;{{number_format($product->price, 2)}}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        </div>    
                    </div>

                    <div class="container row offset-7 px-2 pt-2 float-right">
                        <div class="form-group row mt-2 pr-4">
                            <label class="col-sm-3 pt-1" for="itemQuantity">Quantity:</label>
                            <div class="input-group input-group-sm col-sm-4">
                                <input class="form-control" type="number" name="itemQuantity" id="itemQuantity" min="1" max="500" maxlength="3" placeholder="1" value="1" oninput="maxLengthCheck(this)" required>
                            </div>
                            <button id="addItemButton" class="form-control btn btn-sm btn-success col-sm-5" style="width:10em;" type="button" disabled>Add Item</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="orderInputs" style="display:none">
                <input type="hidden" id="itemID" value="">
                <input type="hidden" id="itemDescription" value="">
                <input type="hidden" id="itemUnitPrice" value="">
                <input type="hidden" id="itemTotalPrice" value="">
            </div>

            <div id="snackbar"></div>
            </form>            
        </div>

        <div class="itemRemovalModal">
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
                        <table class="table table-borderless" style="font-size:.88em;">
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
                                <th class="pt-4 text-primary" style="width:50%;">Discount Amount</th>
                                <th class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">₱</span>
                                    </div>
                                    <input type="number" class="form-control form-control-lg text-right input-group-prepend" id="discountPesoAmount">
                                </th>
                            </tbody>
                        </table>
                        <table class="table table-borderless" style="font-size:.88em;" id="discountHelperTable">
                            <tbody>
                                <tr>
                                    <th class="px-1 py-1" style="width:25%"><button class="btn btn-lg btn-info btn-block discountButtons">5%</button></th>
                                    <th class="px-1 py-1" style="width:25%"><button class="btn btn-lg btn-info btn-block discountButtons">10%</button></th>
                                    <th class="px-1 py-1" style="width:25%"><button class="btn btn-lg btn-info btn-block discountButtons">15%</button></th>
                                    <th class="px-1 py-1" style="width:25%"><button class="btn btn-lg btn-info btn-block discountButtons">20%</button></th>
                                </tr>
                            </tbody>
                        </table>
                        {{--OLD DISCOUNT IMPLEMENTATION<span style="font-size:1.2em;">₱</span> <input type="checkbox" id="discountMethod" data-toggle="toggle" data-onstyle="primary" data-offstyle="success" data-on=" " data-off=" "> <strong style="font-size:1.2em;">%</strong>--}}
                        {{--<span>₱</span>
                        <label class="switch">
                            <input type="checkbox" id="discountMethod">
                            <span class="slider round"></span>
                        </label>
                        <strong>%</strong>

                        <div style="float:right">
                            <strong>All</strong>
                            <label class="switch">
                                <input type="checkbox" id="discountToAll">
                                <span class="slider-alt round"></span>
                            </label>
                        </div>
                        <div class="mt-2" id="discountModalBody">
                        </div>--}}
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
                        <table class="table table-borderless" style="font-size:.88em;">
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

                        <table class="table table-borderless" style="font-size:.88em;">
                            <tbody>
                                <tr>
                                    <th class="px-1 py-1" style="width:33.33%"><button class="btn btn-lg btn-info btn-block" id="exactPayment">Exact</button></th>
                                    <th class="px-1 py-1" style="width:33.33%"><button class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;1.00</button></th>
                                    <th class="px-1 py-1" style="width:33.33%"><button class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;5.00</button></th>
                                </tr>
                                <tr>
                                    <th class="px-1 py-1" style="width:33.33%"><button class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;10.00</button></th>
                                    <th class="px-1 py-1" style="width:33.33%"><button class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;20.00</button></th>
                                    <th class="px-1 py-1" style="width:33.33%"><button class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;50.00</button></th>
                                </tr>
                                <tr>
                                    <th class="px-1 py-1" style="width:33.33%"><button class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;100.00</button></th>
                                    <th class="px-1 py-1" style="width:33.33%"><button class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;500.00</button></th>
                                    <th class="px-1 py-1" style="width:33.33%"><button class="btn btn-lg btn-info btn-block cashButtons">₱&nbsp;1000.00</button></th>
                                </tr>
                                <tr>
                                    <th class="px-1 py-1" style="width:33.33%"></th>
                                    <th class="px-1 py-1" style="width:33.33%"><button class="btn btn-lg btn-warning btn-block" id="clearPayment">Clear</button></th>
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
        <script>
            function maxLengthCheck(object) {
                if (object.value.length > object.maxLength)
                object.value = object.value.slice(0, object.maxLength)
            }
        </script>
@endsection