@extends('layouts.app')

@section('content')
    <div class="container row pb-5 pt-3">
        <div class="col-md-2 float-right mx-5 pl-4" style="position:fixed; right:0;">
            <nav class="nav nav-pills nav-stacked mb-5 pb-5" style="display:block;">
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="/todays-restaurant-report">Daily</a>
                <a class="nav-item nav-link reports-tabs text-center active" style="background-color:#060f0ed4;" href="#">Weekly</a>
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
                        <img src={{asset('logo.jpg')}} class="float-left" style="height:7.5em; width:9.75em;" aria-hidden="true"></img>
                    </div>
                    <div class="col-md-6 col-sm-8 px-5 pt-3">
                        <h6 class="text-right"> Restaurant Sales Report </h6>
                        <h6 class="text-right"> {{\Carbon\Carbon::now()->format('F j, o')}} - {{\Carbon\Carbon::now()->format('F j, o')}}</h6>
                    </div>
                </div>
                <div class="card-body">
                        <div class="col-md-6">
                                <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <tr>
                                <th>Category</th>
                                <th>Amount</th>
                                <th>Sales</th>
                            <tbody>
                                <tr>
                                    <td>Appetizers</td>
                                    <td>23</td>
                                    <td>7000</td>
                                </tr>
        
                                <tr>
                                    <td>Breads</td>
                                    <td>18</td>
                                    <td>2000</td>
                                </tr>
                                
                                <tr>
                                    <td>Breakfasts</td>
                                    <td>37</td>
                                    <td>7900</td>
                                </tr>
        
                                <tr>
                                    <td>Group Meals</td>
                                    <td>20</td>
                                    <td>9877</td>
                                </tr>
        
                                <tr>
                                    <td>Noodles</td>
                                    <td>2</td>
                                    <td>300</td>
                                </tr>
            
                                <tr>
                                    <td>Rice Bowls</td>
                                    <td>3</td>
                                    <td>870</td>
                                </tr>
                                    
                                <tr>
                                    <td>Soups</td>
                                    <td>2</td>
                                    <td>200</td>
                                </tr>
            
                                <tr>
                                    <td>Special Rice Meals</td>
                                    <td>2</td>
                                    <td>500</td>
                                </tr>
        
                                <tr>
                                    <td>Extras</td>
                                    <td>2</td>
                                    <td>200</td>
                                </tr>
                
                                <tr>
                                    <td>Beverages</td>
                                    <td>120</td>
                                    <td>10000</td>
                                </tr>
                                        
                                <tr>
                                    <td>Liquors</td>
                                    <td>100</td>
                                    <td>15000</td>
                                </tr>
        
                                <tr>
                                    <td>Gross Sales</td>
                                    <td></td>
                                    <td>Total</td>
                                </tr>
                            </tbody>
                        </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection