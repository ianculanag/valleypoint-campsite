@extends('layouts.app')

@section('content')
<div class="container" style="position:fixed;">
    <div class="pt-3 pb-3">
        <a href="/glamping">
            <span style="float:left;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <strong>Back</strong>
            </span>
        </a>
        <h3 class="text-center">Payment Transactions</h3>
    </div>
    <div class="col-md-12">
        <table data-order='[[ 0, "asc" ]]' class="table table-sm dataTable stripe compact" cellspacing="0" id="paymentsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Acc ID</th>
                    <th>Service Name</th>
                    <th>First Name</th>
                    <th>Last Name</th>                
                    <th>Payment Date</th>                            
                    <th>Payment Status</th>
                    <th>Amount Paid</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                <tr>
                    <td>{{$payment->chargeID}}</td>
                    <td>{{$payment->accommodationID}}</td>
                    <td>{{$payment->serviceName}}</td>                
                    <td>{{$payment->firstName}}</td>                             
                    <td>{{$payment->lastName}}</td>                             
                    <td>{{$payment->paymentDatetime}}</td>                                     
                    <td>{{$payment->paymentStatus}}</td>                            
                    <td>{{$payment->amount}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection