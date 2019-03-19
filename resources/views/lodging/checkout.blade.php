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
                    <h4 class="text-muted" style="text-align:center; padding:0.5em;">Transactions</h4>
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
                            @php
                                $total = 0;
                            @endphp
                            @foreach($charges as $charge)
                            <tr>
                                <td>{{$charge->serviceName}}</td>
                                <td style="text-align:right;">{{$charge->numberOfPax}}</td>
                                <td style="text-align:right;">{{$charge->price}}</td>
                                <td style="text-align:right;">{{($charge->totalPrice)}}</td>
                            </tr>
                            @php
                                $total += $charge->totalPrice;
                            @endphp
                            @endforeach
                            {{--@foreach ( as )
                            <tr>
                                <td>Airsoft</td>
                                <td style="text-align:right;">3</td>
                                <td style="text-align:right;">4500.00</td>
                            </tr>
                            @endforeach--}}
                            <tr>
                                <th colspan="3" scope="row">TOTAL:</th>
                                <th style="text-align:right;">{{$total}}</th>
                            </tr>
                        </tbody>
                    </table>
                    <!--button class="btn btn-danger" type="submit">Check-out</button-->
                </form>
            </div>
            <div class="col-md-8 order-md-1 check-out-form">
                <form>
                    <div class="form-group row">
                        <div class="col-md-2 mb-1">
                            <label for="accommodationID">Acc ID</label>
                            <input class="form-control" type="text" name="accommodationID" placeholder="" value="{{$guestDetails->accommodationID}}" disabled>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="unitID">No. of units</label>
                            <input class="form-control" type="number" name="numberOfUnits" placeholder="" value="" min="1" max="6" disabled>
                        </div>
                        <div class="col-md-7 mb-1">
                            <label for="unitNumber">Unit/s availed</label>
                            <input class="form-control" type="text" name="unitNumber" placeholder="" value="{{$guestDetails->unitNumber}}" disabled>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <h5 style="margin-bottom:.80em;">Guest Details</h5>
                    <div class="form-group row">
                        <div class="col-md-5 mb-1">
                            <label for="firstName">First name</label>
                            <input class="form-control" type="text" name="firstName" maxlength="15" placeholder="" value="{{$guestDetails->firstName}}" disabled>
                        </div>
                        <div class="col-md-7 mb-1">
                            <label for="lastName">Last name</label>
                            <input class="form-control" type="text" name="lastName"  maxlength="20" placeholder="" value="{{$guestDetails->lastName}}" disabled>
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
                                <input class="form-control" type="text" name="contactNumber" maxlength="11" placeholder="" value="{{$guestDetails->contactNumber}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control" type="number" name="numberOfPax" placeholder="" value="{{$guestDetails->numberOfPax}}" min="1" max="10" disabled>
                        </div>
                        <div class="col-md-4 mb-1 form-group">
                            <label for="accommodationType">Accommodation</label>
                            <select id="disabledSelect" name="serviceName" class="form-control" disabled>
                                <option>{{$guestDetails->serviceName}}</option>
                            </select>
                        </div>
                    </div>
                    {{--<hr class="mb-4">
                    <h5 style="margin-bottom:.80em;">Unit Details</h5>
                    <div class="form-group row">
                        <div class="col-md-2 mb-1">
                            <label for="unitID">No. of units</label>
                            <input class="form-control" type="number" name="numberOfUnits" placeholder="" value="" min="1" max="6" disabled>
                        </div>
                        <div class="col-md-10 mb-1">
                            <label for="unitNumber">Unit/s</label>
                            <input type="text" class="form-control" id="tokenfield" value="Tent 1, Tent 2" />
                        </div>
                    </div>--}}
                    <div class="form-group row">
                        <div class="col-md-6 mb-1">
                            <label for="checkInDatetime">Check-in date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @php
                                    $checkedIn = new DateTime($guestDetails->checkinDatetime);
                                    $checkedInAt = $checkedIn->format("F j, o");
                                @endphp
                            <input class="form-control" type="text" name="checkedInAt" placeholder="" value="{{$checkedInAt}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="checkoutDatetime">Check-out date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                @php
                                    $checkOut = new DateTime($guestDetails->checkoutDatetime);
                                    $checkOutAt = $checkOut->format("F j, o");
                                @endphp
                            <input class="form-control" type="text" name="checkOutAt" placeholder="" value="{{$checkOutAt}}" disabled>
                            </div>
                        </div>
                        {{--<div class="col-md-4 mb-1 form-group">
                            <label for="numberOfPax">Stay duration as of now</label>
                                @php
                                    $checkin = new DateTime($guestDetails->checkinDatetime);
                                    $now = new DateTime("now");
                                    $stayDuration = date_diff($checkin, $now)->days+1;
                                @endphp
                            <input class="form-control" type="number" name="stayDuration" placeholder="" value="{{$stayDuration}}" disabled>
                        </div>--}}
                    </div>

                    {{--@if (count($accompanyingGuest) > 0)
                    <hr class="mb-4">
                    <h5 style="margin-bottom:.80em;"data-toggle="collapse" data-target="#collapseAccompanyingGuests" aria-expanded="false" aria-controls="collapseAccompanyingGuests">Accompanying Guests</h5>
                    <div id="collapseAccompanyingGuests" class="collapse">
                        <div class="form-group row">
                            <div class="col-md-5 mb-1">
                                <label for="firstName{{$loop->iteration}}">First Name</label>
                            @foreach ($accompanyingGuest as $company)
                                <input class="form-control mb-2" type="text" name="firstName{{$loop->iteration}}" placeholder="" value="{{$company->firstName}}">
                            @endforeach
                            </div>
                            <div class="col-md-7 mb-1">
                                <label for="lastName{{$loop->iteration}}">Last Name</label>
                            @foreach ($accompanyingGuest as $company)
                                <input class="form-control mb-2" type="text" name="lastName{{$loop->iteration}}" placeholder="" value="{{$company->lastName}}">
                            @endforeach
                            </div>
                        </div>
                    </div>
                    @endif--}}
                    <hr class="mb-4">
                    <form action="#" class="additionalServiceForm">
                        @csrf
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        <div class="col-md-12 mb-1">
                            <h5 style="margin-bottom:.80em;">Damage Charges</h5>
                        </div>
                        <input type="hidden" name="additionalServiceAccommodationID" value="{{$guestDetails->accommodationID}}">
                        <div class="col-md-3 mb-1">
                            <label for="additionalServiceName">Charge</label>
                            <select name="additionalServiceName" id="serviceSelect" class="form-control serviceSelect">
                                <option value="" selected disabled >Choose...</option>
                                <option value="6">Airsoft</option>
                                <option value="7">Archery</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-1">
                            <label for="additionalServiceNumberOfPax">Qty</label>
                            <input class="form-control paxSelect" type="number" id="additionalServiceNumberOfPax" name="additionalServiceNumberOfPax" placeholder="" value="" min="1" max="10">
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="additionalServiceUnitPrice">Unit price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input class="form-control" type="text" id="additionalServiceUnitPrice" name="additionalServiceUnitPrice" placeholder="" value="" disabled>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="additionalServiceTotalPrice">Total price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input class="form-control" type="text" id="additionalServiceTotalPrice" name="additionalServiceTotalPrice" placeholder="" value="" disabled>
                            </div>
                        </div>

                        <div style="margin-top:2em;">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary additionalServiceForm">
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                

                        {{--<div style="">
                            <div class="input-group">
                                <button type="submit" class="btn btn-danger additionalServiceForm">
                                    <span class="fa fa-minus" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>

                        
                        <div class="col-md-3 mb-1">
                            <select name="additionalServiceName" id="serviceSelect" class="form-control serviceSelect">
                                <option value="" selected disabled >Choose...</option>
                                <option value="6">Airsoft</option>
                                <option value="7">Archery</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-1">
                            <input class="form-control paxSelect" type="number" id="additionalServiceNumberOfPax" name="additionalServiceNumberOfPax" placeholder="" value="" min="1" max="10">
                        </div>
                        <div class="col-md-3 mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input class="form-control" type="text" id="additionalServicePrice" name="additionalServicePrice" placeholder="" value="" disabled>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input class="form-control" type="text" id="additionalServicePaymentAmount" name="additionalServicePaymentAmount" placeholder="" value="">
                            </div>
                        </div>

                        <div style="">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary additionalServiceForm">
                                    <span class="fa fa-p-lus" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>
                        -->
                        <!--div class="col-md-1">
                            <button class="btn btn-info">
                                <span class="fa fa-plus" aria-hidden="true"></span>
                            </button>
                        </div-->
                    </div>
                    </form>--}}
                    <input class="form-control" type="number" name="numberOfAdditionalCharges" value="1" style="display:none; position:absolute;">
                    <input class="form-control" type="text" name="serviceID1" value="6" style="display:none; position:absolute;">
                    <input class="form-control" type="number" name="numberOfPaxAdditional1" value="5" style="display:none; position:absolute;">
                    <input class="form-control" type="text" name="paymentStatus1" value="paid" style="display:none; position:absolute;">
                    <!--div class="container">
                        <table id="guest-table" class="table guest-list">   
                            <tbody>
                                <thead>
                                    <tr class="row">
                                        <td class="col-md-4 mb-1">
                                            First name
                                        </td>
                                        <td class="col-md-4 mb-1">
                                            Last name
                                        </td>
                                        <td class="col-md-3 mb-1">
                                            Phone
                                        </td>
                                        <td class="col-md-1 mb-1"></td>
                                    </tr>
                                </thead>
                                <tr class="row">
                                    <td class="col-md-4 mb-1">
                                        <input class="form-control" type="text" id="firstName" placeholder="" value="Ian Jemuel">
                                    </td>
                                    <td class="col-md-4 mb-1">
                                        <input class="form-control" type="text" id="lastName" placeholder="" value="Culanag">
                                    </td>
                                    <td class="col-md-3 mb-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" type="text" id="contactNumber" placeholder="" value="09709849000">
                                        </div>
                                    </td>
                                    <td class="col-md-1">
                                        <input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete">
                                    </td>
                                </tr>
                                <tr class="row">
                                    <td class="col-md-4 mb-1">
                                        <input type="text" id="firstName" class="form-control" />
                                    </td>
                                    <td class="col-md-4 mb-1">
                                        <input type="mail" id="lastName"  class="form-control"/>
                                    </td>
                                    <td class="col-md-3 mb-1">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                                </span>
                                            </div>
                                            <input class="form-control" type="text" id="contactNumber">
                                        </div>
                                    </td>
                                    <td class="col-sm-1">
                                        <input type="button" class="ibtnDel btn btn-md btn-danger" value="Delete">
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" style="text-align: left;">
                                        <input type="button" class="btn btn-info btn-sm btn-block" id="addrow" value="Add Row" />
                                    </td>
                                </tr>
                                <tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div-->
                    
                    <div class="mt-3" style="float:right;">
                        <button class="btn btn-success" style="width:10em;" type="submit">Checkout</button>
                        <a href="/glamping" style="text-decoration:none;">
                            <button class="btn btn-secondary" style="width:10em;" type="button">Cancel</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
 