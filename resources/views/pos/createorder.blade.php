@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center pos-tabs pb-1">
        <nav class="nav nav-pills centered-pills py-2">
            <a class="nav-item nav-link active" style="background-color:#060f0ed4;" href="#">Create Order</a>
            <a class="nav-item nav-link" style="color:#505050" href="/view-order-slips">Order Slips</a>
            <a class="nav-item nav-link" style="color:#505050" href="/view-tables">View Tables</a>
        </nav>
    </div>
    <div class="container-fluid col-md-12 pb-2 pt-4 px-5">        
        <form method="POST" action="/save-order">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-4 order-md-12 mb-4 mx-0" >
                <div class="card p-0 m-0" style="min-height:67vh; max-height:67vh;">
                    <h5 class="text-muted text-center pt-3 pb-2" style="font-size:1.2em;">Order Slip</h5>
                    <div class="card-body p-0 m-0 scrollbar-near-moon" style="overflow-y:auto;">
                        <table class="table table-striped" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:45%;">Description</th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody id="orderSlip">
                                <tr id="emptyEntryHolder">
                                    <td class="py-2" style="text-align:center" colspan="4">Add items from the menu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 px-0 mx-0">
                        <table class="table table-striped" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">Subtotal:</th>
                                    <td class="py-2" id="ordersSubtotal" style="text-align:right;">₱0.00</td>
                                </tr>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">Discount:</th>
                                    <td class="py-2" id="ordersDiscount" style="text-align:right;">₱0.00</td>
                                </tr>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">TOTAL:</th>
                                    <th class="py-2" id="ordersGrandTotal" style="text-align:right;">₱0.00</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="row mx-2">
                            <div class="col-md-12 mb-1 px-1">
                                <button class="btn btn-primary btn-block" style="text-align:center;" id="getPayment">
                                    Get Cash Payment
                                </button>
                            </div>
                            <div class="col-md-4 px-1">
                                <button type="submit" class="btn btn-success btn-block" style="text-align:center;">
                                    Save
                                </button>
                            </div>
                            <div class="col-md-4 px-1">
                                <button type="button" data-toggle="modal" data-target="#modal" class="btn btn-info btn-block" style="text-align:center;">
                                    Discount
                                </button>
                            </div>
                            <div class="col-md-4 px-1">
                                <button class="btn btn-danger btn-block" style="text-align:center;" id="clearItems">
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
                <input id="numberOfOrders" name="numberOfOrders" type="number" value="0">
                <!--the insertOrderEntry() function in createorder.js handles this part of the code-->
                <!--it inserts hidden inputs containing the orders-->
            </div>
            <!--Ends here-->
            <div class="col-md-8">
                <div class="container row pt-2 pb-1">
                    <div class="col-md-3 px-0 ml-0 mr-4">
                        <div class="form-group my-1 row pr-4">
                            <label class="col-sm-8 pr-0 mr-0 pt-1" for="tableNumber">Table No:</label>
                            <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                <input class="form-control" type="number" name="tableNumber" id="tableNumber" min="1" max="30" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 px-0 ml-0 mr-4">
                        <div class="form-group my-1 row pr-4">
                            <label class="col-sm-8 pr-0 mr-0 pt-1" for="queueNumber">Queue No:</label>
                            <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                <input class="form-control" type="number" name="queueNumber" id="queueNumber" min="1" max="50" placeholder="" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 pr-0 rounded-0">
                        <div class="list-group rounded-0">
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
                            @if($loop->iteration == 1)
                            <a href="#" id="{{$category}}" class='rounded-left rounded-0 list-group-item makeorder active' style="color:black">{{$displayName}}</a>
                            @else
                            <a href="#" id="{{$category}}" class='rounded-left rounded-0 list-group-item makeorder' style="color:black">{{$displayName}}</a>
                            @endif                            
                            @endforeach
                        </div>
                    </div>

                    <div class="col-md-9 card m-0 ml-0 border-left-0 rounded-0 px-3"> 
                        <div class="row p-3 scrollbar-near-moon" id="menu" style="overflow-y:auto;">
                        @foreach ($products as $product)
                        @if($product->productCategory == 'appetizer')
                            <a class="px-1 mx-1">       
                                <div class="card px-0 mx-1 menu-item" style="width:9.785rem; height:5em; cursor:pointer" id="{{$product->id}}">
                                    <div class="card-body text-center my-auto">
                                        <h6 class="card-text">
                                            {{$product->productName}}
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @endforeach
                        </div>    
                    </div>

                    <div class="container row offset-7 px-2 pt-2 float-right">
                        <div class="form-group row mt-2 pr-4">
                            <label class="col-sm-3 pt-1" for="itemQuantity">Quantity:</label>
                            <div class="input-group input-group-sm col-sm-4">
                                <input class="form-control" type="number" name="itemQuantity" id="itemQuantity" min="1" max="50" placeholder="1" value="1" required>
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

        <div id="modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="checkbox" checked data-toggle="toggle" data-on="₱" data-off="%" data-onstyle="success" data-offstyle="primary">
                        <p>Modal body text goes here.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
@endsection