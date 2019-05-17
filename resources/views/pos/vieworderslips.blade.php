@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center pos-tabs pb-1">
        <nav class="nav nav-pills centered-pills py-2">
            <a class="nav-item nav-link" style="color:#505050" href="/create-order">Create Order</a>
            <a class="nav-item nav-link active" style="background-color:#060f0ed4;" href="#">Order Slips</a>
            <a class="nav-item nav-link" style="color:#505050" href="/view-tables">View Tables</a>
        </nav>
    </div>
    <div class="container-fluid col-md-12 pb-2 pt-4 px-5">        
        <div class="row">
            <div class="col-md-4 order-md-12 mb-4 mx-0" >
                <div class="card p-0 m-0" style="min-height:67vh; max-height:67vh;">
                    <h4 class="text-muted text-center py-3">Order Slip</h4>
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
                                Get payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>      
            <div class="col-md-4 order-md-12 mb-4 mx-0" >
                <div class="card p-0 m-0" style="min-height:67vh; max-height:67vh;">
                    <h4 class="text-muted text-center py-3">Order Slip</h4>
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
                                Get payment
                            </button>
                        </div>
                    </div>
                </div>
            </div>       
        </div>
@endsection