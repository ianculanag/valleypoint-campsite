@extends('layouts.app')

@section('content')
    @foreach ($guest as $guestDetails)
    <div class="container pb-5">
        <div class="py-3 text-center">
            <a href="{{ URL::previous() }}">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
            <h3>Guest Details</h3>
        </div>        
        <form class="form" method="POST" action="/update-backpacker-details">
        @csrf
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                    
        <input type="hidden" name="accommodationID" value="{{$guestDetails->accommodationID}}">

        
        <div id="selectedAdditionalPayments" style="display:none;">
        </div>

        <div class="row" role="tablist" aria-multiselectable="true">
            <div class="col-md-4 order-md-2 mb-4 mx-0 px-0">
                <!-- Payment Transactions Accordion -->
                <div id="accordion">
                    <!-- All Paid Transations -->
                    <div class="card my-0">
                        <p class="card-header" role="tab" id="headingOne">
                            <!--a class="collapsed d-block" data-toggle="collapse" href="#collapse-collapsed" aria-expanded="true" aria-controls="collapse-collapsed" id="heading-collapsed" style="font-size:1.1em;"-->
                            <a class="collapsed d-block" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-size:1.1em;">
                                <!--i class="fa fa-chevron-down pull-right" style="float:right;"></i-->
                                Paid Charges
                            </a>
                        </p>
                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body p-0">
                                <table class="table table-striped m-0 display nowrap transactionTable" style="font-size:.88em;">
                                    <thead>
                                        <tr>
                                        @if(count($payments) > 0)
                                            @php
                                                
                                            @endphp
                                            <th scope="col" style="width:55%">Description</th>
                                            <th scope="col">Qty.</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Amount</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total = 0;
                                            $totalPayment = 0;
                                            $balance = 0;
                                            $amountPaid = 0;
                                        @endphp
                                        @foreach($payments as $payment)
                                        <tr>
                                            <td>{{$payment->serviceName}}</td>
                                            <td style="text-align:right;">{{$payment->quantity}}</td>
                                            {{--<td style="text-align:right;">{{number_format($payment->price, 2)}}</td>--}}
                                        @php
                                            $amountPaid = ($payment->totalPrice) - ($payment->balance);
                                        @endphp
                                            <td style="text-align:right;">{{number_format($payment->totalPrice, 2)}}</td>
                                            <td style="text-align:right;">{{number_format($amountPaid, 2)}}</td>
                                        </tr>
                                        @php
                                            $total += $payment->totalPrice;
                                            $totalPayment += $amountPaid;
                                            //$totalPayment += $payment->amount;
                                            //$balance = $total - $totalPayment;
                                        @endphp
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" scope="row">TOTAL:</th>
                                            <th style="text-align:right;">₱&nbsp;{{number_format($total, 2)}}</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" scope="row">AMOUNT:</th>
                                            <th style="text-align:right;">₱&nbsp;{{number_format($totalPayment, 2)}}</th>
                                        </tr>
                                        {{--<tr>
                                            <th colspan="1">Amount Paid:</th>
                                            <th style="text-align:right;"  colspan="3">
                                            <input type="number" name="amountPaid" placeholder="0" min="0" style="text-align:right;" class="form-control" id="amount" required>
                                            </th>
                                        </tr>--}}
                                    </tfoot>
                                    @else
                                        <td class="text-center">
                                            No payments to show
                                        </td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Unpaid Charges -->
                    <div class="card my-0">
                        <p class="card-header" role="tab" id="headingTwo">
                            <a class="collapsed d-block" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="font-size:1.1em;">
                                <!--i class="fa fa-chevron-down pull-right" style="float:right;"></i-->
                                Pending Charges
                            </a>
                        </p>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="card-body p-0">
                                <table class="table table-striped m-0 display nowrap transactionTable" style="font-size:.88em;">
                                    <thead>
                                        @if(count($pendingPayments) > 0)
                                        <tr>
                                            <th scope="col" style="width:55%">Description</th>
                                            <th scope="col">Qty.</th>
                                            <th scope="col">Total</th> 
                                            <th scope="col">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoiceRows">
                                        @php
                                            $total = 0;
                                            $totalPayment = 0;
                                            $balance = 0;
                                            $totalBalance = 0;
                                        @endphp
                                        @foreach($pendingPayments as $pending)
                                        @php
                                            $total += $pending->totalPrice;
                                            //$totalBalance = $total - $totalPayment;

                                            $balance = $pending->balance;
                                            $totalBalance += $balance;

                                            $identifier = 'Pending'.$loop->iteration;
                                        @endphp
                                        <tr id="invoiceRow{{$identifier}}">
                                            <td id="invoiceDescription{{$identifier}}" class="invoiceDescriptions">{{$pending->serviceName}}</td>
                                            <td style="display:none;"><input type="text" name="charge{{$loop->index}}" value="{{$pending->chargeID}}"></td>
                                            <td style="display:none;"><input id="invoiceCheckBox{{$identifier}}" class="form-check-input invoiceCheckboxes" type="checkbox" checked></td>
                                            <td id="invoiceQuantity{{$identifier}}"style="text-align:right;" class="invoiceQuantities">{{$pending->quantity}}</td>
                                            <td id="invoicePrice{{$identifier}}"style="text-align:right;" class="invoicePrices">{{(number_format($pending->totalPrice, 2))}}</td>
                                            @if($pending->remarks == 'unpaid')
                                            <td id="invoiceBalance{{$identifier}}" style="text-align:right;" class="invoiceBalances">{{(number_format($pending->balance, 2))}}</td>
                                            @else
                                            <td id="invoiceBalance{{$identifier}}" style="text-align:right;" class="invoiceBalances">{{number_format($pending->balance, 2)}}</td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="2" scope="row">TOTAL:</th>
                                            <th id="invoiceGrandTotal" style="text-align:right;">₱&nbsp;{{number_format($total, 2)}}</th>
                                            <th></th>
                                        </tr>
                                        <tr id="rowAmountPaid" style="display:none">
                                            <th colspan="3" scope="row">AMOUNT PAID:</th>
                                            <th id="invoiceAmountPaid" style="text-align:right;"></th>
                                        </tr>                                      
                                        <tr>
                                            <th colspan="3" scope="row">BALANCE:</th>
                                            <th id="invoiceTotalBalance" style="text-align:right;">₱&nbsp;{{number_format($totalBalance, 2)}}</th>
                                        </tr>
                                        <tr style="display:none;">
                                            <input type="number" name="chargesCount" style="display:none;" value="{{count($pendingPayments)}}">
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            @if(count($pendingPayments) > 0)
                                            <button type="button" class="btn btn-primary btn-block" id="showChargesModal" data-toggle="modal" data-target="#chargesModal">
                                                Get payment
                                            </button>
                                            @else
                                            <button type="button" class="btn btn-primary btn-block" id="showChargesModal" data-toggle="modal" data-target="#chargesModal" disabled>
                                                Get payment
                                            </button> 
                                            @endif
                                            <a href="/view-guests-payments/{{$guestDetails->accommodationID}}" style="text-decoration: none">
                                            <button type="button" class="btn btn-info btn-block mt-1" id="viewGuestPaymentsButton">
                                                View full payment details
                                            </button></a> 
                                            </td>
                                            </tr>
                                    </tfoot>
                                    @else
                                        <tr style="">
                                            <th scope="col" style="width:55%">Description</th>
                                            <th scope="col">Qty.</th>
                                            <th scope="col">Total</th> 
                                            <th scope="col">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoiceRows" style="">
                                        <!--tr>
                                            <td ></td>
                                            <td style="text-align:right;"></td>
                                            <td style="text-align:right;"></td>
                                            <td style="text-align:right;" class="invoicePrices"></td>
                                            <td style="text-align:right;"></td>
                                        </tr-->
                                        <tr>
                                            <td colspan="5" id="noPendingPayments" class="text-center">
                                                No pending payments to show
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot style="">
                                        <tr>
                                            <th colspan="2" scope="row">TOTAL:</th>
                                            <th id="invoiceGrandTotal" style="text-align:right;"></th>
                                            <th></th>
                                        </tr>
                                        <tr id="rowAmountPaid" style="display:none">
                                            <th colspan="3" scope="row">AMOUNT PAID:</th>
                                            <th id="invoiceAmountPaid" style="text-align:right;"></th>
                                        </tr>  
                                        <tr>
                                            <th colspan="3" scope="row">BALANCE:</th>
                                            <th id="invoiceTotalBalance" class="invoiceTotalBalance" style="text-align:right;"></th>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                            @if(count($pendingPayments) > 0)
                                            <button type="button" class="btn btn-primary btn-block" id="showChargesModal" data-toggle="modal" data-target="#chargesModal">
                                                Get payment
                                            </button>
                                             @else
                                            <button type="button" class="btn btn-primary btn-block" id="showChargesModal" data-toggle="modal" data-target="#chargesModal" disabled>
                                                Get payment
                                            </button> 
                                            @endif
                                            <a href="/view-guests-payments/{{$guestDetails->accommodationID}}" style="text-decoration: none">
                                            <button type="button" class="btn btn-info btn-block mt-1" id="viewGuestPaymentsButton">
                                                View full payment details
                                            </button></a> 
                                            </td>
                                        </tr>
                                    </tfoot>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Payment Transactions Accordion -->
            </div>
            <div class="col-md-8 order-md-1 check-out-form">
                    <div class="form-group col-md-6" style="position: absolute;">
                        <input type="text" name="guestID" required="required" class="form-control" style="display:none" value="{{$guestDetails->guestID}}">
                        <input style="display:none" class="form-control" type="text" name="unitID" value="{{$guestDetails->unitID}}">
                    </div>
                    <h5 style="margin-bottom:.80em;" {{--data-toggle="collapse" data-target="#guestDetails" aria-expanded="false" aria-controls="collapseExample"--}}>Guest Details</h5>
                    <div {{--class="collapse"--}} id="guestDetails">
                        <div class="form-group row">
                            <div class="col-md-4 mb-1">
                                <label for="firstName">First name</label>
                                <input class="form-control" type="text" name="firstName" maxlength="15" placeholder="" value="{{$guestDetails->firstName}}" required>
                            </div>
                            <div class="col-md-5 mb-1">
                                <label for="lastName">Last name</label>
                                <input class="form-control" type="text" name="lastName"  maxlength="20" placeholder="" value="{{$guestDetails->lastName}}" required>
                            </div>
                            <div class="col-md-3 mb-1">
                                <label for="unitNumberOfPax">No. of pax</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input class="form-control numberOfPaxBackpacker" name="numberOfPaxBackpacker" type="number" placeholder="" value="{{$guestDetails->numberOfPax}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-1">
                                <label for="contactNumber">Contact number</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-phone" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input class="form-control" type="text" name="contactNumber" maxlength="11" placeholder="" value="{{$guestDetails->contactNumber}}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="glamping">Accommodation</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" name="glamping" maxlength="11" placeholder="" value="Backpacker" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--<div class="col-md-4 mb-1 form-group">
                        <label for="numberOfPax">Stay duration as of now</label>
                            @php
                                $checkin = new DateTime($guestDetails->checkinDatetime);
                                $now = new DateTime("now");
                                $stayDuration = date_diff($checkin, $now)->days+1;
                            @endphp
                        <input class="form-control" type="number" name="stayDuration" placeholder="" value="{{$stayDuration}}" disabled>
                    </div>--}}
                    <hr class="mb-4">

                    <h5 style="margin-bottom:.80em;">Unit Details</h5>
                    <div class="form-group row">
                        <div class="container" id="divUnits">
                            <div class="form-group row mb-0 pb-0" id="divUnits{{$guestDetails->unitNumber}}"> 
                                <div class="col-md-1 mb-1" id="divUnitNumberCount">
                                    <input type="text" readonly class="form-control-plaintext pt-0 my-0" style="text-align:center;" value="" disabled>
                                    <input type="text" readonly class="form-control-plaintext mb-0" style="text-align:center; font-weight:bold;" value="1">
                                </div>
                                <div class="form-group row col-md-11 px-0 mx-0 my-0">
                                <div class="col-md-2 mb-1" id="divUnitNumber{{$guestDetails->unitNumber}}">
                                    <label for="unitNumber">Unit number</label>
                                    <input type="text" class="form-control unit{{$guestDetails->unitNumber}}" value="{{$guestDetails->unitNumber}}" readonly>
                                </div>
                                <div class="col-md-2 mb-1" id="divNumberOfBeds{{$guestDetails->unitNumber}}">
                                    <label for="additionalServiceUnitPrice">No. of beds</label>
                                    <select class="form-control numberOfBeds" name="numberOfBeds{{$guestDetails->unitNumber}}" id="numberOfBeds{{$guestDetails->unitNumber}}">
                                        @for($index = 1; $index <= $guestDetails->capacity; $index++)
                                        @if($guestDetails->numberOfBunks == $index)
                                        <option value="{{$index}}" selected>{{$index}}</option>
                                        @else
                                        <option value="{{$index}}">{{$index}}</option>
                                        @endif
                                        @endfor
                                    </select>
                                    <input type="hidden" id="maxCapacity{{$guestDetails->unitNumber}}" value="{{$guestDetails->capacity}}">
                                </div>
        
                                <div class="col-md-4 mb-1" id="divCheckinDate{{$guestDetails->unitNumber}}">
                                    <label for="checkinDate">Check-in date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="checkinDate{{$guestDetails->unitNumber}}" required="required" class="form-control checkinDatesBackpacker" id="checkinDate{{$guestDetails->unitNumber}}" value="{{\Carbon\Carbon::parse($guestDetails->checkinDatetime)->format('Y-m-d')}}" readonly>
                                    </div>
                                </div>
        
                                <div class="col-md-4 mb-0" id="divCheckoutDate{{$guestDetails->unitNumber}}">
                                    <label for="checkoutDate">Check-out date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="checkoutDate{{$guestDetails->unitNumber}}" required="required" class="form-control checkoutDatesBackpacker" id="checkoutDate{{$guestDetails->unitNumber}}" value="{{\Carbon\Carbon::parse($guestDetails->checkoutDatetime)->format('Y-m-d')}}">
                                        {{--<input type="text" name="stayDuration" id="stayDuration" required="required" style="display:none;position:absolute;" value="">--}}
                                    </div>
                                </div>  
                            </div>
                            </div>

                            @if(count($otherUnits) > 0)
                            @foreach($otherUnits as $otherUnit)
                            <div class="form-group row mb-0 pb-0" id="divUnits{{$otherUnit->unitNumber}}"> 
                                <div class="col-md-1 mb-0" id="divUnitNumberCount">
                                    <input type="text" readonly class="form-control-plaintext mb-0" style="text-align:center; font-weight:bold;" value="{{(int)$loop->iteration + 1}}">
                                </div>
                                <div class="form-group row col-md-11 px-0 mx-0 my-0">
                                <div class="col-md-2 mb-1" id="divUnitNumber{{$otherUnit->unitNumber}}">
                                    <input type="text" class="form-control unit{{$otherUnit->unitNumber}}" value="{{$otherUnit->unitNumber}}" readonly>
                                </div>
                                <div class="col-md-2 mb-1" id="divNumberOfBeds{{$otherUnit->unitNumber}}">
                                    <select class="form-control numberOfBeds" name="numberOfBeds{{$otherUnit->unitNumber}}" id="numberOfBeds{{$otherUnit->unitNumber}}">
                                        @for($index = 1; $index <= $otherUnit->capacity; $index++)
                                        @if($otherUnit->numberOfBunks == $index)
                                        <option value="{{$index}}" selected>{{$index}}</option>
                                        @else
                                        <option value="{{$index}}">{{$index}}</option>
                                        @endif
                                        @endfor
                                    </select>
                                    <input type="hidden" id="maxCapacity{{$otherUnit->unitNumber}}" value="{{$otherUnit->capacity}}">
                                </div>
        
                                <div class="col-md-4 mb-1" id="divCheckinDate{{$otherUnit->unitNumber}}">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="checkinDate{{$otherUnit->unitNumber}}" required="required" class="form-control checkinDatesBackpacker" id="checkinDate{{$otherUnit->unitNumber}}" value="{{\Carbon\Carbon::parse($otherUnit->checkinDatetime)->format('Y-m-d')}}" readonly>
                                    </div>
                                </div>
        
                                <div class="col-md-4 mb-1" id="divCheckoutDate{{$otherUnit->unitNumber}}">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="checkoutDate{{$otherUnit->unitNumber}}" required="required" class="form-control checkoutDatesBackpacker" id="checkoutDate{{$otherUnit->unitNumber}}" value="{{\Carbon\Carbon::parse($otherUnit->checkoutDatetime)->format('Y-m-d')}}">
                                        {{--<input type="text" name="stayDuration" id="stayDuration" required="required" style="display:none;position:absolute;" value="">--}}
                                    </div>
                                </div>  
                            </div>
                            </div>

                            @endforeach
                            @endif
        
                            {{--@if(count($otherReservedUnits) > 0)
                            @foreach($otherReservedUnits as $otherReservedUnit)                    
                            <div class="form-group row mb-0 pb-0" id="divUnits{{$otherReservedUnit->unitNumber}}">
                                <div class="col-md-2 mb-1" id="divUnitNumber{{$otherReservedUnit->unitNumber}}">
                                    <input type="text" class="form-control unit{{$otherReservedUnit->unitNumber}}" value="{{$otherReservedUnit->unitNumber}}" readonly data-toggle="tooltip" data-placement="bottom" data-html="true" title="Click to split dates." style="cursor:pointer">
                                </div>
                                <div class="col-md-2 mb-1" id="divNumberOfBeds{{$otherReservedUnit->unitNumber}}">
                                    <select class="form-control numberOfBeds" name="numberOfBeds{{$otherReservedUnit->unitNumber}}" id="numberOfBeds{{$otherReservedUnit->unitNumber}}">
                                        @for($index = 1; $index <= $otherReservedUnit->capacity; $index++)
                                        @if($otherReservedUnit->numberOfBunks == $index)
                                        <option value="{{$index}}" selected>{{$index}}</option>
                                        @else
                                        <option value="{{$index}}">{{$index}}</option>
                                        @endif
                                        @endfor
                                    </select>
                                    <input type="hidden" id="maxCapacity{{$otherReservedUnit->unitNumber}}" value="{{count($beds)}}">
                                </div>
        
                                <div class="col-md-4 mb-1" id="divCheckinDate{{$otherReservedUnit->unitNumber}}">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="checkinDate{{$otherReservedUnit->unitNumber}}" required="required" class="form-control checkinDatesBackpacker" id="checkinDate{{$otherReservedUnit->unitNumber}}" value="{{\Carbon\Carbon::parse($otherReservedUnit->checkinDatetime)->format('Y-m-d')}}">
                                    </div>
                                </div>
        
                                <div class="col-md-4 mb-1" id="divCheckoutDate{{$otherReservedUnit->unitNumber}}">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="date" name="checkoutDate{{$otherReservedUnit->unitNumber}}" required="required" class="form-control checkoutDatesBackpacker" id="checkoutDate{{$otherReservedUnit->unitNumber}}" value="{{\Carbon\Carbon::parse($otherReservedUnit->checkoutDatetime)->format('Y-m-d')}}">
                                    </div>
                                </div>                  
                            </div>
                            @endforeach
                            @endif--}}
                        {{--</div>--}}
                        
                        </div>
                    </div>
                    <hr class="mb-4 mt-4">
                    <div class="form-group row pb-3" id="divAdditionalServices">
                        <div class="col-md-12 mb-1">
                            <h5 style="margin-bottom:.80em;">Additional Services</h5>
                        </div>
                        <input type="hidden">
                        <div class="col-md-3 mb-1" id="divServiceName">
                            <label for="additionalServiceName">Service name</label>
                            <select name="additionalServiceName" id="serviceSelect" class="form-control serviceSelect">
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
                            <input class="form-control paxSelect" type="number" id="additionalServiceNumberOfPax" placeholder="" value="" min="1" max="10">
                        </div>
                        <div class="col-md-3 mb-1" id="divUnitPrice">
                            <label for="additionalServiceUnitPrice">Unit price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input class="form-control additionalServiceUnitPrice" type="text" id="additionalServiceUnitPrice" name="additionalServiceUnitPrice" placeholder="" value="" disabled>
                                <input class="form-control additionalServiceUnitPrice" type="text" style="display:none;float:left;" id="additionalServiceUnitPrice" placeholder="" value="">
                            </div>
                        </div>
                        <div class="col-md-3 mb-1" id="divTotalPrice">
                            <label for="additionalServiceTotalPrice">Total price</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₱</span>
                                </div>
                                <input class="form-control additionalServiceTotalPrice" type="text" id="additionalServiceTotalPrice" name="additionalServiceTotalPrice" placeholder="" value="" disabled>
                                <input class="form-control additionalServiceTotalPrice" type="text" style="display:none;float:left;" id="additionalServiceTotalPrice" placeholder="" value="">
                            </div>
                        </div>
                        <div style="margin-top:2em;" id="divButton">
                            <div class="input-group">
                                <button type="button" id="additionalServiceFormAddExtra" class="btn btn-primary additionalServiceFormAddExtra">
                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                </button>
                            </div>
                        </div>

                        
                        <input type="number" style="display:none;float:left;" id="additionalServicesCount" name="additionalServicesCount" value="0">
                    </div>
                
                    {{--<input class="form-control" type="number" name="numberOfAdditionalCharges" value="1" style="display:none; position:absolute;">
                    <input class="form-control" type="text" name="serviceID1" value="6" style="display:none; position:absolute;">
                    <input class="form-control" type="number" name="numberOfPaxAdditional1" value="5" style="display:none; position:absolute;">
                    <input class="form-control" type="text" name="paymentStatus1" value="paid" style="display:none; position:absolute;">--}}
                    
                    <div class="mt-3" style="float:right;">
                        <button class="btn btn-success" style="width:10em;" type="submit">Save</button>
                        <a style="text-decoration:none;" href="/checkout-backpacker/{{$guestDetails->unitID}}">
                            <button class="btn btn-primary" style="width:11em;" type="button" id="checkoutUnit">Check-out</button>
                        </a>
                        <a style="text-decoration:none;" href="/glamping">
                            <button class="btn btn-secondary" style="width:11em;" type="button" id="cancelChanges">Cancel</button>
                        </a>
                        <button type="button" class="btn btn-primary" style="display:none;" id="unsavedChanges" data-toggle="modal" data-target="#unsavedChangesModal">
                            Leave
                        </button>
                    </div>
            </div>
        </div>
    </div>
    <!-- charges modal -->
    <div class="modal fade" id="chargesModal" tabindex="-1" role="dialog" aria-labelledby="chargesModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Charges</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <table class="table table-striped m-0 display nowrap transactionTable" style="font-size:1em;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th scope="col" style="width:50%">
                                        <input class="form-check-input" type="checkbox" id="selectAllBalances" checked>
                                        Description
                                    </th>
                                    <th scope="col">Qty.</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Balance</th>
                                </tr>
                            </thead>
                            <tbody id="chargesRows">
                                <tr>
                                    <td></td>
                                    <td>
                                        <!--div class="form-check"-->
                                        <input class="form-check-input" type="checkbox" id="charge1" checked>
                                        Glamping 4 pax
                                        <!--/div-->
                                    </td>
                                    <td style="text-align:right;">4</td>
                                    <td style="text-align:right;" class="chargesPrices">3400</td>
                                    <td>
                                        <button type="button" id="deleteCharge1" class="btn btn-sm btn-danger deleteCharge">
                                            <span class="fa fa-minus" aria-hidden="true"></span>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <!--div class="form-check"-->
                                        <input class="form-check-input" type="checkbox" id="charge2" checked>
                                        Airsoft
                                        <!--/div-->
                                    </td>
                                    <td style="text-align:right;">2</td>
                                    <td style="text-align:right;" class="chargesPrices">1500</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th colspan="3" scope="row">Amount due:</th>
                                    <th id="invoiceTotalBalanceModal" class="invoiceTotalBalance" style="text-align:right;"></th>
                                </tr>
                                <tr>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th colspan="2" scope="row">Amount paid:</th>
                                    <th style="text-align:right;"  colspan="2">
                                        <input type="number" name="amountPaid" placeholder="0" min="0" style="text-align:right;" class="form-control" id="amount">
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="saveAdditionalPayments" type="button" class="btn btn-success" data-dismiss="modal">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <!-- end of charges modal -->
    <!-- unsaved changes modal -->
    <div class="modal fade" id="unsavedChangesModal" tabindex="-1" role="dialog" aria-labelledby="chargesModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Unsaved changes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p> You have unsaved changes. Are you sure you want to leave this page? </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" style="width:5em;">Yes</button>
                    <button type="button" class="btn btn-primary" style="width:5em;" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- unsaved changes modal -->
    @endforeach  
@endsection