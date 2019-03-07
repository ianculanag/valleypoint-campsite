@extends('layouts.app')

@section('content')
    @foreach ($guest as $guestDetails)
    <div class="container">
        <div class="py-5 text-center">
            <a href="/glamping">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Transaction Details</h3>
        </div>
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <form class="card p-2">
                    <h4 class="text-muted" style="text-align:center; padding:0.5em;">Invoice</h4>
                    <table class="table table-striped" style="font-size:.83em;">
                        <thead>
                            <tr>
                                <th scope="col" style="width:55%;">Availed Services</th>
                                <th scope="col">Pax</th>
                                <th scope="col">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$guestDetails->serviceName}}</td>
                                <td style="text-align:right;">{{$guestDetails->numberOfPax}}</td>
                                <td style="text-align:right;">{{$guestDetails->price}}</td>
                            </tr>
                            {{--@foreach ( as )
                            <tr>
                                <td>Airsoft</td>
                                <td style="text-align:right;">3</td>
                                <td style="text-align:right;">4500.00</td>
                            </tr>
                            @endforeach--}}
                            <tr>
                                <th colspan="2" scope="row">TOTAL:</th>
                                {{--@php
                                    if (count($services) > 0) {
                                        $sum = 0;
                                        foreach() {

                                        }
                                    }
                                @endphp--}}
                                <th style="text-align:right;">{{$guestDetails->price}}</th>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="col-md-8 order-md-1 check-out-form">
                <form>
                    <div class="form-group row">
                        <div class="col-md-3 mb-1">
                            <label for="accommodationID">Accommodation ID</label>
                            <input class="form-control" type="text" name="accommodationID" placeholder="" value="{{$guestDetails->accommodationsID}}" disabled>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="unitID">Unit ID</label>
                            <input class="form-control" type="text" name="unitID" placeholder="" value="{{$guestDetails->unitID}}" disabled>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="unitNumber">Unit number</label>
                            <input class="form-control" type="text" name="unitNumber" placeholder="" value="{{$guestDetails->unitNumber}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5 mb-1">
                            <label for="firstName">First name</label>
                            <input class="form-control" type="text" name="firstName" placeholder="" value="{{$guestDetails->firstName}}" disabled>
                        </div>
                        <div class="col-md-7 mb-1">
                            <label for="lastName">Last name</label>
                            <input class="form-control" type="text" name="lastName" placeholder="" value="{{$guestDetails->lastName}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5 mb-1">
                            <label for="contactNumber">Contact number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" name="contactNumber" placeholder="" value="{{$guestDetails->contactNumber}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control" type="number" name="numberOfPax" placeholder="" value="{{$guestDetails->numberOfPax}}" disabled>
                        </div>
                        <div class="col-md-4 mb-1 form-group">
                            <label for="accommodationType">Accommodation</label>
                            <select name="serviceName" id="disabledSelect" class="form-control" disabled>
                                <option>{{$guestDetails->serviceName}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 mb-1">
                            <label for="checkInDatetime">Check-in date and time</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @php
                                    $checkedIn = new DateTime($guestDetails->checkinDatetime);
                                    $checkedInAt = $checkedIn->format("F j, o h:i A");
                                @endphp
                            <input class="form-control" type="text" name="checkedInAt" placeholder="" value="{{$checkedInAt}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 form-group">
                            <label for="numberOfPax">Stay duration</label>
                                @php
                                    $checkin = new DateTime($guestDetails->checkinDatetime);
                                    $now = new DateTime("now");
                                    $stayDuration = date_diff($checkin, $now)->days+1;
                                @endphp
                            <input class="form-control" type="number" name="stayDuration" placeholder="" value="{{$stayDuration}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 mb-1 form-group">
                            <label for="additionalServices">Additional charges</label>
                            <textarea class="form-control" name="additionalServices" rows="3" disabled>None</textarea>
                        </div>
                    </div>
                    <div class="panel-group" style="margin-bottom:2em;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    <a class="check-out-form" data-toggle="collapse" href="#collapse1">Accompanying guests</a>
                                </h6>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <ul class="list-group">
                                    <!--li class="list-group-item">Ian Jemuel Culanag</li-->
                                    <li class="list-group-item">Albren Jr. Cundangan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div style="float:right;">
                        <button class="btn btn-info" style="width:10em;" type="submit">Check-out</button>
                        <a href="/glamping" style="text-decoration:none;">
                            <button class="btn btn-danger" style="width:10em;" type="button">Cancel</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
 