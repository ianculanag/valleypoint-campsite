@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="pt-3 pb-3">
        <h3 class="text-center">Payment Transactions</h3>
    </div>
    <div class="col-md-12">
        <table id="restaurantPaymentsTable" data-order='[[ 0, "asc" ]]' class="table table-sm dataTable stripe compact" cellspacing="0">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Table Number</th> 
                    <th>Orders</th>
                    <th>Payment Status</th>
                    <th>Date</th>           
                    <th>Amount Paid</th>
                </tr>
            </thead>
            <tbody>

                @foreach($restPayments as $restaurantPayment)
                <tr>
                   
                    <td>{{$restaurantPayment->queueNumber}}</td>
                    <td>{{$restaurantPayment->productName}}</td>
                    <td>{{$restaurantPayment->paymentStatus}}</td> 
                    <td>{{$restaurantPayment->paymentDatetime}}</td>
                    <td class="text-right">{{number_format((float)($payments->amount), 2, '.', '')}}</td>
                                              
                </tr>
                @endforeach
                   
            </tbody>
        </table>
</div>
@endsection