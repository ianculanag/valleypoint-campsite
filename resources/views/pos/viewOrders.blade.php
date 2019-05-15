@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="pt-3 pb-3">
    
        <h3 class="text-center">Orders</h3>
    </div>
    <div class="col-md-12">
        <table id="ordersTable" data-order='[[ 0, "asc" ]]' class="table table-sm dataTable stripe compact" cellspacing="0">
              <thead>
                <tr class="">
                  <th>Order ID</th>
                  <th>Table Number</th>
                  <th>Products</th>
                  <th>Payment Status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                
                @if(count($orders) > 1)
                @foreach($orders as $order)
                <tr class="">
                  <td>{{$order->orderID}}</td>
                  <td>{{$order->orderNumber}}</td>
                  <td>{{$order->orderDateTime}}</td>
                </tr>
                @endforeach
                @endif
          </table>
        </div>
 @endsection