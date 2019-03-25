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
            <div class="col-md-4 order-md-2 mb-4">
                <div class="card p-2">
                    <h4 class="text-muted" style="text-align:center; padding:0.5em;">Invoice</h4>
                    <table class="table table-striped" style="font-size:.83em;">
                        <thead>
                            <tr>
                                <th scope="col" style="width:55%">Description</th>
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
                            <tr>
                                <th colspan="1">Amount Paid:</th>
                                <th style="text-align:right;"  colspan="3">
                                <input type="number" name="amountPaid" placeholder="0" min="0" style="text-align:right;" class="form-control" id="amount" required>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="col-md-8 order-md-1 check-in-form">
                <h5 style="margin-bottom:.80em;">Guest Details</h5>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="firstName">First name</label>
                            <input class="form-control" type="text" name="firstName" required maxlength="15" placeholder="" value="">
                        </div>
                        <div class="col-md-4">
                            <label for="lastName">Last name</label>
                            <input class="form-control" type="text" name="lastName" required maxlength="20" placeholder="" value="">
                        </div>
                        <div class="col-md-4 mb-1">
                            <label for="contactNumber">Contact number</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control" type="text" name="contactNumber" required minlength="11" maxlength="11" placeholder="09#########" value="">
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
                    <div class="form-group row">
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
                    </div>
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
                        <div class="col-md-10 mb-1" id="divUnits">
                            <label for="unitNumber">Unit/s</label>
                            <input type="text" name="unitID" required="required" class="form-control" style="display:none;position:absolute;" value="{{$unit->id}}">
                            <input class="form-control" type="text" name="unitNumber" required id="tokenfield" value="{{$unit->unitNumber}}" required>
                            
                            <input class="form-control" style="display:none;float:left;" type="text" name="unitID" value="{{$unit->id}}">
                            
                            <div id="alertContainer" class="alert alert-danger mt-2" style="display:none;">
                                <a href="#" class="close">&times;</a>
                                <span id="alertMessage"><strong>Occupied!</strong> Tent 3 is occupied from March 25 to March 27.</span>
                            </div>
                            
                            {{--<input type="text" class="form-control" id="tokenfield" value="" />--}}                        
                            
                            
                            {{--gac dawn code--}}
                            <!--label for="unitNumber">Unit/s</label-->
                            <div class="row mt-3">
                                <div class="col-md-4 mb-1" id="divUnitNumber">
                                    <label for="unitNumber">Unit number</label>
                                    <input type="text" class="form-control" value="{{$unit->unitNumber}}" disabled>
                                </div>
                                <div class="col-md-3 mb-1" id="divNumberOfPax">
                                    <label for="unitNumberOfPax">No. of pax</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input class="form-control paxSelect numberOfPaxGlamping" name="numberOfPaxGlamping{{$unit->unitNumber}}" id="numberOfPaxGlamping{{$unit->unitNumber}}" type="number" {{--name="additionalServiceNumberOfPax"--}} placeholder="" value="" min="1" max="4" {{--form="serviceForm"--}}>
                                        <input class="" name="totalPrice{{$unit->unitNumber}}" id="totalPrice{{$unit->unitNumber}}" type="number" style="display:none;position:absolute" value="">
                                    </div>
                                </div>
                                <div class="col-md-5 mb-1" id="divAccommodationPackage">
                                    <label for="additionalServiceUnitPrice">Accommodation package</label>
                                    <select class="form-control" name="accommodationType{{$unit->unitNumber}}" id="accommodationType{{$unit->unitNumber}}" readonly>
                                        <option value="1">Glamping Solo</option>
                                        <option value="2">Glamping 2 Pax</option>
                                        <option value="3">Glamping 3 pax</option>
                                        <option value="4">Glamping 4 pax</option>
                                    </select>
                                </div>
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
                        <button class="btn btn-info" id="checkAvailability" style="width:10em;" type="button">Check Availability</button>
                        {{--</a>--}}
                        <button class="btn btn-success" style="width:10em;" type="submit">Check-in</button>
                        <a href="/glamping" style="text-decoration:none;">
                            <button class="btn btn-secondary" style="width:10em;" type="button">Cancel</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>                     
        @endforeach  
    @endif
@endsection