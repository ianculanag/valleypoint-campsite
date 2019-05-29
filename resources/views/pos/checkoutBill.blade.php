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
            {{--<h3>Check-out Bill</h3>--}}
        </div>   
        <form method="POST" action="/">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        
        <div class="row">
            <div class="col-md-6 offset-3 mb-3" >
                <div class="card p-0 m-0" style="min-height:80vh; max-height:80vh;">
                    <h4 class="text-muted text-center pt-3 pb-1">Check-out Bill</h4>
                    <div class="card-body p-0 m-0 scrollbar-near-moon" style="overflow-y:auto;">
                        <table class="table table-striped" style="font-size:.88em;">
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
                                    <td class="text-right"> {{number_format((float)($unitPrice), 2, '.', '')}} </td>
                                    <td class="text-right"> {{number_format((float)($item->totalPrice), 2, '.', '')}} </td>
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
                                        ₱ {{number_format((float)($subTotal), 2, '.', '')}}
                                    </td>
                                </tr>
                                <tr  class="text-primary">
                                    <th class="py-2" colspan="3" scope="row">Discount:</th>
                                    <td class="py-2" id="ordersDiscount" style="text-align:right;">
                                        ₱ {{number_format((float)($item->discountAmount), 2, '.', '')}}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="py-2" colspan="3" scope="row">TOTAL:</th>
                                    <th class="py-2" id="ordersGrandTotal" style="text-align:right;">
                                        ₱ {{number_format((float)($item->totalBill), 2, '.', '')}}
                                    </th>
                                </tr>
                            </thead>
                        </table>
                        <div class="row mx-2">
                            <div class="col-md-6 mb-1 px-1">
                                <button type="button" data-toggle="modal" data-target="#paymentModal" class="btn btn-success btn-block" style="text-align:center;" id="getPayment">
                                    Get Cash Payment
                                </button>
                            </div>
                            <div class="col-md-6 px-1">
                                <button type="button" data-toggle="modal" data-target="#discountModal" class="btn btn-info btn-block" style="text-align:center;" id="discountButton">
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