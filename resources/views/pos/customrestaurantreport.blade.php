@extends('layouts.app')

@section('content')
    <div class="container row pb-5 pt-3">
        <div class="col-md-2 float-right mx-5 pl-4" style="position:fixed; right:0;">
            <nav class="nav nav-pills nav-stacked mb-5 pb-5" style="display:block;">
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="/todays-restaurant-report">Daily</a>
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="/custom-restaurant-report">Weekly</a>
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="/this-months-restaurant-report">Monthly</a>
                <a class="nav-item nav-link reports-tabs text-center active" style="background-color:#060f0ed4;" href="#">Custom</a>
            </nav>
            <form method="POST" action="/reload-custom-restaurant-report">
                @csrf
                <div class="px-1">
                    <div class="form-group row px-0 mx-0">
                        <label for="displayFrom" class="col-md-3 mb-0 mt-2 p-0">From:</label>
                        <div class="input-group input-group-sm col-md-9 px-0 mx-0">
                            {{--@if(isset($displayfrom))
                            <input class="form-control restaurantReportDateInputs" type="date" name="displayFrom" value="{{$displayfrom}}" required>
                            @else--}}
                            <input class="form-control restaurantReportDateInputs" type="date" name="displayFrom"value="<?php echo date("Y-m-d");?>" required>
                            {{--@endif--}}
                        </div>
                    </div>
                    <div class="form-group row px-0 mx-0">
                        <label for="displayTo" class="col-md-3 mb-0 mt-2 p-0">To:</label>
                        <div class="input-group input-group-sm col-md-9 px-0 mx-0">
                            <input class="form-control restaurantReportDateInputs" type="date" name="displayFrom" value="<?php echo date("Y-m-d");?>" required>
                            {{--@if(isset($displayto))
                            <input class="form-control restaurantReportDateInputs" type="date" name="displayTo" value="{{$displayto}}" required>
                            @endif--}}
                        </div>
                    </div>
                    <div class="px-0 mx-0">
                        <button class="btn btn-sm btn-block btn-success" type="submit">
                            Load
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
                </div>
            </div>
        </div> 
    </div>
@endsection