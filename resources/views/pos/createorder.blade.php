@extends('layouts.app')

@section('content')
    <div class="col-md-12 text-center pos-tabs pb-1">
        <nav class="nav nav-pills centered-pills py-2">
            <a class="nav-item nav-link active" style="background-color:#060f0ed4;" href="#">Create Order</a>
            <a class="nav-item nav-link" style="color:#505050" href="/view-tables">View Tables</a>
        </nav>
    </div>
    <div class="container-fluid col-md-12 pb-5 pt-4 px-5">
        <div class="row">
            <div class="col-md-4 mb-4 mx-0">
                <div class="card p-0 m-0">
                    <h4 class="text-muted text-center py-3">Order Slip</h4>
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
            <div class="row col-md-8">
                <div class="col-md-3 pr-0">
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

                <div class="card col-md-9 m-0 ml-0" style="height:24.5em; width: 30em;"> 
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
@endsection