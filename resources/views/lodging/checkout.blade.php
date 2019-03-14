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
                                <th scope="col" style="width:55%">Desciption</th>
                                <th scope="col">Qty.</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$guestDetails->serviceName}}</td>
                                <td style="text-align:right;">{{$guestDetails->numberOfPax}}</td>
                                <td style="text-align:right;">{{$guestDetails->price}}</td>
                                <td style="text-align:right;">{{($guestDetails->price)*($guestDetails->numberOfPax)}}</td>
                            </tr>
                            {{--@foreach ( as )
                            <tr>
                                <td>Airsoft</td>
                                <td style="text-align:right;">3</td>
                                <td style="text-align:right;">4500.00</td>
                            </tr>
                            @endforeach--}}
                            <tr>
                                <th colspan="3" scope="row">TOTAL:</th>
                                {{--@php
                                    if (count($services) > 0) {
                                        $sum = 0;
                                        foreach() {

                                        }
                                    }
                                @endphp--}}
                                <th style="text-align:right;">{{($guestDetails->price)*($guestDetails->numberOfPax)}}</th>
                            </tr>
                            <thread>
                                <th colspan="3" scope="row">Remaining balance:</td>
                                <th style="text-align:right;">{{($guestDetails->price)*($guestDetails->numberOfPax)}}</td>
                            </thread>
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
                        <div class="col-md-12 mb-1">
                            <p>Additional Charges</p>
                            <table class="table table-sm col-md-12 mb-1 table-bordered">
                                <thread>
                                    <th scope="col" width="40%">Service name</th>
                                    <th scope="col" width="10%">Pax</th>
                                    <th scope="col" width="20%">Price</th>
                                    <th scope="col" width="20%">Payment Status</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Airsoft</td>
                                        <td style="text-align:right">3</td>
                                        <td style="text-align:right">3000</td>
                                        <td style="text-align:right">3000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--hr class="mb-4">
                    <div class="form-group row">
                        <div class="col-md-12 mb-1">
                            <h5 style="margin-bottom:.80em;">Additional Services</h5>
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="additionalServiceName">Service name</label>
                            <select name="additionalServiceName" class="form-control" disabled>
                                <option>Airsoft</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-1">
                            <label for="additionalServiceNumberOfPax">Pax</label>
                            <input class="form-control" type="number" name="additionalServiceNumberOfPax" placeholder="" value="" min="1" max="10" disabled>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="additionalServicePrice">Price</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="additionalServicePrice" maxlength="11" placeholder="" value="₱ " disabled>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="additionalServiceAmountPaid">Amount Paid</label>
                            <div class="input-group">
                                set amount limit input as the value of price
                                <input class="form-control" type="text" name="additionalServiceAmountPaid" placeholder="" value="₱" disabled>
                            </div>
                        </div>
                    </div-->

                    @if (count($accompanyingGuest) > 0)
                    <hr class="mb-4">
                    <h5 style="margin-bottom:.80em;">Accompanying Guests</h5>
                    <div class="form-group row pb-3">
                        <div class="col-md-5 mb-1">
                            <label for="firstName{{$loop->iteration}}">First Name</label>
                        @foreach ($accompanyingGuest as $company)
                            <input class="form-control mb-3" type="text" name="firstName{{$loop->iteration}}" placeholder="" value="{{$company->firstName}}" disabled>
                        @endforeach
                        </div>
                        <div class="col-md-7 mb-1">
                            <label for="lastName{{$loop->iteration}}">Last Name</label>
                        @foreach ($accompanyingGuest as $company)
                            <input class="form-control mb-3" type="text" name="lastName{{$loop->iteration}}" placeholder="" value="{{$company->lastName}}" disabled>
                        @endforeach
                        </div>
                    </div>
                    @endif

                    <!--div class="panel-group" style="margin-bottom:2em;">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h6 class="panel-title">
                                    <a class="check-out-form" data-toggle="collapse" href="#collapse1">Accompanying guests</a>
                                </h6>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <ul class="list-group">
                                    <li class="list-group-item">Albren Jr. Cundangan</li>
                                </ul>
                            </div>
                        </div>
                    </div-->
                    <div style="float:right;">
                        <button class="btn btn-success" style="width:10em;" type="submit">Check-out</button>
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
 