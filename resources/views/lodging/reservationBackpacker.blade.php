@extends('layouts.app')

@section('content')
@if(isset($unit))
@if(count($unit) > 0)
    @foreach($unit as $unit)
    <div class="container pb-5">
        <div class="pt-3 pb-3 text-center">
            <a href="{{ URL::previous() }}">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Reservation Form</h3>
        </div>   
        <form method="POST" action="/reserve-backpacker">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <input type="hidden" name="selectedUnit" id="selectedUnit" value="{{$unit->unitNumber}}">
        <input type="hidden" name="backpackerQuantity" id="backpackerQuantity" value="">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4 mx-0">
                <div class="card p-0 mx-0">
                    <h4 class="text-muted" style="text-align:center; padding:0.5em;">Charges</h4>
                    <table class="table table-striped" style="font-size:.88em;">
                        <thead>
                            <tr>
                                <th scope="col" style="width:40%">Description</th>
                                <th scope="col">Qty.</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="invoiceRows">
                            <tr id="invoiceUnit{{$unit->unitNumber}}">
                                <td style="display:none;"><input id="invoiceCheckBox{{$unit->unitNumber}}" class="form-check-input invoiceCheckboxes" type="checkbox" checked></td>
                                <td id="invoiceDescription{{$unit->unitNumber}}" class="invoiceDescriptions">Backpacker</td>
                                <td id="invoiceQuantity{{$unit->unitNumber}}" style="text-align:right;" class="invoiceQuantities">1</td>
                                <td id="invoiceUnitPrice{{$unit->unitNumber}}" style="text-align:right;" class="invoiceUnitPrices">750.00</td>
                                <td id="invoiceTotalPrice{{$unit->unitNumber}}" style="text-align:right;" class="invoicePrices">750.00</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="3" scope="row">TOTAL:</th>
                                <th id="invoiceGrandTotal" style="text-align:right;"></th>
                            </tr>
                            <!--tr>
                                <td colspan="4"><button type="button" class="btn btn-primary" style="text-align:center;width:8em" id="proceedToPayment" data-toggle="modal" data-target="#chargesModal">
                                    Get payment
                                </button></td>
                            </tr-->
                            {{--<tr>
                                <th colspan="1">Amount Paid:</th>
                                <th style="text-align:right;"  colspan="3">
                                <input type="number" name="amountPaid" placeholder="0" min="0" style="text-align:right;" class="form-control" id="amount" required>
                                </th>
                            </tr>--}}
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-8 order-md-1 check-in-form">
                <h5 style="margin-bottom:.80em;">Guest Details</h5>
                    <div class="form-group row">
                        <div class="col-md-4 mb-1">
                            <label for="firstName">First  <h7 style="color:red">*</h7></label>
                            <input class="form-control" type="text" name="firstName" id="firstName" required="required" maxlength="15" placeholder="" value="" autocomplete = "off">
                        </div>
                        <div class="col-md-5 mb-1">
                            <label for="lastName">Last name <h7 style="color:red">*</h7></label>
                            <input class="form-control" type="text" name="lastName" id="lastName" required="required" maxlength="20" placeholder="" value="" autocomplete = "off">
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="unitNumberOfPax">No. of pax <h7 style="color:red">*</h7></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control numberOfPaxBackpacker"  required="required" min="1" max="100" name="numberOfPaxBackpacker" type="number" placeholder="" value="">
                            </div>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <div class="col-md-6 mb-1">
                            <label for="contactNumber">Contact number <h7 style="color:red">*</h7></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" name="contactNumber" id="contactNumber"  required="required" maxlength="11" placeholder="" value="" autocomplete = "off">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="backpacker">Accommodation</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="backpacker" maxlength="11" placeholder="" value="Backpacker" disabled>
                            </div>
                        </div>
                    </div>    
                    <hr class="mb-4">
                    <h5 style="margin-bottom:.80em;">Unit Details</h5>
                    <div class="form-group row">
                        <div class="col-md-2 mb-1">
                            <label for="unitID">No. of rooms</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-bed" aria-hidden="true"></i>
                                    </span>
                                </div>
                            <input class="form-control" type="number" id="numberOfUnits" name="numberOfUnits" required placeholder="" value="1" min="1" max="80" readonly>
                            </div>
                        </div>
                        @php
                            //$source = implode(',', array($unitSource->unitNumber));
                            $source = array();
                            foreach($unitSource as $unitSource) {
                                array_push($source, $unitSource->unitNumber);
                            }

                            $source = implode(',', $source);
                        @endphp
                        <div class="col-md-10 mb-1">
                            <label for="unitNumber">Unit/s</label>
                            <input type="text" name="unitID" required="required" class="form-control" style="display:none;position:absolute;" value="{{$unit->id}}">
                            <input class="form-control" type="text" name="unitNumber" required id="tokenfieldBackpacker" value="{{$unit->unitNumber}}" required>
                            <input type="hidden" id="unitSource" value="{{$source}}">
                            <input class="form-control" style="display:none;float:left;" type="text" name="unitID" value="{{$unit->id}}">
                                               
                            {{--<input type="text" class="form-control" id="tokenfield" value="" />--}}                        
                            
                            
                            
                        </div>
                    </div>
                <div id="divUnits">
                    <div class="form-group row mb-0 pb-0" id="divUnits{{$unit->unitNumber}}">
                        <div class="col-md-2 mb-1" id="divUnitNumber{{$unit->unitNumber}}">
                            <label for="unitNumber">Unit number</label>
                            <input type="text" class="form-control unit{{$unit->unitNumber}}" value="{{$unit->unitNumber}}" readonly {{--data-toggle="tooltip" data-placement="bottom" data-html="true" title="Click to split dates." style="cursor:pointer"--}}>
                            <input class="" name="totalPrice" id="totalPrice" type="number" style="display:none;position:absolute" value="">
                            {{--<input type="hidden" value="1" name="numberOfGroupsIn{{$unit->unitNumber}}" id="numberOfGroupsIn{{$unit->unitNumber}}">--}}
                        </div>
                        <div class="col-md-2 mb-1" id="divNumberOfBeds{{$unit->unitNumber}}">
                            <label for="additionalServiceUnitPrice">No. of beds</label>
                            <select class="form-control numberOfBeds" name="numberOfBeds{{$unit->unitNumber}}" id="numberOfBeds{{$unit->unitNumber}}">
                                @foreach($beds as $bed)
                                <option value="{{$loop->iteration}}">{{$loop->iteration}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="maxCapacity{{$unit->unitNumber}}" value="{{count($beds)}}">
                        </div>

                        <div class="col-md-4 mb-1" id="divCheckinDate{{$unit->unitNumber}}">
                            <label for="checkinDate">Check-in date <h7 style="color:red">*</h7></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" name="checkinDate{{$unit->unitNumber}}" required="required" class="form-control checkinDatesBackpacker" id="checkinDate{{$unit->unitNumber}}" value="<?php echo date("Y-m-d");?>">
                            </div>
                        </div>

                        <div class="col-md-4 mb-1" id="divCheckoutDate{{$unit->unitNumber}}">
                            <label for="checkoutDate">Check-out date <h7 style="color:red">*</h7></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" name="checkoutDate{{$unit->unitNumber}}" required="required" class="form-control checkoutDatesBackpacker" id="checkoutDate{{$unit->unitNumber}}" value="">
                                {{--<input type="text" name="stayDuration" id="stayDuration" required="required" style="display:none;position:absolute;" value="">--}}
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    @endif
@else
<div class="container pb-3">
    <div class="pt-3 pb-3 text-center">
        <a href="{{ URL::previous() }}">
            <span style="float:left;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <strong>Back</strong>
            </span>
        </a>
        <h3>Reservation Form</h3>
    </div>   
    <form method="POST" action="/reserve-backpacker">
    @csrf
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" name="selectedUnit" id="selectedUnit" value="">
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4 mx-0">
            <div class="card p-0 mx-0">
                <h4 class="text-muted" style="text-align:center; padding:0.5em;">Charges</h4>
                <table class="table table-striped" style="font-size:.88em;">
                    <thead>
                        <tr>
                            <th scope="col" style="width:40%">Description</th>
                            <th scope="col">Qty.</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody id="invoiceRows">
                        @if(count($charges) > 0)
                        @php
                            $totalPrice = 0; 
                        @endphp
                        @foreach($charges as $charge)
                        @php
                            $checkin = new DateTime($givenCheckinDate);
                            $checkout = new DateTime($givenCheckoutDate);
                            $stayDuration = date_diff($checkin, $checkout)->days;

                            $invoicePrice = 750 * $stayDuration;

                            $totalPrice += $invoicePrice;
                        @endphp
                        <tr id="invoiceUnit{{$charge->unitNumber}}">
                            <td style="display:none;"><input id="invoiceCheckBox{{$charge->unitNumber}}" class="form-check-input invoiceCheckboxes" type="checkbox" checked></td>
                            <td id="invoiceDescription{{$charge->unitNumber}}" class="invoiceDescriptions">Backpacker</td>
                            <td id="invoiceQuantity{{$charge->unitNumber}}" style="text-align:right;" class="invoiceQuantities">1x{{$stayDuration}}</td>
                            <td id="invoiceUnitPrice{{$charge->unitNumber}}" style="text-align:right;" class="invoiceUnitPrices">750.00</td>
                            <td id="invoiceTotalPrice{{$charge->unitNumber}}" style="text-align:right;" class="invoicePrices">{{$invoicePrice}}</td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="3" scope="row">TOTAL:</th>
                            <th id="invoiceGrandTotal" style="text-align:right;"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="col-md-8 order-md-1 check-in-form">
            <h5 style="margin-bottom:.80em;">Guest Details</h5>
                <div class="form-group row">
                    <div class="col-md-4 mb-1">
                        <label for="firstName">First name</label>
                        <input class="form-control" type="text" name="firstName" required="required" maxlength="15" placeholder="" value="">
                    </div>
                    <div class="col-md-5 mb-1">
                        <label for="lastName">Last name</label>
                        <input class="form-control" type="text" name="lastName" required="required" maxlength="20" placeholder="" value="">
                    </div>
                    <div class="col-md-3 mb-1">
                        <label for="unitNumberOfPax">No. of pax</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input class="form-control numberOfPaxBackpacker"  required="required" min="1" max="100" name="numberOfPaxBackpacker" type="number" placeholder="" value="">
                        </div>
                    </div>
                </div>  
                <div class="form-group row">
                    <div class="col-md-6 mb-1">
                        <label for="contactNumber">Contact number</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input class="form-control" type="text" name="contactNumber"  required="required" maxlength="11" placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-md-6 mb-1">
                        <label for="backpacker">Accommodation</label>
                        <div class="input-group">
                            <input class="form-control" type="text" name="backpacker" maxlength="11" placeholder="" value="Backpacker" disabled>
                        </div>
                    </div>
                </div>   
                <hr class="mb-4">
                <h5 style="margin-bottom:.80em;">Unit Details</h5>
                <div class="form-group row">
                    <div class="col-md-2 mb-1">
                        <label for="unitID">No. of rooms</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-bed" aria-hidden="true"></i>
                                </span>
                            </div>
                        <input class="form-control" type="number" id="numberOfUnits" name="numberOfUnits" required placeholder="" value="{{count($unitNumber)}}" min="1" max="80" readonly>
                        </div>
                    </div>
                    @php
                        //$source = implode(',', array($unitSource->unitNumber));
                        $source = array();
                        foreach($unitSource as $unitSource) {
                            array_push($source, $unitSource->unitNumber);
                        }

                        $source = implode(',', $source);
                    @endphp
                    @if(count($unitNumber) > 0)
                    @php
                        $unitNumbers = "";
                    @endphp
                    @foreach($unitNumber as $unitNum)
                    @php
                        if($loop->iteration == count($unitNumber)){
                            $unitNumbers .= $unitNum." ";
                        } else {
                            $unitNumbers .= $unitNum.", ";
                        }
                    @endphp
                    @endforeach
                    @endif
                    <div class="col-md-10 mb-1">
                        <label for="unitNumber">Unit/s</label>
                        <input class="form-control" type="text" name="unitNumber" required id="tokenfieldBackpacker" value="{{$unitNumbers}}" required>
                        <input type="hidden" id="unitSource" value="{{$source}}">                     
                    </div>
                </div>
                <div class="form-group row" id="divUnits">
                    @if(count($units) > 0)
                    @foreach($units as $unit)
                    @php                        
                        $checkin = new DateTime($givenCheckinDate);
                        $checkout = new DateTime($givenCheckoutDate);
                        $stayDuration = date_diff($checkin, $checkout)->days;

                        $unitTotalPrice = 1350 * $stayDuration;
                    @endphp
                    @if($loop->iteration == 1)
                    <div class="col-md-2 mb-1" id="divUnitNumber{{$unit->unitNumber}}">
                        <label for="unitNumber">Unit number</label>
                        <input type="text" class="form-control" value="{{$unit->unitNumber}}" disabled>
                        <input class="" name="totalPrice" id="totalPrice" type="number" style="display:none;position:absolute" value="{{$unitTotalPrice}}">
                    </div>
                    <div class="col-md-2 mb-1" id="divNumberOfBeds{{$unit->unitNumber}}">
                        <label for="additionalServiceUnitPrice">No. of beds</label>
                        <select class="form-control numberOfBeds" name="numberOfBeds{{$unit->unitNumber}}" id="numberOfBeds{{$unit->unitNumber}}">
                            @foreach($beds as $bed)
                            <option value="{{$unit->unitNumber}}{{$loop->iteration}}">{{$loop->iteration}}</option>
                            @endforeach
                        </select>
                        <input type="hidden" id="maximumCapacity{{$unit->unitNumber}}" value="{{count($beds)}}">
                    </div>

                    <div class="col-md-4 mb-1" id="divCheckinDate{{$unit->unitNumber}}">
                        <label for="checkinDate">Check-in date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="date" name="checkinDate{{$unit->unitNumber}}" required="required" class="form-control checkinDates" id="checkinDate{{$unit->unitNumber}}" value="{{$givenCheckinDate}}">
                        </div>
                    </div>

                    <div class="col-md-4 mb-1" id="divCheckoutDate{{$unit->unitNumber}}">
                        <label for="checkoutDate">Check-out date</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="date" name="checkoutDate{{$unit->unitNumber}}" required="required" class="form-control checkoutDates" id="checkoutDate{{$unit->unitNumber}}" value="{{$givenCheckoutDate}}">
                            {{--<input type="text" name="stayDuration" id="stayDuration" required="required" style="display:none;position:absolute;" value="">--}}
                        </div>
                    </div>
                    @else
                    <div class="col-md-2 mb-1" id="divUnitNumber{{$unit->unitNumber}}">
                        <input type="text" class="form-control" value="{{$unit->unitNumber}}" disabled>
                        <input class="" name="totalPrice" id="totalPrice" type="number" style="display:none;position:absolute" value="{{$unitTotalPrice}}">
                    </div>
                    <div class="col-md-2 mb-1" id="divAccommodationPackage{{$unit->unitNumber}}">
                        <select class="form-control accommodationPackages" name="accommodationPackage{{$unit->unitNumber}}" id="accommodationPackage{{$unit->unitNumber}}">
                            <option value="1">Solo</option>
                            <option value="2">2 Pax</option>
                            <option value="3">3 pax</option>
                            <option value="4">4 pax</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-1" id="divCheckinDate{{$unit->unitNumber}}">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="date" name="checkinDate{{$unit->unitNumber}}" required="required" class="form-control checkinDates" id="checkinDate{{$unit->unitNumber}}" value="{{$givenCheckinDate}}">
                        </div>
                    </div>

                    <div class="col-md-4 mb-1" id="divCheckoutDate{{$unit->unitNumber}}">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                </span>
                            </div>
                            <input type="date" name="checkoutDate{{$unit->unitNumber}}" required="required" class="form-control checkoutDates" id="checkoutDate{{$unit->unitNumber}}" value="{{$givenCheckoutDate}}">
                            {{--<input type="text" name="stayDuration" id="stayDuration" required="required" style="display:none;position:absolute;" value="">--}}
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endif
                </div>
@endif
                    <div id="dateGapContainer" class="alert alert-warning mt-2" style="display:none;">
                        <a href="#" class="close">&times;</a>
                        <span id="dateGapMessage"><strong>Invalid Dates!</strong> Accommodation dates must be consecutive.</span>
                    </div>
                    
                    <div id="dateAlertContainer" class="alert alert-warning mt-2" style="display:none;">
                        <a href="#" class="close">&times;</a>
                        <span id="dateAlertMessage"><strong>Invalid Date!</strong> Please select a check-out date after the check-in date.</span>
                    </div>
                    
                    <div id="alertContainer" class="alert alert-danger mt-2" style="display:none;">
                        <a href="#" class="close">&times;</a>
                        <span id="alertMessage"><strong>Occupied!</strong> Tent 3 is occupied from March 25 to March 27.</span>
                    </div>
                    
                    <hr class="mb-4">
                    <div class="form-group row pb-3" id="divAdditionalServices">
                        <div class="col-md-12 mb-1">
                            <h5 style="margin-bottom:.80em;">Additional Services</h5>
                        </div>
                        <input type="hidden" {{--name="additionalServiceAccommodationID" value="" {{--form="serviceForm"--}}>
                        <div class="col-md-3 mb-1" id="divServiceName">
                            <label for="additionalServiceName">Service name</label>
                            <select name="additionalServiceName" id="serviceSelect" class="form-control serviceSelect" {{--form="serviceForm"--}}>
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
                            <input class="form-control paxSelect" type="number" id="additionalServiceNumberOfPax" {{--name="additionalServiceNumberOfPax"--}} placeholder="" value="" min="1" max="10" {{--form="serviceForm"--}}>
                        </div>
                        <div class="col-md-3 mb-1" id="divUnitPrice">
                            <label for="additionalServiceUnitPrice">Unit price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input class="form-control additionalServiceUnitPrice" type="text" id="additionalServiceUnitPrice" name="additionalServiceUnitPrice" placeholder="" value="" disabled>
                                <input class="form-control additionalServiceUnitPrice" type="text" style="display:none;float:left;" id="additionalServiceUnitPrice" {{--name="additionalServiceUnitPrice"--}} placeholder="" value="" {{--form="serviceForm"--}}>
                            </div>
                        </div>
                        <div class="col-md-3 mb-1" id="divTotalPrice">
                            <label for="additionalServiceTotalPrice">Total price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input class="form-control additionalServiceTotalPrice" type="text" id="additionalServiceTotalPrice" name="additionalServiceTotalPrice" placeholder="" value="" disabled>
                                <input class="form-control additionalServiceTotalPrice" type="text" style="display:none;float:left;" id="additionalServiceTotalPrice" {{--name="additionalServiceTotalPrice"--}} placeholder="" value="" {{--form="serviceForm"--}}>
                            </div>
                        </div>

                        <div style="margin-top:2em;" id="divButton">
                            <div class="input-group">
                                <button type="button" id="additionalServiceFormAdd" class="btn btn-primary additionalServiceFormAdd" {{--form="serviceForm"--}}disabled>
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>

                        <input type="number" style="display:none;float:left;" id="additionalServicesCount" name="additionalServicesCount" value="0">

                    </div>
                    
                    <div class="pt-4" style="float:right;">   
                        {{--<a href="/getDates" style="text-decoration:none;">              
                        <button class="btn btn-info" id="checkAvailability" style="width:10em;" type="button">Check Availability</button>
                        {{--</a>--}}
                        <button class="btn btn-success" id="checkinButton" style="width:10em;" type="submit">Make Reservation</button>
                        <a href="/backpacker" style="text-decoration:none;">
                            <button class="btn btn-secondary" style="width:10em;" type="button">Cancel</button>
                        </a>
                    </div>
            </div>
        </div>
    <!-- charges modal -->
    <div class="modal fade" id="chargesModal" tabindex="-1" role="dialog" aria-labelledby="chargesModal" aria-hidden="true">
        <div class="modal-dialog" role="document" style="width:70%">
            <div class="modal-content">
                <div id="selectedPayments" style="display:none;">
                </div>
                <div class="modal-header">
                    <h5 class="modal-title">Charges</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body my-0">
                    <!--form class="card my-0"-->
                        <table class="table table-striped m-0 display nowrap transactionTable" style="font-size:1em;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col" style="width:40%">
                                        <input class="form-check-input" type="checkbox" id="selectAll" checked>
                                        Description
                                    </th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th> 
                                </tr>
                            </thead>
                            <tbody id="chargesRows">
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
                                        <input type="number" name="amountPaid" placeholder="0" min="0" style="text-align:right;" class="form-control" id="amount">
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="savePayments" class="btn btn-success" data-dismiss="modal">Save Changes</button>
                    <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button-->
                </div>
            </div>
        </div>
    </div>
@endsection