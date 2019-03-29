@extends('layouts.app')

@section('content')
@if(count($unit) > 0)
    @foreach($unit as $unit)
<div class="container">
    <div class="pt-3 pb-3 text-center">
        <a href="/transient-backpacker">
            <span style="float:left;">
                <i class="fa fa-chevron-left" aria-hidden="true"></i>
                <strong>Back</strong>
            </span>
        </a>
        <h3>Check-in Form</h3>
    </div>

    <form method="POST" action="/checkinBackpacker">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4 mx-0">
                <div class="card p-0 mx-0">
                    <h4 class="text-muted" style="text-align:center; padding:0.5em;">Invoice</h4>
                    <table class="table table-striped" style="font-size:.83em;">
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
                            <td id="invoiceDescription{{$unit->unitNumber}}">Backpacker</td>
                            <td id="invoiceQuantity{{$unit->unitNumber}}" style="text-align:right;">1</td>
                            <td id="invoiceUnitPrice{{$unit->unitNumber}}" style="text-align:right;">750</td>
                            <td id="invoiceTotalPrice{{$unit->unitNumber}}" style="text-align:right;" class="invoicePrices"></td>
                        </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" scope="row">TOTAL:</th>
                                <th id="invoiceGrandTotal" style="text-align:right;"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>                

            <div class="col-md-8 order-md-1">
                <h5 style="margin-bottom:.80em;">Guest Details</h5>
                <div class="form-group row">
                    <div class="col-md-5 mb-1">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" required class="form-control" maxlength="15" placeholder="">
                    </div>
                        <div class="col-md-5 mb-1">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" required class="form-control" maxlength="20" placeholder="">
                        </div>  
                    </div> 
                    <div class="form-group row">
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
                        <div class="col-md-3 mb-1">
                            <label for="unitNumberOfPax">No. of pax</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-users" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <input class="form-control numberOfPaxBackpacker" id="PaxBackpacker" type="number" placeholder="" value="" min="1" max="10">
                            </div>
                        </div>
                        <div class="col-md-3 mb-1">
                            <label for="accommodationType">Accommodation</label>
                            <input type="text" id="accommodationType" class="form-control" placeholder="Backpacker" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                            <div class="col-md-5 mb-1">
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
                            <div class="col-md-5 mb-1">
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
                    <div class="form-group row" id="unitDetails">
                        <div class="col-md-3 mb-1">
                            <label for="unitID">No. of bunk/s</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-bed" aria-hidden="true"></i>
                                    </span>
                                </div>
                            <input class="form-control" type="number" id="numberOfBunks" name="numberOfBunks" required placeholder="" value="1" min="1" max="20">
                            </div>
                        </div>
                        <div class="col-md-6 mb-1">
                            <label for="roomNumber">Room/s</label>
                            <select name="roomNumber" class="form-control" id="room">
                                <option value="1">Room 1</option>
                                <option value="2">Room 2</option>
                                <option value="3">Room 3</option>
                                <option value="4">Room 4</option>
                                <option value="5">Room 5</option>
                                <option value="6">Room 6</option>
                                <option value="7">Room 7</option>
                                <option value="8">Room 8</option>
                                <option value="9">Room 9</option>
                            </select>

                            
                        </div>
                        <div style="margin-top:2em;">
                            <div class="input-group">
                                <button type="button" id="additionalbed" class="btn btn-primary additionalbed">
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                </button>
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
                    
                    {{--<input class="form-control" type="number" name="numberOfAdditionalCharges" value="1" style="display:none; position:absolute;">
                    <input class="form-control" type="text" name="serviceID1" value="6" style="display:none; position:absolute;">
                    <input class="form-control" type="number" name="numberOfPaxAdditional1" value="5" style="display:none; position:absolute;">
                    <input class="form-control" type="text" name="paymentStatus1" value="paid" style="display:none; position:absolute;">--}}
                    
                    <div style="float:right;">
                        <button class="btn btn-success" style="width:10em;" type="submit">Check-in</button>
                        <a href="/transient-backpacker" style="text-decoration:none;">
                            <button class="btn btn-secondary" style="width:10em;" type="button">Cancel</button>
                        </a>
                    </div>       
                </div>
            </form>
        </div>
    </div> 
</div>
</div>
@endforeach  
@endif
@endsection