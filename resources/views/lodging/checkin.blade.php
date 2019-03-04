@extends('layouts.app')

@section('content')
<div class="container">
    <div class="py-5 text-center">
        <!--img class="d-block mx-auto mb-4" alt="" width="72" height="72"-->
            <h2>Check-in Guests</h2>
    </div>

    <div class="col-sm-5 offset-sm-4 text-left">
        <form method="POST" action="/checkinAt" class="justify-content-center">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
            <!--div class="form-group">
                <input type="text" required="required" class="form-control" id="inputGuestid" placeholder="Unit Number">
            </div-->
            <div class="form-group col-md-6">
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
                <input type="email" name="email" required="required" class="form-control" id="inputEmail" placeholder="Email">
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <input type="number" name="numberOfPax" required="required" class="form-control" id="noofpax" placeholder="No. of Pax">
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

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="arrival">Arrival Date and Time:</label>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <input type="date" name="checkinDate" required="required" class="form-control" id="date">
                </div>
                <div class="form-group col-md-6">
                    <input type="time" name="checkinTime" required="required" class="form-control" id="time">
                </div>
            </div>

            <!--div class="row">
                <div class="form-group col-md-4">
                    <select class="custom-select d-block w-20" id="state" required="required">
                        <option value="">Month</option>
                        <option>Jan</option>
                        <option>Feb</option>
                        <option>Mar</option>
                        <option>Apr</option>
                        <option>May</option>
                        <option>Jun</option>
                        <option>Jul</option>
                        <option>Aug</option>
                        <option>Sep</option>
                        <option>Oct</option>
                        <option>Nov</option>
                        <option>Dec</option>
                    </select>
                </div> 
            
                <div class="form-group col-md-4">
                    <select class="custom-select d-block w-20" id="state" required="required">
                        <option value="">Day</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>   
                    </select>
                </div> 

                <div class="form-group col-md-4">
                    <select class="custom-select d-block w-20" id="state" required="required">
                        <option value="">Year</option>
                        <option>2018</option>
                        <option>2019</option>
                        <option>2020</option>
                        <option>2021</option>
                    </select>
                </div>     
            </div-->
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="arrival">Departure Date and Time:</label>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <input type="date" name="checkoutDate" required="required" class="form-control" id="date">
                </div>
                <div class="form-group col-md-6">
                    <input type="time" name="checkoutTime" required="required" class="form-control" id="time">
                </div>
            </div>
            <!--div class="row">
                <div class="form-group col-md-4">
                    <select class="custom-select d-block w-20" id="state" required="required">
                        <option value="">Month</option>
                        <option>Jan</option>
                        <option>Feb</option>
                        <option>Mar</option>
                        <option>Apr</option>
                        <option>May</option>
                        <option>Jun</option>
                        <option>Jul</option>
                        <option>Aug</option>
                        <option>Sep</option>
                        <option>Oct</option>
                        <option>Nov</option>
                        <option>Dec</option>
                    </select>
                </div> 
            
                <div class="form-group col-md-4">
                    <select class="custom-select d-block w-20" id="state" required="required">
                        <option value="">Day</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                        <option>11</option>
                        <option>12</option>
                        <option>13</option>
                        <option>14</option>
                        <option>15</option>
                        <option>16</option>
                        <option>17</option>
                        <option>18</option>
                        <option>19</option>
                        <option>20</option>
                        <option>21</option>
                        <option>22</option>
                        <option>23</option>
                        <option>24</option>
                        <option>25</option>
                        <option>26</option>
                        <option>27</option>
                        <option>28</option>
                        <option>29</option>
                        <option>30</option>
                        <option>31</option>   
                    </select>
                </div> 

                <div class="form-group col-md-4">
                    <select class="custom-select d-block w-20" id="state" required="required">
                        <option value="">Year</option>
                        <option>2018</option>
                        <option>2019</option>
                        <option>2020</option>
                        <option>2021</option>
                    </select>
                </div>     
            </div-->


            <!--div class="progress" style="margin-bottom:1em;">
                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
            </div-->
            
            <!-- Button trigger modal -->
            <button type="submit" value="Submit" class="btn btn-primary" data-toggle="modal" data-target="#check-in guests">
                Check-in
            </button>
                
        </form>
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
    </div>
</div>
@endsection