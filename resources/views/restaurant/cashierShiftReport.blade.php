@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <div class="pt-3 pb-3 text-center">
            <a href="/transient-backpacker">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Cashier Shift Report</h3>
        </div>   
        <form method="POST" action="/checkin-backpacker">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <!--<input type="hidden" name="selectedUnit" id="selectedUnit" value="">
        <input type="hidden" name="backpackerQuantity" id="backpackerQuantity" value="">-->
        <h3>Sales Report</h3>
        <label><h5>Cashier:</h5></label> Tony Stark 
        <label><h5>Date:</h5></label> May 1,2019
        <label><h5>Cash Start:</h5></label> Php.10,000
        <br><label><h5>Start Period:</h5></label> 8:00am
        <label><h5>End Period:</h5></label> 5:00pm
        <div class="row">
            <div class="col-md-10 order-md-2 mb-4 mx-0">
                <div class="card p-0 mx-0">
                    <h4 class="text-muted" style="text-align:center; padding:0.5em;">Sales</h4>
                    <table class="table table-striped" style="font-size:.88em;">
                        <thead>
                            <tr>
                                <th scope="col">Time</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceRows">
                            <tr id="">
                                <td style="display:none;"><input id="" class="form-check-input" type="checkbox" checked></td>
                                <td id="invoiceItem" class="invoiceDescriptions">8:35am</td>
                                <td id="invoiceItem" class="invoiceDescriptions">Tapsilog</td>
                                <td id="invoiceQuantity"  class="invoiceQuantities">1</td>
                                <td id="invoiceUnitPrice"  class="invoiceUnitPrices">100</td>
                                <td id="invoiceTotalPrice"  class="invoicePrices">100</td>
                            </tr>
                            <tr id="">
                                <td style="display:none;"><input id="" class="form-check-input" type="checkbox" checked></td>
                                <td id="invoiceItem" class="invoiceDescriptions">8:37am</td>
                                <td id="invoiceItem" class="invoiceDescriptions">Carbonara</td>
                                <td id="invoiceQuantity"  class="invoiceQuantities">1</td>
                                <td id="invoiceUnitPrice" class="invoiceUnitPrices">150</td>
                                <td id="invoiceTotalPrice" class="invoicePrices">150</td>
                            </tr>
                            <tr id="">
                                <td style="display:none;"><input id="" class="form-check-input" type="checkbox" checked></td>
                                <td id="invoiceItem" class="invoiceDescriptions">8:45am</td>
                                <td id="invoiceItem" class="invoiceDescriptions">Nachos</td>
                                <td id="invoiceQuantity"  class="invoiceQuantities">2</td>
                                <td id="invoiceUnitPrice" class="invoiceUnitPrices">100</td>
                                <td id="invoiceTotalPrice" class="invoicePrices">200</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="3" scope="row">TOTAL:Php450</th>
                                <th id="invoiceGrandTotal" style="text-align:right;"></th>
                            </tr>
                            
                            {{--<tr>
                                <th colspan="1">Amount Paid:</th>
                                <th style="text-align:right;"  colspan="3">
                                <input type="number" name="amountPaid" placeholder="0" min="0" style="text-align:right;" class="form-control" id="amount" required>
                                </th>
                            </tr>--}}
                        </tfoot>
                    </table>
                </div>
                <label><h5>Tony Stark's Total Sale:</h5></label>    Php450
                <br><label><h5>Cash close:</h5></label>     Php10,450
                <br><button type="button" class="btn btn-primary" style="text-align:center;width:10em" id="proceedToPayment" data-toggle="modal" data-target="">
                    Change Register
                </button>
            </div>
        </div>
    </div>
    
@endsection