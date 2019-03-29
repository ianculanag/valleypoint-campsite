@extends('layouts.app')

@section('content')
@if(count($unit) > 0)
    @foreach($unit as $unit)
    <div class="container">
        <div class="pt-3 pb-3 text-center">
            <a href="/glamping">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Check-in Form</h3>
        </div>   
        <form method="POST" action="/checkinGlamping">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4 mx-0">
                <div class="card p-0 mx-0">
                    <h4 class="text-muted" style="text-align:center; padding:0.5em;">Invoice</h4>
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
                                <td id="invoiceDescription{{$unit->unitNumber}}">Glamping Solo</td>
                                <td id="invoiceQuantity{{$unit->unitNumber}}" style="text-align:right;">1</td>
                                <td id="invoiceUnitPrice{{$unit->unitNumber}}" style="text-align:right;">1350</td>
                                <td id="invoiceTotalPrice{{$unit->unitNumber}}" style="text-align:right;" class="invoicePrices">1350</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="3" scope="row">TOTAL:</th>
                                <th id="invoiceGrandTotal" style="text-align:right;"></th>
                            </tr>
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
                            <label for="firstName">First name</label>
                            <input class="form-control" type="text" name="firstName" maxlength="15" placeholder="" value="">
                        </div>
                        <div class="col-md-5 mb-1">
                            <label for="lastName">Last name</label>
                            <input class="form-control" type="text" name="lastName"  maxlength="20" placeholder="" value="">
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="unitNumberOfPax">No. of pax</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control numberOfPaxGlamping" name="numberOfPaxGlamping" type="number" placeholder="" value="">
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
                                <input class="form-control" type="text" name="contactNumber" maxlength="11" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="glamping">Accommodation</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="glamping" maxlength="11" placeholder="" value="Glamping" disabled>
                            </div>
                        </div>
                    </div>    
                        <!--/div-->
                        {{--<div class="col-md-3 mb-1">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control" type="number" id="numberOfPax" required name="numberOfPax" placeholder="" value="" min="1" max="60">
                        </div>
                        <div class="col-md-4 mb-1 form-group">
                            <label for="accommodationType">Accommodation type</label>
                            <select class="form-control"disabled>
                                <option>Glamping</option>
                            </select>
                        </div>--}}
                    <!--div class="form-group row">
                        <div class="col-md-6 mb-3">
                            <label for="checkinDate">Check-in date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" name="checkinDate" required="required" class="form-control" id="checkinDate" value="<?php echo date("Y-m-d");?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="checkoutDate">Check-out date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" name="checkoutDate" required="required" class="form-control" id="checkoutDate" value="">
                                <input type="text" name="stayDuration" id="stayDuration" required="required" style="display:none;position:absolute;" value="">
                            </div>
                        </div>
                    </div-->
                    <hr class="mb-4">
                    <h5 style="margin-bottom:.80em;">Unit Details</h5>
                    <div class="form-group row">
                        <div class="col-md-2 mb-1">
                            <label for="unitID">No. of units</label>
                            {{--<input class="form-control" style="display:none;float:left;" type="number" name="numberOfUnits" placeholder="" value="1" min="1" max="10" disabled>--}}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-campground" aria-hidden="true"></i>
                                    </span>
                                </div>
                            <input class="form-control" type="number" id="numberOfUnits" name="numberOfUnits" required placeholder="" value="1" min="1" max="80" readonly>
                            </div>
                        </div>
                        <div class="col-md-10 mb-1">
                            <label for="unitNumber">Unit/s</label>
                            <input type="text" name="unitID" required="required" class="form-control" style="display:none;position:absolute;" value="{{$unit->id}}">
                            <input class="form-control" type="text" name="unitNumber" required id="tokenfield" value="{{$unit->unitNumber}}" required>
                            
                            <input class="form-control" style="display:none;float:left;" type="text" name="unitID" value="{{$unit->id}}">
                            
                            <div id="alertContainer" class="alert alert-danger mt-2" style="display:none;">
                                <a href="#" class="close">&times;</a>
                                <span id="alertMessage"><strong>Occupied!</strong> Tent 3 is occupied from March 25 to March 27.</span>
                            </div>
                            
                            {{--<input type="text" class="form-control" id="tokenfield" value="" />--}}                        
                            
                            
                            
                        </div>
                    </div>
                    <div class="form-group row" id="divUnits">
                        {{--gac dawn code--}}
                        <div class="col-md-2 mb-1" id="divUnitNumber{{$unit->unitNumber}}">
                            <label for="unitNumber">Unit number</label>
                            <input type="text" class="form-control" value="{{$unit->unitNumber}}" disabled>
                        </div>
                        {{--<div class="col-md-3 mb-1" id="divNumberOfPax{{$unit->unitNumber}}"  style="display:none;">
                            <label for="unitNumberOfPax">No. of pax</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control paxSelect numberOfPaxGlamping" name="numberOfPaxGlamping{{$unit->unitNumber}}" id="numberOfPaxGlamping{{$unit->unitNumber}}" type="number" {{--name="additionalServiceNumberOfPax" placeholder="" value="1" min="1" max="4" required="required"{{--form="serviceForm">
                                <input class="" name="totalPrice{{$unit->unitNumber}}" id="totalPrice{{$unit->unitNumber}}" type="number" style="display:none;position:absolute" value="">
                            </div>
                        </div>--}}
                        <div class="col-md-2 mb-1" id="divAccommodationPackage{{$unit->unitNumber}}">
                            <label for="additionalServiceUnitPrice">Package</label>
                            <select class="form-control" name="accommodationPackage{{$unit->unitNumber}}" id="accommodationPackage{{$unit->unitNumber}}" class="accommodationPackages">
                                <option value="1">Solo</option>
                                <option value="2">2 Pax</option>
                                <option value="3">3 pax</option>
                                <option value="4">4 pax</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-1" id="divCheckinDate{{$unit->unitNumber}}">
                            <label for="checkinDate">Check-in date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" name="checkinDate" required="required" class="form-control checkinDates" id="checkinDate" value="<?php echo date("Y-m-d");?>">
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
                                <input type="date" name="checkoutDate" required="required" class="form-control checkoutDates" id="checkoutDate" value="">
                                <input type="text" name="stayDuration" id="stayDuration" required="required" style="display:none;position:absolute;" value="">
                            </div>
                        </div>
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
                    </div>
                    
                    <div class="pt-4" style="float:right;">   
                        {{--<a href="/getDates" style="text-decoration:none;"> --}}                 
                        {{--<button class="btn btn-info" id="checkAvailability" style="width:10em;" type="button">Check Availability</button>--}}
                        {{--</a>--}}
                        <button type="button" class="btn btn-primary" style="width:11em;" data-toggle="modal" data-target="#chargesModal">
                            Proceed to payment
                        </button>
                        <button class="btn btn-success" id="checkinButton" style="width:10em;" type="submit">Check-in</button>
                        <a href="/glamping" style="text-decoration:none;">
                            <button class="btn btn-secondary" style="width:10em;" type="button">Cancel</button>
                        </a>
                    </div>
                </form>
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
                        <table class="table table-striped m-0 display nowrap transactionTable" style="font-size:1em;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col" style="width:50%">
                                        <input class="form-check-input" type="checkbox" id="charge1" checked>
                                        Description
                                    </th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th> 
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="chargesRows">
                                <tr>
                                    <td></td>
                                    <td>
                                        <!--div class="form-check"-->
                                        <input class="form-check-input" type="checkbox" id="charge1" checked>
                                        Glamping 4 pax
                                        <!--/div-->
                                    </td>
                                    <td style="text-align:right;">4</td>
                                    <td style="text-align:right;">850</td>
                                    <td style="text-align:right;" class="chargesPrices">3400</td>
                                    <td>
                                        <button type="button" id="deleteCharge1" class="btn btn-sm btn-danger deleteCharge">
                                            <span class="fa fa-minus" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <!--div class="form-check"-->
                                        <input class="form-check-input" type="checkbox" id="charge2" checked>
                                        Airsoft
                                        <!--/div-->
                                    </td>
                                    <td style="text-align:right;">2</td>
                                    <td style="text-align:right;">750</td>
                                    <td style="text-align:right;" class="chargesPrices">1500</td>
                                    <td>
                                        <button type="button" id="deleteCharge1" class="btn btn-sm btn-danger deleteCharge">
                                            <span class="fa fa-minus" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th colspan="3" scope="row">Amount due:</th>
                                    <th id="chargesGrandTotal" style="text-align:right;">1500</th>
                                    <th></th>
                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th scope="row">Amount paid:</th>
                                    <th style="text-align:right;"  colspan="3">
                                        <input type="number" name="amountPaid" placeholder="0" min="0" style="text-align:right;" class="form-control" id="amount" required>
                                    </th>
                                    <th></th>
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
    @endif
@endsection