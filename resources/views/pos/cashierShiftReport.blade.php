@extends('layouts.app')

@section('content')
    <div class="container pb-5">
            <div class="card col-md-8 offset-md-2 col-sm-12 py-4 ">
                <div class="row">
                    <div class="col-md-8 col-sm-8 px-5 pt-3">
                        <h4 class=""> Cashier Shift Report </h4>
                        @if(isset($display))
                        <h6 class=""> {{\Carbon\Carbon::parse($display)->format('F j, o')}} </h6>
                        @else
                        <h6 class=""> {{\Carbon\Carbon::now()->format('F j, o')}}</h6>
                        @endif
                        <div class="form-group row py-0 my-0">
                            <label for="name" class="col-sm-4 pt-2" style="font-size:0.80em;">Name:</label>
                            <input class="form-control-plaintext col-sm-8" type="text" name="name" value="Sheila Yu" readonly>
                        </div>
                        <div class="form-group row py-0 my-0">
                            <label for="shiftDuration" class="col-sm-4 pt-2" style="font-size:0.80em;">Shift Duration:</label>
                            <input class="form-control-plaintext col-sm-8" type="text" name="shiftDuration" value="9:00 AM - 8:00 PM" readonly>
                        </div>
                        <div class="form-group row py-0 my-0">
                            <label for="cashStart" class="col-sm-4 pt-2" style="font-size:0.80em;">Cash Start:</label>
                            <input class="form-control-plaintext col-sm-8" type="text" name="cashStart" value="₱ 1800.00" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <img src={{asset('logo.png')}} class="float-right" style="height:7.5em; width:9.75em;" aria-hidden="true"></img>
                    </div>
                </div>
                <div class="card-body">
                    <div class="px-2">
                        <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <thead>
                            <tr>
                            <td class="text-center"> No. </td>
                                    <td class="text-center"> Description </td>
                                    <td class="text-center" style="width:7%;"> Qty. </td>
                                    <td class="text-center" style="width:14%;"> Unit Price </td>
                                    <td class="text-center" style="width:14%;"> Total Price </td>
                                    <td class="text-center" style="width:14%;"> Amount Pd. </td>
                                    <td class="text-center" style="width:14%;"> Change Due </td>
                                    <td class="text-center"> Payment time </td>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($shifts) > 1)
                                @foreach($shifts as $shift)
                                    <tr class="">
                                      <td class="text-center">{{$shift->orderID}}</td>
                                       <td class="text-center">{{$shift->productName}}</td>
                                       <td class="text-center">{{$shift->quantity}}</td>
                                       <td class="text-right">{{$shift->price}}</td>
                                       <td class="text-right">{{$shift->totalPrice}}</td>
                                       <td class="text-right">{{number_format((float)($shift->amount), 2, '.', '')}}</td>
                                       <td class="text-right">{{number_format((float)($shift->changeDue), 2, '.', '')}}</td>
                                       <td class="text-center">{{\Carbon\Carbon::parse($shift->paymentDatetime)->format('M j, Y')}}</td>
                                   </tr>
                            </tbody>
                            @endforeach
                                     @endif
                        </table>
                    </div>
                    <div class="form-group row py-0 my-0 col-md-8">
                        <label for="cashEnd" class="col-sm-4 pt-2" style="font-size:0.80em;">Cash End:</label>
                        <input class="form-control-plaintext col-sm-8" type="text" name="cashEnd" value="₱" readonly>
                    </div>
                    <div class="form-group row py-0 my-0 col-md-8">
                        <label for="shiftSales" class="col-sm-4 pt-2" style="font-size:0.80em;">Total Sales: </label>
                        <input class="form-control-plaintext col-sm-8" type="text" name="name" value="₱" readonly>
                    </div>
                    <button type="button" class="btn btn-primary float-right mx-3" style="" id="" data-toggle="" data-target="">
                        Change Register
                    </button>
                </div>
            </div> 
        </div>      
    </div>
@endsection