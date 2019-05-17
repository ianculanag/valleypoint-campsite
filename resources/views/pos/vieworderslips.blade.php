@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center pos-tabs pb-1">
        <nav class="nav nav-pills centered-pills py-2">
            <a class="nav-item nav-link" style="color:#505050" href="/create-order">Create Order</a>
            <a class="nav-item nav-link active" style="background-color:#060f0ed4;" href="#">Order Slips</a>
            <a class="nav-item nav-link" style="color:#505050" href="/view-tables">View Tables</a>
        </nav>
    </div>
    <div class="container-fluid col-md-12 pb-2 pt-2 px-5">     
        <div class="col-md-3 offset-9 my-0">
            <div class="form-group my-0 row pr-4">
                <label class="col-sm-4 pr-0 mr-0 pt-1" for="searchOrder">Search</label>
                <div class="input-group input-group-sm col-sm-8 px-0 mx-0">
                    <input class="form-control" type="text" name="searchOrder" id="searchOrder" minlength="1" maxlength="20" placeholder="" value="">
                </div>
            </div>
        </div>   
        <div class="row">
            <div class="col-md-4 order-md-12 mb-4 mx-0" >
                <div class="card p-0 m-0" style="min-height:67vh; max-height:67vh;">
                    <div class="row pt-3 pb-2 px-3">
                        <div class="col-md-6">
                            <div class="form-group my-1 row pr-4">
                                <label class="col-sm-8 pr-0 mr-0 pt-1" for="tableNumber">Table No:</label>
                                <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                    <input class="form-control" type="number" name="tableNumber" id="tableNumber" min="1" max="30" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group my-1 row pr-4">
                                <label class="col-sm-8 pr-0 mr-0 pt-1" for="queueNumber">Queue No:</label>
                                <div class="input-group input-group-sm col-sm-4 px-0 mx-0">
                                    <input class="form-control" type="number" name="queueNumber" id="queueNumber" min="1" max="50" placeholder="" value="">
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <td style="text-align:center" colspan="4">Add items from the menu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 px-0 mx-0">
                        <table class="table table-striped" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th colspan="3" scope="row">TOTAL:</th>
                                    <th id="ordersGrandTotal" style="text-align:right;">0.00</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="mx-2">
                            <button type="button" class="btn btn-primary btn-block" style="text-align:center;">
                                Add Order
                            </button>
                            <button type="button" class="btn btn-success btn-block" style="text-align:center;">
                                Bill Out
                            </button>
                        </div>
                    </div>
                </div>
            </div>        
        </div>
@endsection