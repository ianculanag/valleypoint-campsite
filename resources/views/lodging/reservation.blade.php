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
                <h2>Reservation Form</h2>
        </div>
<div class="row">
        <div class="col-sm-5 text-left">
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
                <div class="form-group col-sm-4">
                    <div class="row">
                            <label for="numberOfPax" >Number Of Pax:</label>
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
                    </div>
        </div>
        <div class="col-sm-5">
            <div class="row">
                <div class="form-group col-md-6">
                <label for="reservationDate">Reservation Date:</label>
                    <input type="date" name="reservationDate" required="required" class="form-control" id="date">
                </div>
            </div>
            
            <div class="row">
                    <div class="form-group col-md-6">
                            <label for="accommodationType" >Accommodation Type:</label>
                            <select class="custom-select d-block w-1" name="accommodationType" id="numPax" required="required">
                                <option value="1">Glamping/Tent</option>
                                <option value="2">Backpacker</option>
                            </select>
                        </div>
            </div>
            <div class="col-sm-6">
                    <button type="submit" value="submit" style="width:10em;" class="btn btn-info float-right mt-5" data-toggle="modal" data-target="#submit reservation">
                            Submit
                    </button>
            </div>
            </div>        
        </form>
        </div>
        </div> 
    </div>
</div>
@endsection