@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <div class="py-3 text-center">
            <a href="/edit-details/1">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>View Payment Details</h3>
        </div>        
        <form class="form" method="POST" action="/updateDetails">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                    
        {{--<input type="hidden" name="accommodationID" value="{{$guestDetails->accommodationID}}">--}}
        @foreach($guest as $guest)
        <h5 style="margin-bottom:.80em;">{{$guest->firstName}} {{$guest->lastName}}</h5>
        @endforeach
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
                        @foreach($charges as $charge)
                        <tr class="guestChargesRows" id="{{$charge->chargeID}}">
                        <th scope="row">{{$charge->chargeID}}</th>
                        <td scope="row">{{$charge->serviceName}}</td>
                        <td scope="row" style="text-align:right">{{number_format((float)($charge->totalPrice), 2, '.', '')}}</td>
                        <td scope="row" style="text-align:right">{{number_format((float)($charge->balance), 2, '.', '')}}</td>
                        <td scope="row" style="text-align:center">{{$charge->remarks}}</td>
                        </tr>                        
                        @endforeach
                    </tbody>
                </table>
            </div>
    
            <div class="col-md-6 card p-0">
                <h5 style="text-align:center;padding-top:0.5em;">Payments</h5>
                <table class="table table-hover table-sm">
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Remarks</th>
                        <th scope="col">ChargeID</th>
                        <th scope="col">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                        <tr class="{{$payment->chargeID}} guestPaymentsRows">
                        <th scope="row">{{$payment->id}}</th>
                        <td style="text-align:right">{{number_format((float)($payment->amount), 2, '.', '')}}</td>
                        <td style="text-align:center">{{$payment->paymentStatus}}</td>
                        <td>{{$payment->chargeID}}</td>
                        <td>{{\Carbon\Carbon::parse($payment->paymentDatetime)->format('F j, Y h:iA')}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>          
@endsection