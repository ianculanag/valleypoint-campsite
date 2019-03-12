@extends('layouts.app')

@section('content')
<div class="container">
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
            <form method="POST" action="/checkinAt" class="justify-content-center">
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
                        <input type="text" name="firstName" required="required" class="form-control" id="inputfirstName" placeholder="Juan">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" required="required" class="form-control" id="inputlastName" placeholder="Dela Cruz">
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
                    <input type="text" name="contactNumber" required="required" class="form-control" id="inputcontactNumber" placeholder="09#########">
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
                    <input type="date" name="checkinDate" required="required" class="form-control" id="datePicker" value="<?php echo date("Y-m-d");?>">
                </div>
                <div class="form-group col-md-6">
                <label for="arrivalTime">Time: </label>
                    <input type="time" name="checkinTime" required="required" class="form-control" id="time" value="14:00">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="departureDate">Departure Date:</label>
                    <input type="date" name="checkoutDate" required="required" class="form-control" id="date">
                </div>
                <div class="form-group col-md-6">
                    <label for="departureTime">Time:</label>
                    <input type="time" name="checkoutTime" required="required" class="form-control" id="time" value="12:00">
                </div>
            </div>

            <div class="row">
                <div class="card p-2 col-md-11 ">
                <label for="payment">Payment</label>
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
                        <option value="paid">Fully paid</option>
                        <option value="pending">Pending</option>
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
            {{DO NOT TOUCH --}}
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
</div>
@endsection