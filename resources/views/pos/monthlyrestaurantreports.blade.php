@extends('layouts.app')

@section('content')
    <div class="container row pb-5 pt-3">
        <div class="col-md-2 float-right mx-5 pl-4" style="position:fixed; right:0;">
            <nav class="nav nav-pills nav-stacked mb-5 pb-5" style="display:block;">
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="/todays-restaurant-report">Daily</a>
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="/this-weeks-restaurant-report">Weekly</a>
                <a class="nav-item nav-link reports-tabs text-center active" style="background-color:#060f0ed4;" href="#">Monthly</a>
                <a class="nav-item nav-link reports-tabs text-center" style="color:#505050" href="/custom-restaurant-report">Custom</a>
            </nav>
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
                                <option selected>May</option>
                                <option>Jun</option>
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
                            <input class="form-control" type="number" name="selectYear" min="2018" max="" value="2019" required>
                        {{--@if(isset($year))
                            <input class="form-control" type="number" name="selectYear" min="2018" max="{{$thisYear}}" value="{{$year}}" required>
                        @endif--}}
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
                        <h6 class="text-right"> {{\Carbon\Carbon::now()->format('F o')}}</h6>
                    </div>
                </div>
                <div class="card-body">
                </div>
            </div>
        </div> 
    </div>
@endsection