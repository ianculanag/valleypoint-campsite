@extends('layouts.app')

@section('content')
{{--@foreach ($guest as $guestDetails)--}}
        <div class="py-5 text-center">
            <a href="/glamping">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Check-in Form</h3>
        </div>
        
        <!--form id="servicesForm" action="/additionalServices" method="POST"></form-->        
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
                            {{--@php
                                $total = 0;
                            @endphp
                            @foreach($charges as $charge)--}}
                            <tr>
                                <td id="invoiceDescription">Glamping</td>
                                <td id="invoiceQuantity" style="text-align:right;">1</td>
                                <td id="invoiceUnit" tyle="text-align:right;">{{--$charge->price--}}</td>
                                <td id="invoiceTotal" style="text-align:right;" class="invoicePrices">{{--($charge->totalPrice)--}}</td>
                            </tr>
                            
                            {{--@php
                                $total += $charge->totalPrice;
                            @endphp
                            @endforeach --}}
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="3" scope="row">TOTAL:</th>
                                <th id="invoiceGrandTotal" style="text-align:right;">{{--$total--}}</th>
                            </tr>
                            <tr>
                                <th colspan="1">Amount Paid:</th>
                                <th style="text-align:right;"  colspan="3">
                                <input type="number" name="amountPaid" placeholder="0" min="0" class="form-control" id="amount" required>
                                </th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!--/form-->
            </div>
            <div class="col-md-8 order-md-1 check-out-form">
                    <h5 style="margin-bottom:.80em;">Guest Details</h5>
                    <div class="form-group row">
                        <div class="col-md-5 mb-1">
                            <label for="firstName">First name</label>
                            <input class="form-control" type="text" name="firstName" required maxlength="15" placeholder="Juan" value="">
                        </div>
                        <div class="col-md-7 mb-1">
                            <label for="lastName">Last name</label>
                            <input class="form-control" type="text" name="lastName" required maxlength="20" placeholder="Dela Cruz" value="">
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
                                <input class="form-control" type="text" name="contactNumber" required minlength="11" maxlength="11" placeholder="09#########" value="">
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control" type="number" required name="numberOfPax" placeholder="" value="" min="1" max="4">
                        </div>
                        <!--div class="col-md-3 mb-1" style="display:none; position:absolute;">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control"  type="number" name="numberOfPax" placeholder="" value="" min="1" max="10">
                        </div-->
                        <div class="col-md-4 mb-1 form-group">
                            <label for="accommodationType">Accommodation type</label>
                            @if(count($unit) > 0)
                            @foreach($unit as $unit)
                            <select class="form-control" {{--name="serviceName" id="accommodationType"--}}disabled>
                                <option>Glamping</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                            <div class="col-md-6 mb-1">
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
                            <input class="form-control" type="number" id="numberOfUnits" name="numberOfUnits" required placeholder="" value="1" min="1" max="80" disabled>
                            </div>
                        </div>
                        <div class="col-md-10 mb-1" id="divUnits">
                            <label for="unitNumber">Unit/s</label>
                            <input type="text" name="unitID" required="required" class="form-control" style="display:none;position:absolute;" value="{{$unit->id}}"">
                            <input class="form-control" type="text" name="unitNumber" required id="tokenfield" value="{{$unit->unitNumber}}">
                            
                            <input class="form-control" style="display:none;float:left;" type="text" name="unitID" placeholder="This will be a listbox/tokenfield" role="listbox" value="{{$unit->id}}">
                            {{--<input type="text" class="form-control" id="tokenfield" value="" />--}}                        
                            
                            
                            {{--gac dawn code--}}
                            <!--label for="unitNumber">Unit/s</label-->
                            <div class="row mt-3">
                            {{--<input type="text" name="unitID" required="required" class="form-control" style="display:none;position:absolute;" value="{{$unit->id}}"">
                            <input class="form-control" type="text" name="unitNumber" required id="tokenfield" value="{{$unit->unitNumber}}">
                            <input class="form-control" style="display:none;float:left;" type="text" name="unitID" placeholder="This will be a listbox/tokenfield" role="listbox" value="{{$unit->id}}">--}}
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
                                        <input class="form-control paxSelect numberOfPaxGlamping" type="number" {{--name="additionalServiceNumberOfPax"--}} placeholder="" value="" min="1" max="4" {{--form="serviceForm"--}}>
                                    </div>
                                </div>
                                <div class="col-md-5 mb-1" id="divAccommodationPackage">
                                    <label for="additionalServiceUnitPrice">Accommodation package</label>
                                    <select name="serviceName" class="form-control" id="accommodationType" disabled>
                                        <option value="1">Glamping Solo</option>
                                        <option value="2">Glamping 2 Pax</option>
                                        <option value="3">Glamping 3 pax</option>
                                        <option value="4">Glamping 4 pax</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                            @endforeach
                            {{--@else
                            <select name="serviceName" class="form-control" id="accommodationType">
                                <option value="1">Glamping Solo</option>
                                <option value="2">Glamping 2 Pax</option>
                                <option value="3">Glamping 3 pax</option>
                                <option value="4">Glamping 4 pax</option>
                                <option value="5">Backpacker</option>
                            </select>
                            <input class="form-control" type="number" name="numberOfUnits" placeholder="" value="" min="1" max="10">
                        </div>
                        <div class="col-md-10 mb-1">
                            <label for="unitNumber">Unit/s</label>
                            <input class="form-control" type="text" name="unitNumbers" required placeholder="This will be a listbox/tokenfield" role="listbox" value="">--}}
                            
                            @endif
                    </div>{{--end div--}}
                    
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
                    
                    {{--<input class="form-control" type="number" name="numberOfAdditionalCharges" value="1" style="display:none; position:absolute;">
                    <input class="form-control" type="text" name="serviceID1" value="6" style="display:none; position:absolute;">
                    <input class="form-control" type="number" name="numberOfPaxAdditional1" value="5" style="display:none; position:absolute;">
                    <input class="form-control" type="text" name="paymentStatus1" value="paid" style="display:none; position:absolute;">--}}
                    
                    <div style="float:right;">
                        <button class="btn btn-success" style="width:10em;" type="submit">Check-in</button>
                        <a href="/glamping" style="text-decoration:none;">
                            <button class="btn btn-secondary" style="width:10em;" type="button">Cancel</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    {{--@endforeach--}}
{{-- <div class="container">
    <div class="py-5 text-center">
            <a href="/glamping">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
        <!--img class="d-block mx-auto mb-4" alt="" width="72" height="72"-->
            <h2>Check-in Guests</h2>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="row">
        <div class="col-sm-5 text-left">
        <form method="POST" action="/checkinGlamping" class="justify-content-center">
                @csrf
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <!--div class="form-group">
                    <input type="text" required="required" class="form-control" id="inputGuestid" placeholder="Unit Number">
                </div-->
                <div class="form-group col-md-6" style="position: absolute;">
                    <input type="text" name="unitID" required="required" class="form-control" style="display:none" value={{$unitID}}>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="firstName">First Name</label>
                    <input type="text" name="firstName" required="required" class="form-control" id="inputfirstName" placeholder="Juan" value="{{old('firstName')}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" required="required" class="form-control" id="inputlastName" placeholder="Dela Cruz" value="{{old('lastName')}}">
                    </div>  
                </div> 
                <div class="form-group">
                    <label for="contactNumber">Contact Number</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </span>
                        </div>
                    <input type="text" name="contactNumber" required="required" class="form-control" id="inputcontactNumber" placeholder="09#########" value="{{old('contactNumber')}}">
                    </div>
                </div>
                <div class="form-group row-md-6">
                <label for="numberOfPax">Number Of Pax:</label><br>
                    <label class="radio-inline pr-3">
                    <input type="radio"  name="numberOfPax" value="1"> Solo
                    </label>
                    <label class="radio-inline pr-3">
                        <input type="radio" name="numberOfPax" value="2"> 2 Pax
                    </label>
                    <label class="radio-inline pr-3">
                        <input type="radio" name="numberOfPax" value="3"> 3 Pax
                    </label>
                    <label class="radio-inline pr-3">
                        <input type="radio" name="numberOfPax" value="4"> 4 Pax
                    </label>
                </div> 
                <div id="outputDiv">
                </div>
        </div>
        <div class="col-sm-5">
            <div class="row">
                <div class="form-group col-md-6">
                <label for="arrivalDate">Arrival Date:</label>
                <input type="date" name="checkinDate" required="required" class="form-control" id="date" value="<!--?php echo date("Y-m-d");?>">
                </div>
                <div class="form-group col-md-6">
                <label for="arrivalTime">Time: </label>
                <input type="time" name="checkinTime" required="required" class="form-control" id="time" value="14:00">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="departureDate">Departure Date:</label>
                    <input type="date" name="checkoutDate" required="required" class="form-control" id="date" value="">
                </div>
                <div class="form-group col-md-6">
                    <label for="departureTime">Time:</label>
                <input type="time" name="checkoutTime" required="required" class="form-control" id="time" value="12:00">
                </div>
            </div>

            <div class="row">
                <div class="card p-2 col-md-11 ">
                <label for="payment">Payment:</label>
                <div class="row">
                    <div class="form-group col-md-6">
                    <label for="amount">Amount:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">₱</span>
                            </div>                    
                        <input type="number" name="amountPaid" placeholder="0" class="form-control" id="amount">
                    </div>
                    </div>


                     <div class="form-group col-md-6">
                    <label for="arrivalTime">Status: </label>
                    <select class="form-control" id="status" name="paymentStatus">
                        <option value="full">Full Payment</option>
                        <option value="partial">Partial</option>
                        <option value="unpaid">Unpaid</option>
                    </select>
                    </div>
                    </div>
                </div>
                </div>
                
                <button type="submit" value="Submit" style="width:10em;" class="btn btn-info float-right mt-5" data-toggle="modal" data-target="#check-in guests">
                    Check-in
            </button>
            
            
            {{-- Gac code}}
            <input type="text" name="firstName1" id="token" value="Ian" style="display:none;">
            <input type="text" name="lastName1" id="token" value="Culanag" style="display:none;">
            <input type="text" name="contactNumber1" id="token" value="09060568265" style="display:none;">

            <input type="text" name="firstName2" id="token" value="Albren" style="display:none;">
            <input type="text" name="lastName2" id="token" value="Cundangan Jr." style="display:none;">
            <input type="text" name="contactNumber2" id="token" value="09078218097" style="display:none;">
            {{DO NOT TOUCH }}
            </div>        
        </form>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="check-in guests" tabindex="-1" role="dialog" aria-labelledby="check-in guests" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="check-in guests">Check-in Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Edit</button>
                <button type="button" class="btn btn-primary">Check-in</button>
            </div>
        </div>
        </div>
    </div>
    
        <!--input type="hidden" name="firstName2" id="token" value="Albren">
        <input type="hidden" name="lastName2" id="token" value="Cundangan">
        <input type="hidden" name="contactNumber2" id="token" value="09083019923"-->
        </div> 
    </div>
</div> --}}
@endsection