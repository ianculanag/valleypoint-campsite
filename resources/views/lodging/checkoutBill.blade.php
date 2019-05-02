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
            <h3>Check-out Bill</h3>
        </div>   
        <form method="POST" action="/checkin-backpacker">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <!--<input type="hidden" name="selectedUnit" id="selectedUnit" value="">
        <input type="hidden" name="backpackerQuantity" id="backpackerQuantity" value="">-->

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4 mx-0">
                <div class="card p-0 mx-0">
                    <h4 class="text-muted" style="text-align:center; padding:0.5em;">Charges</h4>
                    <table class="table table-striped" style="font-size:.88em;">
                        <thead>
                            <tr>
                                <th scope="col" style="width:40%">Item</th>
                                <th scope="col">Qty.</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceRows">
                            <tr id="">
                                <td style="display:none;"><input id="" class="form-check-input" type="checkbox" checked></td>
                                <td id="invoiceItem" class="invoiceDescriptions">Tapsilog</td>
                                <td id="invoiceQuantity" style="text-align:right;" class="invoiceQuantities">1</td>
                                <td id="invoiceUnitPrice" style="text-align:right;" class="invoiceUnitPrices">100</td>
                                <td id="invoiceTotalPrice" style="text-align:right;" class="invoicePrices">100</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="3" scope="row">TOTAL:</th>
                                <th id="invoiceGrandTotal" style="text-align:right;"></th>
                            </tr>
                            <tr>
                                <td colspan="2"><button type="button" class="btn btn-primary" style="text-align:center;width:8em" id="proceedToPayment" data-toggle="modal" data-target="#chargesModal">
                                    Confirm
                                </button></td>
                                <td colspan="2"><button type="button" class="btn btn-primary" style="text-align:center;width:8em" id="proceedToPayment" data-toggle="modal" data-target="">
                                    Go Back
                                </button></td>
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
            </div>
        </div>
    </div>
@endsection