@extends('layouts.app')

@section('content')
    
@endsection
        <div class="container">
            <div class="py-5 text-center">
                <img class="d-block mx-auto mb-4" alt="" width="72" height="72">
                    <h2>Add Reservation</h2>
            </div>

            <div class="col-sm-4 offset-sm-4 text-center">
                <form action="" class="form-inlin justify-content-center">
                    <div class="form-group">
                        <input type="text" required="required" class="form-control" id="inputGuestid" placeholder="GuestID">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" required="required" class="form-control" id="inputFirstname" placeholder="First name">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" required="required" class="form-control" id="inputLastname" placeholder="Last name">
                        </div>  
                    </div> 

                    <div class="form-group">
                        <input type="text" required="required" class="form-control" id="inputContactnum" placeholder="Contact Number">
                    </div>
                    <div class="form-group">
                        <input type="email" required="required" class="form-control" id="inputEmail" placeholder="Email">
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="number" required="required" class="form-control" id="noofpax" placeholder="No. of Pax">
                        </div>
                    </div>
                    <div class="form-group">
                        <select class="custom-select d-block w-100" id="state" required="required">
                            <option value="">Type of Reservation:</option>
                            <option>Glamping</option>
                            <option>Transient</option>
                            <option>Backpacker</option>
                        </select>
                    </div> 

                    <div class="form-group col-md-6">
                        <label for="arrival">Arrival Date & Time:</label>
                    </div>

                    


                    <div class="form-group col-md-5">
                        <label for="arrival">Departure Date:</label>
                    </div>




                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
@endsection