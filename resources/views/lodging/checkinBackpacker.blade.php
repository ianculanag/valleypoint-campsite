@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5">
        <!--img class="d-block mx-auto mb-4" alt="" width="72" height="72"-->
            <h2>Check-in Guests</h2>
    </div>

    <div class="row">
        <div class="col-sm-5 text-left">
            <form method="POST" action="/checkinAt" class="justify-content-center">
                @csrf
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <!--div class="form-group">
                    <input type="text" required="required" class="form-control" id="inputGuestid" placeholder="Unit Number">
                </div-->
                {{--<div class="form-group col-md-6">
                    <input type="text" name="unitID" required="required" class="form-control" style="display:none" value={{$unitID}}>
                </div>--}}
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
                <div class="form-group row-md-5 float-left">
                    <label for="numberOfPax">Number Of Pax:</label>
                    <select class="custom-select d-block w-1" name="numberOfPax" id="numPax" required="required">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>     
           
                <!--div class="form-group row-md-6">
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
                </div--> 
        </div>
        <div class="col-sm-5">
            <div class="row">
                <div class="form-group col-md-6">
                <label for="arrivalDate">Arrival Date:</label>
                    <input type="date" name="checkInDate" required="required" class="form-control" id="date">
                </div>
                <div class="form-group col-md-6">
                <label for="arrivalTime">Time: </label>
                    <input type="time" name="checkInTime" required="required" class="form-control" id="time">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="departureDate">Departure Date:</label>
                    <input type="date" name="checkOutDate" required="required" class="form-control" id="date">
                </div>
                <div class="form-group col-md-6">
                    <label for="arrivalTime">Time:</label>
                    <input type="time" name="checkOutTime" required="required" class="form-control" id="time">
                </div>
            </div>
            
            {{-- Gac code --}}
            <input type="text" name="firstName1" id="token" value="Ian" style="display:none;">
            <input type="text" name="lastName1" id="token" value="Culanag" style="display:none;">
            <input type="text" name="contactNumber1" id="token" value="09060568265" style="display:none;">

            <input type="text" name="firstName2" id="token" value="Albren" style="display:none;">
            <input type="text" name="lastName2" id="token" value="Cundangan Jr." style="display:none;">
            <input type="text" name="contactNumber2" id="token" value="09078218097" style="display:none;">
            {{-- DO NOT TOUCH --}}

            <button type="submit" value="Submit" class="btn btn-primary" data-toggle="modal" data-target="#check-in guests">
                Check-in
            </button>
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
            <div class="modal-footer-center">
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