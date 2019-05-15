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
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Table Number</th>              
                    <th>Orders</th>                            
                    <th>Payment Status</th>
                    <th>Amount Paid</th>
                </tr>
            </thead>
            <tbody>
               
                @foreach($restaurantPayments as $restaurantPayment)
                <tr>
                    <td>{{$restaurantPayment->paymentOrderID}}</td>
                    <td>{{$restaurantPayment->paymetDateTime}}</td>
                    <td>{{$restaurantPayment->paymentTableNumber}}</td>                                                                                 
                    <td>{{$restaurantPayment->paymentStatus}}</td>                            
                    <td class="text-right">{{number_format((float)($payment->amount), 2, '.', '')}}</td>
                </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>
@endsection