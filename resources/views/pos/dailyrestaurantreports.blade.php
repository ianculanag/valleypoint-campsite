@extends('layouts.app')

@section('content')
    <div class="container row pb-5 pt-3">
        <div class="col-md-2 float-right mx-5 pl-4" style="position:fixed; right:0;">
            <nav class="nav nav-pills nav-stacked mb-5 pb-5" style="display:block;">
                <a class="nav-item nav-link reports-tabs text-center active" style="background-color:#060f0ed4;" href="#">Daily</a>
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="/this-weeks-restaurant-report">Weekly</a>
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="/this-months-restaurant-report">Monthly</a>
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="/custom-restaurant-report">Custom</a>
            </nav>
            <form method="POST" action="/reload-daily-restaurant-report">
                @csrf
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row px-3">
                    <div class="form-group col-md-9 px-0 mx-1">
                        <div class="input-group input-group-sm">
                            <input class="form-control restaurantReportDateInputs" id="restaurantReportDate" type="date" name="restaurantReportDate" value="<?php echo date("Y-m-d");?>" required>
                        </div>
                    </div>
                    <div class="col-md-2 px-0 mx-1">
                        <button class="btn btn-sm btn-success" type="submit">
                            <i class="fa fa-calendar-check" aria-hidden="true"></i>
                        </button>
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
                        <h6 class="text-right"> {{\Carbon\Carbon::now()->format('F j, o')}}</h6>
                    </div>
                </div>
                <div class="card-body">
                <div class="row">
                <div class="col-md-12">
                            <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <thread>
                                    <tr class="text-center">
                                        <th colspan="4"> Bar and Restaurant  </th>                                        
                                    </tr>
                                </thread>
                                <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <tbody>
                                    @if(count($productOrdered) > 1)
                                    @foreach($productOrdered as $orders)
                                    <tr class="">
                                      <td>{{$orders->productName}}</td>
                                      <td>{{$orders->productCategory}}</td>
                                      <td>{{$orders->quantity}}</td>
                                      <td>{{$orders->totalPrice}}</td>
                                    </tr>
                                    @endforeach
                                    @endif
                                 </tbody>
                        </table>
                              <div class="form-group row py-0 my-0 ">
                                  <h6 label for="totalIncome" class="col-sm-4 pt-2" style="font-size:1em; margin-left:30em; margin-bottom:2em;">Total Income: 0000.00</label></h6>
                                     <!-- <input class="form-control-plaintext col-sm-8"  type="number" name="totalIncome" value="0000.00"> -->
                             </div>
                     </div> 
                </div>
            </div>
        </div> 
    </div>
@endsection