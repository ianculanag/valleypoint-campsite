@extends('layouts.app')

@section('content')
    @foreach ($guest as $guestDetails)
        <div class="py-5 text-center">
            <a href="/glamping">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Edit Transaction Details</h3>
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
                                <th colspan="2" scope="row">TOTAL:</th>
                                {{--@php
                                    if (count($services) > 0) {
                                        $sum = 0;
                                        foreach() {

                                        }
                                    }
                                @endphp--}}
                                <th style="text-align:right;">{{($guestDetails->price)*($guestDetails->numberOfPax)}}</th>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-danger" type="submit">Check-out</button>
                </form>
            </div>
            <div class="col-md-8 order-md-1 check-out-form">
                <form method="POST" action="/updateDetails">
                    @csrf
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
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
                         <div class="form-group col-md-6" style="position: absolute;">
                    <input type="text" name="guestID" required="required" class="form-control" style="display:none" value={{$guestDetails->guestID}}>
                        <input style="display:none" class="form-control" type="text" name="unitID" value="{{$guestDetails->unitID}}">
                </div>
                    </div>
                    <hr class="mb-4">
                    <h5 style="margin-bottom:.80em;">Guest Details</h5>
                    <div class="form-group row">
                        <div class="col-md-5 mb-1">
                            <label for="firstName">First name</label>
                            <input class="form-control" type="text" name="firstName" maxlength="15" placeholder="" value="{{$guestDetails->firstName}}">
                        </div>
                        <div class="col-md-7 mb-1">
                            <label for="lastName">Last name</label>
                            <input class="form-control" type="text" name="lastName"  maxlength="20" placeholder="" value="{{$guestDetails->lastName}}">
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
                                <input class="form-control" type="text" name="contactNumber" maxlength="11" placeholder="" value="{{$guestDetails->contactNumber}}">
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control" type="number" name="numberOfPax" placeholder="" value="{{$guestDetails->numberOfPax}}" min="1" max="10" disabled>
                        </div>
                        <div class="col-md-3 mb-1" style="display:none; position:absolute;">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control"  type="number" name="numberOfPax" placeholder="" value="{{$guestDetails->numberOfPax}}" min="1" max="10">
                        </div>
                        <div class="col-md-4 mb-1 form-group">
                            <label for="accommodationType">Accommodation</label>
                            <select id="disabledSelect" name="serviceName" class="form-control" disabled>
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
                            <label for="additionalServices">Additional services</label>
                            <textarea class="form-control" name="additionalServices" rows="3" placeholder="None"></textarea>
                        </div>
                    </div>
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
                    @if (count($accompanyingGuest) > 0)
                    <hr class="mb-4">
                    <h5 style="margin-bottom:.80em;">Accompanying Guests</h5>
                    <div class="form-group row pb-3">
                        @foreach ($accompanyingGuest as $company)
                            <div class="col-md-5 mb-1">
                                <label for="firstName{{$loop->iteration}}">First Name</label>
                                <input class="form-control" type="text" name="firstName{{$loop->iteration}}" placeholder="" value="{{$company->firstName}}">
                            </div>
                            <div class="col-md-7 mb-1">
                                <label for="lastName{{$loop->iteration}}">Last Name</label>
                                <input class="form-control" type="text" name="lastName{{$loop->iteration}}" placeholder="" value="{{$company->lastName}}">
                            </div>
                        @endforeach
                        </div>
                    @endif
                    
                    <div style="float:right;">
                        <button class="btn btn-info" style="width:10em;" type="submit">Save Changes</button>
                        <a href="/glamping" style="text-decoration:none;">
                            <button class="btn btn-danger" style="width:10em;" type="button">Cancel</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection