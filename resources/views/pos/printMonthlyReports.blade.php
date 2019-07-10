@extends('layouts.noSidebar')

@section('content')
    <div class="container row pb-5 pt-3">
        <div id="dateFilter"> 
        <div class="col-md-2 float-right mx-5 pl-4" style="position:fixed; right:0;">
                <h2>Month Filter</h2>
            <form method="POST" action="/reload-monthly-restaurant-report">
                @csrf
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="row px-3">
                    <div class="form-group col-md-5 px-0 mr-1">
                        <div class="input-group input-group-sm">
                            <select class="form-control" name="selectMonth">
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option selected>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                            </select>
                        {{--@if(isset($month))
                            <select class="form-control" name="selectMonth">
                                <option value="01" {{$month == '01' ? 'selected' : '' }}>Jan</option>
                                <option value="02" {{$month == '02' ? 'selected' : '' }}>Feb</option>
                                <option value="03" {{$month == '03' ? 'selected' : '' }}>Mar</option>
                                <option value="04" {{$month == '04' ? 'selected' : '' }}>Apr</option>
                                <option value="05" {{$month == '05' ? 'selected' : '' }}>May</option>
                                <option value="06" {{$month == '06' ? 'selected' : '' }}>Jun</option>
                                <option value="07" {{$month == '07' ? 'selected' : '' }}>Jul</option>
                                <option value="08" {{$month == '08' ? 'selected' : '' }}>Aug</option>
                                <option value="09" {{$month == '09' ? 'selected' : '' }}>Sep</option>
                                <option value="10" {{$month == '10' ? 'selected' : '' }}>Oct</option>
                                <option value="11" {{$month == '11' ? 'selected' : '' }}>Nov</option>
                                <option value="12" {{$month == '12' ? 'selected' : '' }}>Dec</option>
                            </select>
                        @endif--}}
                        </div>
                    </div>
                    <div class="form-group col-md-4 px-0 ">
                        <div class="input-group input-group-sm">
                        @if(isset($year))
                            <input class="form-control" type="number" name="selectYear" min="2018" max="{{$thisYear}}" value="{{$year}}" required>
                        @endif
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
        </div>
        <div class="container col-md-10 col-sm-12">
            <div class="card col-md-10 offset-md-1 col-sm-12 py-4 ">
                <div class="row">
                    <div class="col-md-6 col-sm-4">
                        <img src={{asset('logo.png')}} class="float-left" style="height:7.5em; width:9.75em;" aria-hidden="true"></img>
                    </div>
                    <div class="col-md-6 col-sm-8 px-5 pt-3">
                        <h6 class="text-right"> Restaurant Sales Report </h6>
                        @if(isset($display))
                        <h6 class="text-right"> {{$display}} </h6>
                        @else
                        <h6 class="text-right"> {{\Carbon\Carbon::now()->format('F o')}} </h6>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                <div class="row">
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
                                                      <td class="text-right">{{$orders->totalPrice}}</td>
                                                      <td class="text-right">{{\Carbon\Carbon::parse($orders->orderDatetime)->format('M j, Y')}}</td>
                                                    </tr>
                                                    @php
                                                    $totalPrice += $orders->totalPrice;
                                                @endphp
                                                @endforeach     
                                     </tbody>
                                  </table>
                                 <div class="form-group row py-0 my-0 ">
                                    <h6 label for="totalIncome" class="col-sm-4 pt-2" style="font-size:1em; margin-left:30em; margin-bottom:2em;">Gross Sales: ₱{{number_format($totalPrice, 2)}}</label></h6>
                                       <!-- <input class="form-control-plaintext col-sm-8"  type="number" name="totalIncome" value="0000.00"> -->
                                       @endif
                                       <button id="printReport">Print Report</button>                                         
                          </div>
                 </div> 
            </div>
        </div> 
    </div>
@endsection