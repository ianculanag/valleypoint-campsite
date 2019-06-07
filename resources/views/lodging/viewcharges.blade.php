@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="pt-3 pb-3">
        {{--<a href="{{ URL::previous() }}">
            <span style="float:left;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <strong>Back</strong>
            </span>
        </a>--}}
        <h3 class="text-center">Transaction Charges</h3>
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
                    <th>Price</th>
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
                    <td class="text-right">{{$charge->quantity}}</td>                                     
                    <td class="text-right">{{number_format($charge->totalPrice, 2)}}</td>                            
                    <td class="text-right">{{number_format($charge->balance, 2)}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection