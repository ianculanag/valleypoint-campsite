@extends('layouts.app')

@section('content')
<a href="/pos-dashboard">
    <span style="float:left;">
        <i class="fa fa-chevron-left" aria-hidden="true"></i>
        <strong>Back</strong>
    </span>
</a>
        <div class="container pb-5"> 
            <div class="row">
                <div class="col-md-4 order-md-8 mb-4 mx-0" style="margin-top: 2.5em;">
                    <div class="card p-0 mx-0">
                        <h4 class="text-muted" style="text-align:center; padding:0.5em;">Charges</h4>
                        <table class="table table-sm" style="font-size:.88em;">
                            <thead>
                                <tr>
                                    <th scope="col" style="width:40%">Description</th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tapsilog</td>
                                    <td>1</td>
                                    <td>99.00</td>
                                    <td>99.00</td>
                                </tr>
                                <tr>
                                    <td>Carbonara</td>
                                    <td>1</td>
                                    <td>159.00</td>
                                    <td>159.00</td>
                                </tr>
                                <tr>
                                    <td>Mango shake</td>
                                    <td>1</td>
                                    <td>120.00</td>
                                    <td>120.00</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" scope="row">TOTAL: 378.00</th>
                                    <th id="invoiceGrandTotal" style="text-align:right;"></th>
                                </tr>
                                <tr>
                                    <td colspan="4"><button type="button" class="btn btn-primary" style="text-align:center;width:8em">
                                        Get payment
                                    </button></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        
                         
                        <div class="row">
                            <div class="col-md-14" style="margin-top: 3em;">
                                <div class="list-group">
                    
                                    <a href="#" class='list-group-item active'>Appetizer</a>
                                    <a href="#" class='list-group-item'>Bread</a>
                                    <a href="#" class='list-group-item'>Breakfast</a>
                                    <a href="#" class='list-group-item'>Group Meals</a>
                                    <a href="#" class='list-group-item'>Noodles</a>
                                    <a href="#" class='list-group-item'>Rice Bowl</a>
                                    <a href="#" class='list-group-item'>Soup</a>
                                    <a href="#" class='list-group-item'>Beverages </a>
                                </div>
                            </div>

                    <div class="card" style="height:24.5em; width: 30em; margin-left: 1em; margin-top: 3em;"> 
                        <div class="list-content" id="">
                            <div class="card" style="width: 7rem; height: 5em;">
                                <div class="card-body">
                                    <p class="card-title">Sizzling Pork Sisig</p>
                                </div>
                            </div> 
                            <div class="card" style="width: 7rem; height: 5em; margin: 1em;">
                                <div class="card-body">
                                    <p class="card-title">Sizzling Tuna</p>
                                </div>
                            </div>
                            <div class="card" style="width: 7rem; height: 5em; margin:1em;">
                                <div class="card-body">
                                    <p class="card-title">Nachos</p>
                                </div>
                            </div>  
                            <div class="card" style="width: 7rem; height: 5em; margin: 1em;">
                                <div class="card-body">
                                    <p class="card-title">Dynamite</p>
                                </div>
                            </div>     
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection