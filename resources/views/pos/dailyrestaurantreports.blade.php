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
                        <img src={{asset('logo.jpg')}} class="float-left" style="height:7.5em; width:9.75em;" aria-hidden="true"></img>
                    </div>
                    <div class="col-md-6 col-sm-8 px-5 pt-3">
                        <h6 class="text-right"> Restaurant Sales Report </h6>
                        <h6 class="text-right"> {{\Carbon\Carbon::now()->format('F j, o')}}</h6>
                    </div>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div> 
    </div>
@endsection