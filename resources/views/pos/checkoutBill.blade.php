@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <div class="pt-3 pb-3 text-center">
            <a href="{{ URL::previous() }}">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Check-out Bill</h3>
        </div>   
        <form method="POST" action="/checkin-backpacker">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        
        <div class="row">
            <div class="col-md-6 offset-3 mb-3" >
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
                                <tr id="emptyEntryHolder">
                                    <td class="py-2" style="text-align:center" colspan="5">Add items from the menu</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-0 px-0 mx-0">
                        <table class="table table-striped" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">Subtotal:</th>
                                    <td class="py-2" id="ordersSubtotal" style="text-align:right;">₱ 0.00</td>
                                </tr>
                                <tr  class="text-primary">
                                    <th class="py-2" colspan="3" scope="row">Discount:</th>
                                    <td class="py-2" id="ordersDiscount" style="text-align:right;">₱ 0.00</td>
                                </tr>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">TOTAL:</th>
                                    <th class="py-2" id="ordersGrandTotal" style="text-align:right;">₱ 0.00</th>
                                </tr>
                            </thead>
                        </table>
                        <div class="row mx-2">
                            <div class="col-md-6 mb-1 px-1">
                                <button type="button" data-toggle="modal" data-target="#paymentModal" class="btn btn-success btn-block" style="text-align:center;" id="getPayment" disabled>
                                    Get Cash Payment
                                </button>
                            </div>
                            <div class="col-md-6 px-1">
                                <button type="button" data-toggle="modal" data-target="#discountModal" class="btn btn-info btn-block" style="text-align:center;" id="discountButton" disabled>
                                    Discount
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection