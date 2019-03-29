@extends('layouts.app')

@section('content')
    @foreach ($guest as $guestDetails)
    <div class="container">
        <div class="pt-5 pb-3 text-center">
            <a href="/glamping">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Edit Transaction Details</h3>
        </div>
        <div class="row" role="tablist" aria-multiselectable="true">
            <div class="col-md-4 order-md-2 mb-4 mx-0 px-0">
                <!-- Payment Transactions Accordion -->
                <div id="accordion">
                    <!-- All Paid Transations -->
                    <form class="card my-0">
                        <p class="card-header" role="tab" id="headingOne">
                            <!--a class="collapsed d-block" data-toggle="collapse" href="#collapse-collapsed" aria-expanded="true" aria-controls="collapse-collapsed" id="heading-collapsed" style="font-size:1.1em;"-->
                            <a class="collapsed d-block" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-size:1.1em;">
                                <!--i class="fa fa-chevron-down pull-right" style="float:right;"></i-->
                                Paid Charges
                            </a>
                        </p>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body p-0">
                                <table class="table table-striped m-0 display nowrap transactionTable" style="font-size:.88em;">
                                    <thead>
                                        <tr>
                                        @if(count($payments) > 0)
                                            <th scope="col" style="width:55%">Desciption</th>
                                            <th scope="col">Qty.</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($payments as $payment)
                                        <tr>
                                            <td>{{$payment->serviceName}}</td>
                                            <td style="text-align:right;">{{$payment->quantity}}</td>
                                            <td style="text-align:right;">{{$payment->price}}</td>
                                            <td style="text-align:right;">{{$payment->totalPrice}}</td>
                                            </tr>
                                        @php
                                            $total = 0;
                                            $totalPayment = 0;
                                            $balance = 0;

                                            $total += $payment->totalPrice;
                                            $totalPayment += $payment->amount;
                                            $balance = $total - $totalPayment;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" scope="row">TOTAL:</th>
                                            <th style="text-align:right;">{{$total}}</th>
                                        </tr>
                                        {{--<tr>
                                            <th colspan="3" scope="row">Balance:</th>
                                            <th style="text-align:right;">{{$balance}}</th>
                                        </tr>
                                        <tr>
                                            <th colspan="1">Amount Paid:</th>
                                            <th style="text-align:right;"  colspan="3">
                                            <input type="number" name="amountPaid" placeholder="0" min="0" style="text-align:right;" class="form-control" id="amount" required>
                                            </th>
                                        </tr>--}}
                                    </tfoot>
                                    @else
                                        <th class="text-center">
                                            No pending payments to show
                                        </th>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </form>
                    <!-- Unpaid Charges -->
                    <form class="card my-0">
                        <p class="card-header" role="tab" id="headingTwo">
                            <a class="collapsed d-block" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="font-size:1.1em;">
                                <!--i class="fa fa-chevron-down pull-right" style="float:right;"></i-->
                                Pending Charges
                            </a>
                        </p>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body p-0">
                                <table class="table table-striped m-0 display nowrap transactionTable" style="font-size:.83em;">
                                    <thead>
                                        <tr>
                                        @if(count($pendingPayments) > 0)
                                            <th scope="col" style="width:55%">Desciption</th>
                                            <th scope="col">Qty.</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Total</th> 
                                            <th scope="col">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoiceRows">
                                        @foreach($pendingPayments as $pending)
                                        @php
                                            $total = 0;
                                            $totalPayment = 0;
                                            $balance = 0;
                                            $totalBalance = 0;

                                            $balance = $pending->totalPrice - $pending->amount;
                                            $total += $pending->totalPrice;
                                            $totalPayment += $pending->amount;
                                            $totalBalance = $total - $totalPayment;
                                        @endphp
                                        <tr>
                                            <td>{{$pending->serviceName}}</td>
                                            <td style="text-align:right;">{{$pending->quantity}}</td>
                                            <td style="text-align:right;">{{$pending->price}}</td>
                                            <td style="text-align:right;" class="invoicePrices">{{($pending->totalPrice)}}</td>
                                            <td style="text-align:right;">{{$balance}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" scope="row">TOTAL:</th>
                                            <th id="invoiceGrandTotal" style="text-align:right;">{{$total}}</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th colspan="4" scope="row">BALANCE:</th>
                                            <th style="text-align:right;">{{$totalBalance}}</th>
                                        </tr>
                                        {{--<tr>
                                            <th colspan="1">Amount Paid:</th>
                                            <th style="text-align:right;"  colspan="3">
                                            <input type="number" name="amountPaid" placeholder="0" min="0" style="text-align:right;" class="form-control" id="amount" required>
                                            </th>
                                        </tr>--}}
                                    </tfoot>
                                    @else
                                        <th class="text-center">
                                            No pending payments to show
                                        </th>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End of Payment Transactions Accordion -->
            </div>
            <div class="col-md-8 order-md-1 check-out-form">
                <form method="POST" action="/updateDetails">
                    @csrf
                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="form-group col-md-6" style="position: absolute;">
                        <input type="text" name="guestID" required="required" class="form-control" style="display:none" value="{{$guestDetails->guestID}}">
                        <input style="display:none" class="form-control" type="text" name="unitID" value="{{$guestDetails->unitID}}">
                    </div>
                    {{--<div class="form-group row">
                        <div class="col-md-2 mb-1">
                            <label for="accommodationID">Acc ID</label>
                            <input class="form-control" type="text" name="accommodationID" placeholder="" value="{{$guestDetails->accommodationID}}" disabled>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="unitID">No. of units</label>
                            <input class="form-control" type="number" name="numberOfUnits" placeholder="" value="{{$guestDetails->numberOfUnits}}" disabled>
                        </div>
                        <div class="col-md-7 mb-1">
                            <label for="unitNumber">Unit/s availed</label>
                            <input class="form-control" type="text" name="unitNumber" placeholder="" value="{{$guestDetails->unitNumber}}" disabled>
                        </div>
                    </div>
                    <hr class="mb-4">--}}
                    <h5 style="margin-bottom:.80em;" {{--data-toggle="collapse" data-target="#guestDetails" aria-expanded="false" aria-controls="collapseExample"--}}>Guest Details</h5>
                    <div {{--class="collapse"--}} id="guestDetails">
                        <div class="form-group row">
                            <div class="col-md-4 mb-1">
                                <label for="firstName">First name</label>
                                <input class="form-control" type="text" name="firstName" maxlength="15" placeholder="" value="{{$guestDetails->firstName}}">
                            </div>
                            <div class="col-md-5 mb-1">
                                <label for="lastName">Last name</label>
                                <input class="form-control" type="text" name="lastName"  maxlength="20" placeholder="" value="{{$guestDetails->lastName}}">
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="unitNumberOfPax">No. of pax</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input class="form-control numberOfPaxGlamping" name="numberOfPaxGlamping" type="number" placeholder="" value="{{$guestDetails->numberOfPax}}">
                                </div>
                            </div>
                        </div>
                        {{--<div class="col-md-3 mb-1">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control" type="number" name="numberOfPax" placeholder="" value="{{$guestDetails->numberOfPax}}" min="1" max="10">
                        </div>
                        <div class="col-md-4 mb-1 form-group">
                            <label for="accommodationType">Accommodation</label>
                            <select id="disabledSelect" name="serviceName" class="form-control" disabled>
                                <option>{{$guestDetails->serviceName}}</option>
                            </select>
                        </div>
                    </div>--}}
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
                            <div class="col-md-6 mb-1">
                                <label for="glamping">Accommodation</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="glamping" maxlength="11" placeholder="" value="Glamping" disabled>
                                </div>
                            </div>
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
                    <hr class="mb-4">

                    <h5 style="margin-bottom:.80em;">Unit Details</h5>
                    <div class="form-group row">
                        {{--<div class="col-md-2 mb-1">
                            <label for="unitID">No. of units</label>
                            {{--<input class="form-control" style="display:none;float:left;" type="number" name="numberOfUnits" placeholder="" value="1" min="1" max="10" disabled>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-campground" aria-hidden="true"></i>
                                    </span>
                                </div>
                            <input class="form-control" type="number" id="numberOfUnits" name="numberOfUnits" placeholder="" value="{{$guestDetails->numberOfUnits}}" min="1" max="80" readonly>
                            </div>
                        </div>
                        <div class="col-md-10 mb-1" id="divUnits">--}}
                        @if($guestDetails->numberOfUnits > 1)
                                <div class="col-md-1 mb-1" id="divUnitNumber">
                                    <input type="text" readonly class="form-control-plaintext" style="text-align:center;" value="" disabled>
                                    @foreach($otherUnits as $units)
                                    <input type="text" readonly class="form-control-plaintext mb-1" style="text-align:center; font-weight:bold;" value="{{$loop->iteration}}">
                                    @endforeach
                                </div>
                                <div class="col-md-2 mb-1" style="margin-left=0; padding-left:0;" id="divUnitNumber">
                                    <label for="unitNumber">Unit no.</label>
                                    @foreach($otherUnits as $units)
                                    <input type="text" class="form-control mb-1" value="{{$units->unitNumber}}" disabled>
                                    @endforeach
                                </div>
                                <div class="col-md-3 mb-1" id="divAccommodationPackage">
                                    <label for="additionalServiceUnitPrice">Package</label>
                                    @foreach($otherUnits as $units)
                                    <select class="form-control mb-1" name="accommodationType" id="accommodationType" readonly>
                                        <option>{{$units->serviceName}}</option>
                                    </select>
                                    {{--<select class="form-control mb-1" name="accommodationPackage{{$units->unitNumber}}" id="accommodationPackage{{$units->unitNumber}}" class="accommodationPackages">
                                        <option value="1">Solo</option>
                                        <option value="2">2 Pax</option>
                                        <option value="3">3 pax</option>
                                        <option value="4">4 pax</option>
                                    </select>--}}
                                    @endforeach
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label for="checkInDatetime">Check-in date</label>
                                     @foreach($otherUnits as $units)
                                    <div class="input-group mb-1">
                                        {{--<div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>--}}
                                        @php
                                            $checkedIn = new DateTime($guestDetails->checkinDatetime);
                                            $checkedInAt = $checkedIn->format("F j, o");
                                        @endphp
                                    <input class="form-control" type="text" name="checkedInAt" placeholder="" value="{{$checkedInAt}}" disabled>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label for="checkoutDatetime">Check-out date</label>
                                     @foreach($otherUnits as $units)
                                    <div class="input-group mb-1">
                                        {{--<div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>--}}
                                        @php
                                            $checkOut = new DateTime($guestDetails->checkoutDatetime);
                                            $checkOutAt = $checkOut->format("F j, o");
                                        @endphp
                                    <input class="form-control" type="text" name="checkOutAt" placeholder="" value="{{$checkOutAt}}" disabled>
                                    </div>
                                    @endforeach
                                </div>
                            {{--</div>--}}
                        @else 
                                <div class="col-md-3 mb-1" id="divUnitNumber">
                                    <label for="unitNumber">Unit no.</label>
                                    <input type="text" class="form-control mb-1" value="{{$guestDetails->unitNumber}}" disabled>
                                </div>
                                <div class="col-md-3 mb-1" id="divAccommodationPackage">
                                    <label for="additionalServiceUnitPrice">Package</label>
                                    <select class="form-control mb-1" name="accommodationType" id="accommodationType" readonly>
                                        <option>{{$guestDetails->serviceName}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label for="checkInDatetime">Check-in date</label>
                                    <div class="input-group mb-1">
                                        {{--<div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>--}}
                                        @php
                                            $checkedIn = new DateTime($guestDetails->checkinDatetime);
                                            $checkedInAt = $checkedIn->format("F j, o");
                                        @endphp
                                    <input class="form-control" type="text" name="checkedInAt" placeholder="" value="{{$checkedInAt}}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-1">
                                    <label for="checkoutDatetime">Check-out date</label>
                                    <div class="input-group mb-1">
                                        {{--<div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>--}}
                                        @php
                                            $checkOut = new DateTime($guestDetails->checkoutDatetime);
                                            $checkOutAt = $checkOut->format("F j, o");
                                        @endphp
                                    <input class="form-control" type="text" name="checkOutAt" placeholder="" value="{{$checkOutAt}}" disabled>
                                    </div>
                                </div>
                        @endif
                        {{--</div>--}}
                    </div>
                    {{--<form action="#" class="additionalServiceForm">
                        @csrf
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <div class="form-group row">
                        <div class="col-md-12 mb-1">
                            <h5 style="margin-bottom:.80em;">Additional Services</h5>
                        </div>
                        <input type="hidden" name="additionalServiceAccommodationID" value="{{$guestDetails->accommodationID}}">
                        <div class="col-md-3 mb-1">
                            <label for="additionalServiceName">Service name</label>
                            <select name="additionalServiceName" id="serviceSelect" class="form-control serviceSelect">
                                <option value="" selected disabled >Choose...</option>
                                <option value="6">Airsoft</option>
                                <option value="7">Archery</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-1">
                            <label for="additionalServiceNumberOfPax">Pax</label>
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
                    </div>--}}
                    <hr class="mb-4 mt-4">
                    <div class="form-group row pb-3" id="divAdditionalServices">
                        <div class="col-md-12 mb-1">
                            <h5 style="margin-bottom:.80em;">Additional Services</h5>
                        </div>
                        <input type="hidden">
                        <div class="col-md-3 mb-1" id="divServiceName">
                            <label for="additionalServiceName">Service name</label>
                            <select name="additionalServiceName" id="serviceSelect" class="form-control serviceSelect">
                                <option value="choose" selected disabled >Choose...</option>
                                <option value="6">Airsoft</option>
                                <option value="7">Archery</option>                                
                                <option value="15">Pillow</option>
                                <option value="16">Bedsheet</option>
                                <option value="17">Blanket</option>
                            </select>
                        </div>
                        <div class="col-md-2 mb-1" id="divQuantity">
                            <label for="additionalServiceNumberOfPax">Quantity</label>
                            <input class="form-control paxSelect" type="number" id="additionalServiceNumberOfPax" placeholder="" value="" min="1" max="10">
                        </div>
                        <div class="col-md-3 mb-1" id="divUnitPrice">
                            <label for="additionalServiceUnitPrice">Unit price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input class="form-control additionalServiceUnitPrice" type="text" id="additionalServiceUnitPrice" name="additionalServiceUnitPrice" placeholder="" value="" disabled>
                                <input class="form-control additionalServiceUnitPrice" type="text" style="display:none;float:left;" id="additionalServiceUnitPrice" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-3 mb-1" id="divTotalPrice">
                            <label for="additionalServiceTotalPrice">Total price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input class="form-control additionalServiceTotalPrice" type="text" id="additionalServiceTotalPrice" name="additionalServiceTotalPrice" placeholder="" value="" disabled>
                                <input class="form-control additionalServiceTotalPrice" type="text" style="display:none;float:left;" id="additionalServiceTotalPrice" placeholder="" value="">
                            </div>
                        </div>
                        <div style="margin-top:2em;" id="divButton">
                            <div class="input-group">
                                <button type="button" id="additionalServiceFormAdd" class="btn btn-primary additionalServiceFormAdd" disabled>
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
                        <!--button class="btn btn-success" style="width:10em;" type="submit">Save</button-->
                        <button type="button" class="btn btn-primary" style="width:11em;" data-toggle="modal" data-target="#chargesModal">
                            Proceed to payment
                        </button>
                        <a href="/glamping" style="text-decoration:none;">
                            <button class="btn btn-secondary" style="width:11em;" type="button">Cancel</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- charges modal -->
    <div class="modal fade" id="chargesModal" tabindex="-1" role="dialog" aria-labelledby="chargesModal" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Charges</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="card my-0">
                        <table class="table table-striped m-0 display nowrap transactionTable" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col" style="width:50%">Desciption</th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th> 
                                </tr>
                            </thead>
                            <tbody id="chargesRows">
                                <tr>
                                    <td></td>
                                    <td>
                                        <!--div class="form-check"-->
                                        <input class="form-check-input" type="checkbox" id="charge1">
                                        Glamping 4 pax
                                        <!--/div-->
                                    </td>
                                    <td style="text-align:right;">4</td>
                                    <td style="text-align:right;">850</td>
                                    <td style="text-align:right;" class="chargesPrices">3400</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <!--div class="form-check"-->
                                        <input class="form-check-input" type="checkbox" id="charge2">
                                        Airsoft
                                        <!--/div-->
                                    </td>
                                    <td style="text-align:right;">2</td>
                                    <td style="text-align:right;">750</td>
                                    <td style="text-align:right;" class="chargesPrices">1500</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th colspan="3" scope="row">Amount due:</th>
                                    <th id="chargesGrandTotal" style="text-align:right;">1500</th>
                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th scope="row">Amount paid:</th>
                                    <th style="text-align:right;"  colspan="3">
                                        <input type="number" name="amountPaid" placeholder="0" min="0" style="text-align:right;" class="form-control" id="amount" required>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of charges modal -->
    @endforeach  
@endsection