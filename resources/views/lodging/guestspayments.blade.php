@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <div class="py-3 text-center">
            <a href="{{ URL::previous() }}">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Payment Details</h3>
        </div>        
        <form class="form" method="POST" action="/updateDetails">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                    
        {{--<input type="hidden" name="accommodationID" value="{{$guestDetails->accommodationID}}">--}}
        </form>
        @foreach($guest as $guest)
        <h5 style="margin-bottom:.80em;">{{$guest->firstName}} {{$guest->lastName}}</h5>
        <input type="hidden" id="guestLastName" value="{{$guest->lastName}}">
        <div class="row">
            <div class="col-md-5 card p-0">
                <h5 style="text-align:center;padding-top:0.5em;">Charges</h5>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Service Availed</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalCharges = 0;
                            $totalBalance = 0;
                            $chargeStatus = 'unpaid';
                        @endphp
                        @foreach($charges as $charge)
                        <tr class="guestChargesRows" id="{{$charge->chargeID}}">
                        <th scope="row">{{$charge->chargeID}}</th>
                        <td scope="row">{{$charge->serviceName}}</td>
                        <td scope="row" style="text-align:right">{{number_format($charge->totalPrice, 2)}}</td>
                        <td scope="row" style="text-align:right">{{number_format($charge->balance, 2)}}</td>
                        <td scope="row" style="text-align:center">{{$charge->remarks}}</td>
                        </tr>   
                        @php
                            $totalCharges += $charge->totalPrice;
                            $totalBalance += $charge->balance;
                        @endphp                     
                        @endforeach
                        @php
                            if($totalBalance <= 0) {
                                $chargeStatus = 'Fully Paid';
                            } else if($totalBalance == $totalCharges) {
                                $chargeStatus = 'Unpaid';
                            } else {
                                $chargeStatus = 'Pending';
                            }
                        @endphp
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" scope="row">TOTAL:</th>
                            <th id="invoiceGrandTotal" style="text-align:right;">₱&nbsp;{{number_format($totalCharges, 2)}}</th>
                            <th colspan="3"></th>
                        </tr>  
                        <tr>
                            <th colspan="3" scope="row">BALANCE:</th>
                            <th id="invoiceTotalBalance" class="invoiceTotalBalance" style="text-align:right;">₱&nbsp;{{number_format($totalBalance, 2)}}</th>
                            <th colspan="2"></th>
                        </tr>
                        <tr>
                            <th colspan="4" scope="row">STATUS:</th>
                            <th id="invoiceTotalBalance" class="invoiceTotalBalance" style="text-align:center;">{{$chargeStatus}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
    
            <div class="col-md-6 card p-0">
                <h5 style="text-align:center;padding-top:0.5em;">Payments</h5>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">ChargeID</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPayments = 0;
                        @endphp
                        @if(count($payments) > 0)
                        @foreach($payments as $payment)
                        <tr class="{{$payment->chargeID}} guestPaymentsRows">
                        <th scope="row">{{$payment->id}}</th>                        
                        <td>{{$payment->chargeID}}</td>
                        <td style="text-align:right">{{number_format($payment->amount, 2)}}</td>
                        <td style="text-align:center">{{$payment->paymentStatus}}</td>
                        <td>{{\Carbon\Carbon::parse($payment->paymentDatetime)->format('F j, Y h:iA')}}</td>
                        </tr>
                        @php
                            $totalPayments += $payment->amount;
                        @endphp
                        @endforeach
                        @else
                        <td colspan="5" style="text-align:center;">There are no payments to show.</td>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" scope="row">TOTAL:</th>
                            <th id="invoiceGrandTotal" style="text-align:right;">₱&nbsp;{{number_format($totalPayments, 2)}}</th>
                            <th colspan="3"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
        <button type="button" class="btn btn-primary">Get Payment</button>
        <button type="button" class="btn btn-info">Refund Payment</button>
        <button type="button" class="btn btn-secondary">Add Negative Charge</button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#voidModal">Void Transaction</button>
    </div> 
    
    
    <form class="form" id="voidTransaction" method="POST" action="/voidTransaction">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> 
        <input type="hidden" name="accommodationID" value="{{$guest->accommodationID}}">

        <div id="voidModal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Are you absolutely sure?</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body px-0 mx-0 mt-0 pt-0 mb-0 pb-0">
                        <div class="alert alert-warning rounded-0">
                            Unexpected bad things will happen if you don’t read this!
                        </div>
                    </div>
                    <div class="modal-body mt-0 pt-0">
                        <p>
                            This action <strong>cannot</strong> be undone. This will permanently void 
                            all transactions of <strong>{{$guest->firstName}} {{$guest->lastName}}</strong>
                            incuding accommodation units, charges, and payments.
                        </p>
                        <p>
                            This void transaction will be recorded under your account name, {{Auth::user()->name}}.
                        </p>
                        <p>Please input your reason for voiding (required): </p>
                        <textarea class="form-control mb-3 rows-3" name="reasonForVoid" id="reasonForVoid" required></textarea>
                        
                        <p>
                            Please type in the last name of the representative guest to confirm.
                        </p>
                        <input type="text" class="form-control mb-2" id="guestNameConfirm" autocomplete="off" required>
                        <button type="button" class="btn btn-danger" style="width:100%" id="confirmVoidTransaction" disabled>I understand the consequences, void this transaction.</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </form>
@endsection