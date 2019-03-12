@extends('layouts.app')

@section('content')
<div class="py-5 text-center">
    <a href="/glamping">
        <span style="float:left;">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
            <strong>Back</strong>
        </span>
    </a>
    <h3 class="text-center">Sales Transactions</h3>
</div>
<div class="col-md-12">
    <table class="table table-striped table-sm reservationTable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Acc ID</th>
                <th scope="col">Service Name</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>                
                <th scope="col">Payment Date</th>
                <th scope="col">Amount Paid</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
            <tr>
                <td class="number">{{$sale->id}}</td>
                <td class="number">{{$sale->accommodationID}}</td>
                <td class="number">{{$sale->serviceName}}</td>                
                <td>{{$sale->firstName}}</td>                             
                <td>{{$sale->lastName}}</td>                             
                <td>{{$sale->paymentDatetime}}</td>                             
                <td style="text-align:right;">{{$sale->amount}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection