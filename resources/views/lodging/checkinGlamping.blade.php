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
                            {{--@php
                                $total = 0;
                            @endphp
                            @foreach($charges as $charge)--}}
                            <tr>
                                <td>{{--$charge->serviceName--}}</td>
                                <td style="text-align:right;">{{--$charge->numberOfPax--}}</td>
                                <td style="text-align:right;">{{--$charge->price--}}</td>
                                <td style="text-align:right;">{{--($charge->totalPrice)--}}</td>
                            </tr>
                            {{--@php
                                $total += $charge->totalPrice;
                            @endphp
                            @endforeach --}}
                            <tr>
                                <th colspan="3" scope="row">TOTAL:</th>
                                <th style="text-align:right;">{{--$total--}}</th>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="col-md-8 order-md-1 check-out-form">
                <form method="POST" action="/updateDetails">
                    {{--@csrf--}}
                    <input type="hidden" name="_token" id="token" value="{{-- csrf_token() --}}">
                    <h5 style="margin-bottom:.80em;">Guest Details</h5>
                    <div class="form-group row">
                        <div class="col-md-5 mb-1">
                            <label for="firstName">First name</label>
                            <input class="form-control" type="text" name="firstName" maxlength="15" placeholder="" value="">
                        </div>
                        <div class="col-md-7 mb-1">
                            <label for="lastName">Last name</label>
                            <input class="form-control" type="text" name="lastName"  maxlength="20" placeholder="" value="">
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
                                <input class="form-control" type="text" name="contactNumber" maxlength="11" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control" type="number" name="numberOfPax" placeholder="" value="" min="1" max="10">
                        </div>
                        <div class="col-md-3 mb-1" style="display:none; position:absolute;">
                            <label for="numberOfPax">No. of pax</label>
                            <input class="form-control"  type="number" name="numberOfPax" placeholder="" value="" min="1" max="10">
                        </div>
                        <div class="col-md-4 mb-1 form-group">
                            <label for="accommodationType">Accommodation</label>
                            <select name="serviceName" class="form-control">
                                <option>Glamping</option>
                                <option>Backpacker</option>
                            </select>
                        </div>
                    </div>
                    <hr class="mb-4">
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
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 mb-1">
                            <label for="checkinDate">Check-in date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" name="checkinDate" required="required" class="form-control" id="date" value="">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="checkoutDate">Departure date</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input type="date" name="checkoutDate" required="required" class="form-control" id="date" value="">
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">
                    <div class="form-group row pb-3">
                        <div class="col-md-12 mb-1">
                            <h5 style="margin-bottom:.80em;">Additional Services</h5>
                        </div>
                        <input type="hidden" name="additionalServiceAccommodationID" value="">
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
                    </div>
                    
                    <input class="form-control" type="number" name="numberOfAdditionalCharges" value="1" style="display:none; position:absolute;">
                    <input class="form-control" type="text" name="serviceID1" value="6" style="display:none; position:absolute;">
                    <input class="form-control" type="number" name="numberOfPaxAdditional1" value="5" style="display:none; position:absolute;">
                    <input class="form-control" type="text" name="paymentStatus1" value="paid" style="display:none; position:absolute;">
                    
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