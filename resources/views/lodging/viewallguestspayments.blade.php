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
            <h3> Transactions </h3>
        </div>
        <div class="row">
            <div class="container col-md-7">
                <div class="card mx-0 scrollbar-near-moon px-2 py-3" style="max-height:70vh; overflow-y:auto;">
                    <h5 style="text-align:center; padding-top:0.5em;">Charges</h5>
                    <table data-order='[[ 0, "asc" ]]' class="table table table-hover table-sm dataTable compact" cellspacing="0">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color:rgb(233, 236, 239);">No.</th>
                                <th scope="col" style="background-color:rgb(233, 236, 239);">Guest Name</th>
                                <th scope="col" style="background-color:rgb(233, 236, 239);">Service</th>
                                <th scope="col" style="background-color:rgb(233, 236, 239);">Price</th>
                                <th scope="col" style="background-color:rgb(233, 236, 239);">Balance</th>
                                {{--<th scope="col">Status</th>--}}
                                <th scope="col" style="background-color:rgb(233, 236, 239);">Unit</th>
                                {{--<th scope="col" style="background-color:rgb(233, 236, 239);">Acc ID</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($charges as $charge)
                            <tr class="guestChargesRows" id="{{$charge->chargeID}}">
                                <th scope="row">{{$charge->chargeID}}</th>
                                <td scope="row">{{$charge->firstName}} {{$charge->lastName}}</td>
                                <td scope="row">{{$charge->serviceName}}</td>
                                <td scope="row" class="text-right">{{number_format($charge->totalPrice, 2)}}</td>
                                <td scope="row" class="text-right">{{number_format($charge->balance, 2)}}</td>
                                {{--<td scope="row">{{$charge->remarks}}</td>--}}
                                <td scope="row">{{$charge->unitNumber}}</td>
                                {{--<td scope="row" class="text-center">{{$charge->accommodationID}}</td>--}}
                            </tr>                        
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    
            <div class="container col-md-5">
                <div class="card mx-0 scrollbar-near-moon px-2 py-3" style="max-height:67vh; overflow-y:auto;">
                    <h5 style="text-align:center; padding-top:0.5em; {{--padding-bottom:1.9em;--}}">Payments</h5>
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col" style="background-color:rgb(233, 236, 239);">No.</th>
                                <th scope="col" style="background-color:rgb(233, 236, 239);">Amount</th>
                                <th scope="col" style="background-color:rgb(233, 236, 239);">Remarks</th>
                                <th scope="col" style="background-color:rgb(233, 236, 239);">Date and Time</th>
                                {{--<th scope="col" style="background-color:rgb(233, 236, 239);">Acc ID</th>--}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($payments as $payment)
                            <tr class="{{$payment->chargeID}} guestPaymentsRows">
                                <th scope="row">{{$payment->paymentID}}</th>
                                <td style="text-align:right">{{number_format($payment->amount, 2)}}</td>
                                <td>{{$payment->paymentStatus}}</td>
                                <td>{{\Carbon\Carbon::parse($payment->paymentDatetime)->format('F j, Y h:iA')}}</td>
                                {{--<td scope="row" style="text-align:center">{{$payment->accommodationID}}</td>--}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>          
@endsection