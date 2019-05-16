@extends('layouts.app')

@section('content')
<div class="container pb-5"> 
        <div class="py-3 text-center">
            <a href="{{ URL::previous() }}">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Order for Table #</h3>
        </div> 
            <div class="row">
                <div class="col-md-4 mb-4 mx-0" style="margin-top: 2.5em;">
                    <div class="card p-0 mx-0">
                        <h4 class="text-muted" style="text-align:center; padding:0.5em;">Order Slip</h4>
                        <table class="table table-sm table-striped" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:40%">Item Description</th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody id="orderSlip">
                                <tr>
                                    <td style="text-align:center" colspan="4">Add items from the menu</td>
                                    {{--<td>Tapsilog</td>
                                    <td>1</td>
                                    <td>99.00</td>
                                    <td>99.00</td>--}}
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" scope="row">TOTAL:</th>
                                    <th id="ordersGrandTotal" style="text-align:right;"></th>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <button type="button" class="btn btn-primary btn-block" style="text-align:center;">
                                            Get payment
                                        </button>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        
                         
                {{--<div class="col-md-8">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12  mx-0 bhoechie-tab-container">
                            <div class="col-lg-3 col-md-2 col-sm-3 col-xs-3 bhoechie-tab-menu">
                              <div class="list-group">
                                <a href="#" class="list-group-item active text-center">
                                  <span>Appetizers</span>
                                </a>
                                <a href="#" style="text-decoration:none !important;" class="list-group-item text-center">
                                  <span>Bread</span>
                                </a>
                                <a href="#" style="text-decoration:none !important;" class="list-group-item text-center">
                                  <span>Breakfast</span>
                                </a>
                                <a href="#" style="text-decoration:none !important;" class="list-group-item text-center">
                                  <span>Group Meals</span>
                                </a>
                                <a href="#" style="text-decoration:none !important;" class="list-group-item text-center">
                                  <span>Noodles</span>
                                </a>
                                <a href="#" style="text-decoration:none !important;" class="list-group-item text-center">
                                  <span>Rice Bowls</span>
                                </a>
                                <a href="#" style="text-decoration:none !important;" class="list-group-item text-center">
                                  <span>Soup</span>
                                </a>
                                <a href="#" style="text-decoration:none !important;" class="list-group-item text-center">
                                  <span>Beverages</span>
                                </a>
                              </div>
                            </div>
                            <div class="col-md-12 bhoechie-tab">
                                <!-- flight section -->
                                <div class="bhoechie-tab-content active">
                                    @foreach ($foods as $food)
                                    @if($food->foodCategory == 'appetizers')
                                        <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="px-1 mx-1" id="">       
                                            <div class="card px-0 mx-1" style="width:8.3rem; height:5em;">
                                                <div class="card-body  px-2 py-2 mx-0">
                                                <h6 class="card-title text-center">
                                                    {{$food->foodName}}
                                                </h6>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                                    @endforeach
                                </div>

                                <div class="bhoechie-tab-content">
                                </div>
                            </div>
                        </div>
                  </div>
                </div>
            </div>--}}
                <div class="row col-md-8">
                    <div class="col-md-3" style="margin-top: 3em;">
                        <div class="list-group">            
                            <a href="#" id="appetizer" class='list-group-item list-group-item makeorder' style="color:black">Appetizer</a>
                            <a href="#" id="bread" class='list-group-item list-group-item makeorder' style="color:black">Bread</a>
                            <a href="#" id="breakfast" class='list-group-item list-group-item makeorder' style="color:black">Breakfast</a>
                            <a href="#" id="groupMeals" class='list-group-item list-group-item makeorder' style="color:black">Group Meals</a>
                            <a href="#" id="noodles" class='list-group-item list-group-item makeorder' style="color:black">Noodles</a>
                            <a href="#" id="riceBowl" class='list-group-item list-group-item makeorder' style="color:black">Rice Bowl</a>
                            <a href="#" id="soup" class='list-group-item list-group-item makeorder' style="color:black">Soup</a>
                            <a href="#" id="beverages" class='list-group-item list-group-item makeorder' style="color:black">Beverages </a>
                        </div>
                    </div>

                    <div class="card col-md-9 mx-0" style="height:24.5em; width: 30em;margin-top: 3em;"> 
                        <div class="row p-3" id="Menu">
                        @foreach ($foods as $food)
                        @if($food->foodCategory == 'appetizers')
                            <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="px-1 mx-1" id="">       
                                <div class="card px-0 mx-1" style="width:8.3rem; height:5em;">
                                    <div class="card-body  px-2 py-2 mx-0">
                                    <h6 class="card-title text-center">
                                        {{$food->foodName}}
                                    </h6>
                                    </div>
                                </div>
                            </a>
                        @endif
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
                                {{-- @if($food->$foodCategory == 'bread')
                                <a data-toggle="modal" data-target="#view-details" style="cursor:pointer" class="" id="">       
                                    <div class="card mx-2" style="width:7rem; height:5em;">
                                        <div class="card-body">
                                        <h6 class="card-title">
                                            {{$food->foodName}}
                                        </h6>
                                        </div>
                                    </div></a>
                                @endif --}}     
                <!--/div-->
            

@endsection