@extends('layouts.noSideBar')

@section('content')
    <div class="container row pb-5 pt-3">
        <div class="col-md-2 float-right mx-5 pl-4" style="position:fixed; right:0;">
            <form method="POST" action="/reload-custom-restaurant-report">
                @csrf
                <div id="dateFilter">
                    <h3>Date Filter:</h3>
                <div class="px-1">
                    <div class="form-group row px-0 mx-0">
                        <label for="displayFrom" class="col-md-3 mb-0 mt-2 p-0">From:</label>
                        <div class="input-group input-group-sm col-md-9 px-0 mx-0">
                        @if(isset($displayfrom))
                            <input class="form-control restaurantReportDateInputs" type="date" name="displayFrom" maxlength="15" placeholder="" value="{{$displayfrom}}" required>
                            @else
                            <input class="form-control restaurantReportDateInputs" type="date" name="displayFrom" maxlength="15" placeholder="" value="<?php echo date("Y-m-d");?>" required>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row px-0 mx-0">
                        <label for="displayTo" class="col-md-3 mb-0 mt-2 p-0">To:</label>
                        <div class="input-group input-group-sm col-md-9 px-0 mx-0">
                            @if(isset($displayto))
                            <input class="form-control restaurantReportDateInputs" type="date" name="displayTo" maxlength="15" placeholder="" value="{{$displayto}}" required>
                            @endif
                        </div>
                    </div>
                    <div class="px-0 mx-0">
                        <button class="btn btn-sm btn-block btn-success" type="submit">
                            Load
                        </button>
                    </div>
                </div>
                </div>
            </form>
        </div>
        <div class="container col-md-10 col-sm-12">
            <div class="card col-md-10 offset-md-1 col-sm-12 py-4 ">
                <div class="row">
                    <div class="col-md-6 col-sm-4">
                        <img src={{asset('logo.png')}} class="float-left" style="height:7.5em; width:9.75em;" aria-hidden="true"></img>
                    </div>
                    <div class="col-md-6 col-sm-8 px-5 pt-3">
                        <h6 class="text-right"> Restaurant Sales Report </h6>
                        @if(isset($displayfrom))
                        <h6 class="text-right"> {{\Carbon\Carbon::parse($displayfrom)->format('F j, o')}} - {{\Carbon\Carbon::parse($displayto)->format('F j, o')}}</h6>
                        @else
                        <h6 class="text-right"> {{\Carbon\Carbon::now()->format('F j, o')}} - {{\Carbon\Carbon::parse($displayto)->format('F j, o')}}</h6>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                        <div class="col-md-12">
                                <table class="table table-sm table-bordered" style="font-size:.90em;">
                                        <tr>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Order Date</th>
                                                <tbody>
                                                    @if(count($productOrdered) > 1)
                                                    @php
                                                    $totalPrice = 0;
                                               @endphp
                                                    @foreach($productOrdered as $orders)
                                                    <tr class="">
                                                      <td>{{$orders->productName}}</td>
                                                      <td>{{$orders->productCategory}}</td>
                                                      <td class="text-right">{{$orders->quantity}}</td>
                                                      <td class="reportTotalAmount text-right">{{$orders->totalPrice}}</td>
                                                      <td class="text-right">{{\Carbon\Carbon::parse($orders->orderDatetime)->format('M j, Y')}}</td>                                                      
                                                    </tr>
                                                    @php
                                                    $totalPrice += $orders->totalPrice;
                                                @endphp
                                                    @endforeach
                                                   
                                                </tbody>
                                        </tr>
                                </table>
                                <div class="form-group row py-0 my-0 ">
                                        <h6 label for="totalIncome" class="col-sm-4 pt-2" id="reportGrandTotal" style="font-size:1em; margin-left:30em; margin-bottom:2em;">Gross Sales: ₱{{number_format($totalPrice, 2)}}</label></h6>
                                           <!-- <input class="form-control-plaintext col-sm-8"  type="number" name="totalIncome" value="0000.00"> -->
                                           @endif
                                           <button id="printReport">Print Report</button>    
                                   </div>
                </div>
            </div>
        </div> 
    </div>
@endsection