@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <div class="py-3 text-center">
            {{--<a href="/edit-details/1">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>--}}
            <h3> Transactions </h3>
        </div>
        <div class="row">
            <div class="container col-md-7">
                <div class="card mx-0" style="max-height:70vh; min-height:70vh;">
                    <h5 style="text-align:center;padding-top:0.5em;">Charges</h5>
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Guest Name</th>
                                <th scope="col">Service</th>
                                <th scope="col">Price</th>
                                <th scope="col">Balance</th>
                                <th scope="col">Status</th>
                                <th scope="col">Acc ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($charges as $charge)
                            <tr class="guestChargesRows" id="{{$charge->chargeID}}">
                                <th scope="row">{{$charge->chargeID}}</th>
                                <td scope="row">{{$charge->firstName}} {{$charge->lastName}}</td>
                                <td scope="row">{{$charge->serviceName}}</td>
                                <td scope="row" style="text-align:right">{{number_format((float)($charge->totalPrice), 2, '.', '')}}</td>
                                <td scope="row" style="text-align:right">{{number_format((float)($charge->balance), 2, '.', '')}}</td>
                                <td scope="row">{{$charge->remarks}}</td>
                                <td scope="row" style="text-align:center">{{$charge->accommodationID}}</td>
                            </tr>                        
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    
            <div class="container col-md-5">
                <div class="card mx-0" style="max-height:70vh; min-height:70vh;">
                    <h5 style="text-align:center;padding-top:0.5em;">Payments</h5>
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Remarks</th>
                                <th scope="col">Date & Time</th>
                                <th scope="col">Acc ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr class="{{$payment->chargeID}} guestPaymentsRows">
                                <th scope="row">{{$payment->id}}</th>
                                <td style="text-align:right">{{number_format((float)($payment->amount), 2, '.', '')}}</td>
                                <td>{{$payment->paymentStatus}}</td>
                                <td>{{\Carbon\Carbon::parse($payment->paymentDatetime)->format('F j, Y h:iA')}}</td>
                                <td scope="row" style="text-align:center">{{$payment->accommodationID}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>          
@endsection