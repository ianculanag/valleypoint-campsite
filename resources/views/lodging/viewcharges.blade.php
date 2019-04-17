@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="pt-3 pb-3">
        <a href="/glamping">
            <span style="float:left;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <strong>Back</strong>
            </span>
        </a>
        <h3 class="text-center">Charges</h3>
    </div>
    <div class="col-md-12">
        <table data-order='[[ 0, "asc" ]]' class="table table-sm dataTable stripe compact" cellspacing="0" id="chargesTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Acc ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>   
                    <th>Service Name</th>             
                    <th>Quantity</th>                            
                    <th>Total Price</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @foreach($charges as $charge)
                <tr>
                    <td>{{$charge->chargeID}}</td>
                    <td>{{$charge->accommodationID}}</td>             
                    <td>{{$charge->firstName}}</td>                              
                    <td>{{$charge->lastName}}</td>    
                    <td>{{$charge->serviceName}}</td>                           
                    <td>{{$charge->quantity}}</td>                                     
                    <td>{{$charge->totalPrice}}</td>                            
                    <td>{{$charge->balance}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection