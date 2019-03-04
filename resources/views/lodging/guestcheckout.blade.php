@extends('layouts.app')

@section('content')
    @foreach ($guest as $guestDetails)
    <div class="container">
        <div class="py-5 text-center">
            <a href="#">
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
                                <td>{{$guestDetails->accommodationType}}</td>
                                <td style="text-align:right;">{{$guestDetails->numberOfPax}}</td>
                                <td style="text-align:right;">{{$guestDetails->price}}</td>
                            </tr>
                            <tr>
                                <td>Airsoft</td>
                                <td style="text-align:right;">3</td>
                                <td style="text-align:right;">4500.00</td>
                            </tr>
                            <tr>
                                <th colspan="2" scope="row">TOTAL:</th>
                                <th style="text-align:right;">8500.00</th>
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
                            <input class="form-control" type="text" id="accommodationID" placeholder="" value="{{$guestDetails->accommodationID}}" disabled>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="unitID">Unit ID</label>
                            <input class="form-control" type="text" id="unitID" placeholder="" value="{{$guestDetails->unitID}}" disabled>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="unitNumber">Unit number</label>
                            <input class="form-control" type="text" id="unitNumber" placeholder="" value="{{$guestDetails->unitNumber}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-5 mb-1">
                            <label for="firstName">First name</label>
                            <input class="form-control" type="text" id="firstName" placeholder="" value="{{$guestDetails->firstName}}" disabled>
                        </div>
                        <div class="col-md-7 mb-1">
                            <label for="lastName">Last name</label>
                            <input class="form-control" type="text" id="lastName" placeholder="" value="{{$guestDetails->lastName}}" disabled>
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
                                <input class="form-control" type="text" id="contactNumber" placeholder="" value="{{$guestDetails->contactNumber}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control" type="number" id="contactNumber" placeholder="" value="{{$guestDetails->numberOfPax}}" disabled>
                        </div>
                        <div class="col-md-4 mb-1 form-group">
                            <label for="accommodationType">Accommodation</label>
                            <select id="disabledSelect" class="form-control" disabled>
                                <option>{{$guestDetails->accommodationType}}</option>
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
                            <input class="form-control" type="date" id="contactNumber" placeholder="" value="{{$guestDetails->checkinDatetime}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6 mb-1 form-group">
                            <label for="numberOfPax">Stay duration</label>
                                @php
                                   /*$earlier = $guestDetails->checkinDatetime;
                                    $later = $guestDetails->checkoutDatetime;

                                    $diff = $later->diff($earlier)->format("%a");*/
                                @endphp
                            <input class="form-control" type="number" id="numberOfPax" placeholder="" value="1" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 mb-1 form-group">
                            <label for="additionalServices">Additional charges</label>
                            <textarea class="form-control" id="additionalServices" rows="3" disabled>Airsoft (2 pax)</textarea>
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
                                    <li class="list-group-item">Ian Jemuel Culanag</li>
                                    <li class="list-group-item">Albren Jr. Cundangan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div style="float:right;">
                        <button class="btn btn-info" style="width:10em;" type="submit">Check-out</button>
                        <button class="btn btn-danger" style="width:10em;" type="submit">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
 