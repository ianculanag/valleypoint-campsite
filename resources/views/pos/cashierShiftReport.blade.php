@extends('layouts.app')

@section('content')
    <div class="container pb-5">
            <div class="card col-md-8 offset-md-2 col-sm-12 py-4 ">
                <div class="row">
                    <div class="col-md-8 col-sm-8 px-5 pt-3">
                        <h4 class=""> Cashier Shift Report </h4>
                        <h6 class="pb-5"> June 24, 2019 </h6>
                        <div class="form-group row py-0 my-0">
                            <label for="name" class="col-sm-4 pt-2" style="font-size:0.80em;">Name:</label>
                            <input class="form-control-plaintext col-sm-8" type="text" name="name" value="Sheila Yu" readonly>
                        </div>
                        <div class="form-group row py-0 my-0">
                            <label for="shiftDuration" class="col-sm-4 pt-2" style="font-size:0.80em;">Shift Duration:</label>
                            <input class="form-control-plaintext col-sm-8" type="text" name="shiftDuration" value="9:00 AM - 8:00 PM" readonly>
                        </div>
                        <div class="form-group row py-0 my-0">
                            <label for="cashStart" class="col-sm-4 pt-2" style="font-size:0.80em;">Cash Start:</label>
                            <input class="form-control-plaintext col-sm-8" type="text" name="cashStart" value="₱ 1800.00" readonly>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <img src={{asset('logo.jpg')}} class="float-right" style="height:7.5em; width:9.75em;" aria-hidden="true"></img>
                    </div>
                </div>
                <div class="card-body">
                    <div class="px-2">
                        <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <tbody>
                                <tr>
                                    <td class="text-center" style="width:6%;"> No. </td>
                                    <td class="text-center"> Description </td>
                                    <td class="text-center" style="width:7%;"> Qty. </td>
                                    <td class="text-center" style="width:14%;"> Unit Price </td>
                                    <td class="text-center" style="width:14%;"> Total Price </td>
                                    <td class="text-center" style="width:14%;"> Amount Pd. </td>
                                    <td class="text-center" style="width:14%;"> Change Due </td>
                                    <td class="text-center"> Payment time </td>
                                </tr>
                                <tr>
                                    <td> 1 </td>
                                    <td> Tapsilog </td>
                                    <td> 3 </td>
                                    <td class="text-right"> ₱ 100.00 </td>
                                    <td class="text-right"> ₱ 300.00 </td>
                                    <td class="text-right"> ₱ 300.00 </td>
                                    <td class="text-right"> ₱ 0.00 </td>
                                    <td> 9:35 AM </td>
                                </tr>
                                <tr>
                                    <td> 2 </td>
                                    <td> Carbonara </td>
                                    <td> 2 </td>
                                    <td class="text-right"> ₱ 140.00 </td>
                                    <td class="text-right"> ₱ 280.00 </td>
                                    <td class="text-right"> ₱ 300.00 </td>
                                    <td class="text-right"> ₱ 20.00 </td>
                                    <td> 10:45 AM </td>
                                </tr>
                                <tr>
                                    <td> 3 </td>
                                    <td> Carbonara </td>
                                    <td> 1 </td>
                                    <td class="text-right"> ₱ 140.00 </td>
                                    <td class="text-right"> ₱ 140.00 </td>
                                    <td class="text-right"> ₱ 150.00 </td>
                                    <td class="text-right"> ₱ 10.00 </td>
                                    <td> 11:30 AM </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group row py-0 my-0 col-md-8">
                        <label for="cashEnd" class="col-sm-4 pt-2" style="font-size:0.80em;">Cash End:</label>
                        <input class="form-control-plaintext col-sm-8" type="text" name="cashEnd" value="₱ 2520.00" readonly>
                    </div>
                    <div class="form-group row py-0 my-0 col-md-8">
                        <label for="shiftSales" class="col-sm-4 pt-2" style="font-size:0.80em;">Total Sales: </label>
                        <input class="form-control-plaintext col-sm-8" type="text" name="name" value="₱ 720.00" readonly>
                    </div>
                    <button type="button" class="btn btn-primary float-right mx-3" style="" id="" data-toggle="" data-target="">
                        Change Register
                    </button>
                </div>
            </div> 
        </div>      
    </div>
@endsection