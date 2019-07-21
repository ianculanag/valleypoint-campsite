@extends('layouts.app')

@section('content')
<a href="/print-cashier-shift-report" target="_blank">
<button class="print" style="height:2.5em; width:2.75em; margin-left: 70em; margin-top: 2em">
                    <i class="fa fa-print" aria-hidden="true"></i>
 </button>
</a>   
    <div class="container pb-5">
            <div class="card col-md-8 offset-md-2 col-sm-12 py-4 ">
                <div class="row">
                    <div class="col-md-8 col-sm-8 px-5 pt-3">
                        <h4 class=""> Cashier Shift Report </h4>
                        @if(isset($display))
                        <h6 class=""> {{\Carbon\Carbon::parse($display)->format('F j, o')}} </h6>
                        @else
                        <h6 class=""> {{\Carbon\Carbon::now()->format('F j, o')}}</h6>
                        @endif

                        <form method="POST" action="/">
                             @csrf

                        <div class="form-group row py-0 my-0">
                            <label for="name" class="col-sm-4 pt-2" style="font-size:0.80em;">Name:</label>
                            <input class="form-control-plaintext col-sm-8" type="text" name="name" value="{{ Auth::user()->name }}" readonly>
                        </div>

                        <div class="form-group row py-0 my-0">
                            <label for="shiftStart" class="col-sm-4 pt-2" style="font-size:0.80em;">Shift Start:</label>
                            <input class="form-control-plaintext col-sm-8" type="time" name="shiftStart" value="9:00 AM - 8:00 PM">
                        </div>

                        <div class="form-group row py-0 my-0">
                            <label for="shiftEnd" class="col-sm-4 pt-2" style="font-size:0.80em;">Shift End:</label>
                            <input class="form-control-plaintext col-sm-8" type="time" name="shiftEnd" value="9:00 AM - 8:00 PM">
                        </div>

                        <div class="form-group row py-0 my-0">
                            <label for="cashStart" class="col-sm-4 pt-2" style="font-size:0.80em;">Cash Start:</label>
                            <input class="form-control-plaintext col-sm-8" type="number" name="cashStart" value="₱&nbsp; 0.00">
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-3">
                        <img src={{asset('logo.png')}} class="float-right" style="height:7.5em; width:9.75em;" aria-hidden="true"></img>
                    </div>
                </div>
                <div class="card-body">
                    <div class="px-2">
                        <table class="table table-sm table-bordered" style="font-size:.90em;">
                            <thead>
                            <tr>
                           
                                    <td class="text-center"> Description </td>
                                    <td class="text-center" style="width:7%;"> Qty. </td>
                                    <td class="text-center" style="width:14%;"> Unit Price </td>
                                    <td class="text-center" style="width:14%;"> Total Price </td>
                                    <td class="text-center" style="width:14%;"> Amount Pd. </td>
                                    <td class="text-center" style="width:14%;"> Change Due </td>
                                    <td class="text-center"> Payment time </td>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($shifts) > 1)
                            @php
                                 $totalPrice = 0;
                            @endphp
                                @foreach($shifts as $shift)
                                    <tr class="">
                                     
                                       <td class="text-center">{{$shift->productName}}</td>
                                       <td class="text-center">{{$shift->quantity}}</td>
                                       <td class="text-right">{{$shift->price}}</td>
                                       <td class="text-right">{{$shift->totalPrice}}</td>
                                       <td class="text-right">{{number_format((float)($shift->amount), 2, '.', '')}}</td>
                                       <td class="text-right">{{number_format((float)($shift->changeDue), 2, '.', '')}}</td>
                                       <td class="text-center">{{\Carbon\Carbon::parse($shift->paymentDatetime)->format('g:ia')}}</td>
                                   </tr>
                            </tbody>
                            @php
                                 $totalPrice += $shift->totalPrice;
                             @endphp
                            @endforeach
                        </table>
                    </div>
                    <h6 label for="totalIncome" class="col-sm-4 pt-2" id="restaurantIncomeDaily" style="font-size:1em; margin-left:30em; margin-bottom:2em;">Cash End: ₱{{number_format($totalPrice, 2)}}</label></h6>
                    <h6 label for="totalIncome" class="col-sm-4 pt-2" id="restaurantIncomeDaily" style="font-size:1em; margin-left:30em; margin-bottom:2em;">Total Sales: ₱{{number_format($totalPrice, 2)}}</label></h6>
                    

                    <a data-toggle="modal" data-target="#changeRegister" style="cursor:pointer" class="change-register-details" id="">       
                    <!-- <div class="card mx-2" style="width:10rem; height:5rem; float: right">
                                <div class="card-body"> -->
                                <button type="button" class="btn btn-primary float-right mx-3" type="submit" style="" id="changeRegisterBtn" data-toggle="" data-target="">
                                     Change Register </button>
                        
     <div class="modal fade right" id="changeRegister" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-full-height modal-right modal-notify modal-info" role="document">
            <div class="modal-content">

                {{-- modal-header --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="">Cashier name: {{Auth::user()->name}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    {{-- modal-body --}}
                    <div class="modal-body">
                    {{\Carbon\Carbon::now()->format('F j, o')}}<br>
                    Total Sales: ₱{{number_format($totalPrice, 2)}}<br>
                    <form method="POST" action="">
                    Cash End:<input type="text" required="required" class="form-control" name="Cashend" value="₱{{number_format($totalPrice, 2)}}" disabled>
                    </form>
                    
                    </div>
                    
                    {{-- modal-footer --}}
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="/shiftEnd">
                    <a href="/shiftEnd" 
                    <button type="button" class="btn btn-primary">Change Register</button></a>
                    </form>
                    </div>
                    </div>
</div> 
</div>




                    @endif
                </div>
            </div> 
        </div>      
    </div>
@endsection