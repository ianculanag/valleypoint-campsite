@extends('layouts.app')

@section('content')
    
        <div class="container">
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" alt="" width="72" height="72">
                    <h2>Add Reservation</h2>
            </div>

            <div class="col-sm-4 offset-sm-4 text-center">
                <form  method="POST" action="/addReservation" class="form-inlin justify-content-center">
                    @csrf
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                    <!--div class="form-group">
                        <input type="text" required="required" class="form-control" id="inputGuestid" placeholder="GuestID">
                    </div-->

                    <div class="form-group" col-md-6>
                        <input type="text" name="unitID" required="required" class="form-control" style="display:none" value={{$unitID}}>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                                <input type="text" name="firstName" required="required" class="form-control" id="inputFirstname" placeholder="First name">
                        </div>
                        <div class="form-group col-md-6">
                                <input type="text" name="lastName" required="required" class="form-control" id="inputLastname" placeholder="Last name">
                            </div>  
                    </div>
                      <div class="form-group">
                        <input type="text" name="contactNumber" required="required" class="form-control" id="inputContactnum" placeholder="Contact Number">
                    </div>
                    <div class="form-group">
                        <input type="email"  name ="email" required="required" class="form-control" id="inputEmail" placeholder="Email">
                    </div>

                    <!--div class="row">
                        <div class="form-group col-md-6">
                            <input type="number" name ="numberOfPax" required="required" class="form-control" id="noofpax" placeholder="No. of Pax">
                        </div-->
                        <div class="form-group col-md-4">
                                <select class="custom-select d-block w-1" id="numPax" required="required">
                                    <option value="">numberOfPax</option>
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
                        </div>

                   <div class="row" id="outputArea">
                       <!--This is the output of the number of pax that is located at custom.js-->
                        <!--jQuery("#numPax").change(function() {
                            var htmlString = "";
                            var len = jQuery(this).val();
                            for (var i = 1; i < len; i++) {
                                htmlString += "<div class='row'>";
                                htmlString += "<div class='form-group col-md-4'>";
                                htmlString +=" <input type='text' name='firstName' required='required' class='form-control'  placeholder='First name'>";
                                htmlString +="</div>";
                                htmlString +="<div class='form-group col-md-4'>";
                                htmlString +="<input type='text' name='lasttName' required='required' class='form-control'  placeholder='Last name'>";
                                htmlString +="</div>";
                                htmlString +="<div class='form-group col-md-4'>";
                                htmlString +="<input type='text' name='contactNumber' required='required' class='form-control'  placeholder='Contact Number'>";
                                htmlString +="</div>";
                                htmlString +="</div>";
                            }
                                jQuery("#outputArea").html(htmlString);
                        });--> 
                    </div>
                    
                    </div>


                    <!--div class="form-group">
                        <select class="custom-select d-block w-100" id="state" required="required">
                            <option value="">Type of Reservation:</option>
                            <option>Glamping</option>
                            <option>Transient</option>
                            <option>Backpacker</option>
                        </select>
                    </div--> 

                    <div class="form-group col-md-6">
                        <label for="arrival">Arrival Date & Time:</label>
                    </div>


            <div class="row">
                    <div class="form-group col-md-6">
                        <input type="date" name="checkinDate" required="required" class="form-control" id="date">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="time" name="checkinTime" required="required" class="form-control" id="time">
                    </div>
                </div>

                    <div class="form-group col-md-5">
                        <label for="arrival">Departure Date:</label>
                    </div>

                    <div class="row">
                            <div class="form-group col-md-6">
                                <input type="date" name="checkoutDate" required="required" class="form-control" id="date">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="time" name="checkoutTime" required="required" class="form-control" id="time">
                            </div>
                        </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
@endsection