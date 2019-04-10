<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservations;
use App\Accommodation;
use App\AccommodationUnits;
use Illuminate\Support\Arr;
use App\Guests;
use App\Reservation;
use App\ReservationUnits;
use App\Units;
use App\Services;
use App\Charges;
use App\Payments;
use Carbon\Carbon;
use Auth;
use DB;

class ReservationsController extends Controller
{
    /**
     * Display all reservations.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewReservations()
    {
        $reservations = DB::table('reservations')
        ->join('reservation_units', function($join) {
            $join->on('reservation_units.reservationID', '=', 'reservations.id')
                 ->where('status', '=','reserved');
        })
        ->orderBy('reservations.id')
        ->get();
        
        $reservations =  $reservations->unique('reservationID');

        //return $reservations;

        return view('lodging.viewreservations')->with('reservations', $reservations);
    }

    /**
     * Cancel reservation modal
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelReservationModal($reservationID)
    {
        $reservations = DB::table('reservations')
        ->join('reservation_units', function($join) {
            $join->on('reservation_units.reservationID', '=', 'reservations.id')
                 ->where('status', '=','reserved');
        })
        ->join('services', 'services.id', 'reservation_units.serviceID')
        ->where('reservations.id', '=', $reservationID)
        ->get();

        return $reservations;
    }
    
    /**
     * Cancel reservations.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelReservation($reservationID)
    {
        DB::table('reservation_units')
        ->where('reservationID', $reservationID)
        ->update(array('status' => 'canceled'));

        return redirect('/view-reservations');
    }

    /**
     * Display reservationForm.
     *
     * @return \Illuminate\Http\Response
     */
    public function showReservationForm($unitID)
    {        
        $unit = DB::table('units')
        ->where('id', '=', $unitID)
        ->get();
        return view('lodging.reservation')->with('unit', $unit);
    }

    /**
     * Display reservationForm.
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckinForm($unitID, $reservationID)
    {        
        $unit = DB::table('units')
        ->where('id', '=', $unitID)
        ->get();

        $reservation = DB::table('reservations')
        ->where('id', '=', $reservationID)
        ->get();

        //return $reservation;
        
        
        $reservedUnit = DB::table('reservation_units')
        ->join('services', 'services.id', 'reservation_units.serviceID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->where('reservation_units.reservationID', '=', $reservationID)
        ->where('reservation_units.unitID', '=', $unitID)
        ->get();

        //return $reservedUnit;

        $otherReservedUnits = DB::table('reservation_units')
        ->join('services', 'services.id', 'reservation_units.serviceID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->where('reservation_units.reservationID', '=', $reservationID)
        ->where('reservation_units.unitID', '!=', $unitID)
        ->get();

        $allReservedUnits = DB::table('reservation_units')
        ->join('services', 'services.id', 'reservation_units.serviceID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->where('reservation_units.reservationID', '=', $reservationID)
        //->orderByRaw($unitID)
        ->get();

        //return $otherReservedUnits;
        
        $charges = DB::table('charges')
        ->join('reservation_units', 'reservation_units.unitID', 'charges.unitID')
        /*->join('reservation_units', function($join) {
            $join->on('reservation_units.reservationID', '=', 'charges.reservationID')
                 ->where('reservation_units.unitID', '=','charges.unitID');
        })*/
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->select('charges.id AS chargeID', 'charges.quantity', 'charges.totalPrice', 'charges.reservationID',
                 'reservation_units.unitID', 'reservation_units.numberOfPax', 'reservation_units.checkinDatetime',
                 'reservation_units.checkoutDatetime', 'units.unitNumber', 'services.serviceName',
                 'services.price')
        ->where('charges.reservationID', '=', $reservationID)
        ->where('charges.serviceID', '<', '6')
        ->get();

        $additionalCharges = DB::table('charges')
        ->join('services', 'services.id', 'charges.serviceID')
        ->where('charges.reservationID', '=', $reservationID)
        ->where('charges.serviceID', '>', '5')
        ->get();

        $additionalServices = DB::table('charges')
        ->join('services', 'services.id', 'charges.serviceID')
        ->select('charges.id AS chargeID', 'charges.quantity', 'charges.totalPrice',
                 'charges.remarks', 'charges.reservationID', 'charges.unitID',
                 'services.*')
        ->where('charges.reservationID', '=', $reservationID)
        ->where('charges.serviceID', '>', '5')
        ->get();

        //return $additionalServices;

        return view('lodging.checkinGlampingReservation')->with('unit', $unit)->with('reservation', $reservation)->with('reservedUnit', $reservedUnit)->with('otherReservedUnits', $otherReservedUnits)->with('allReservedUnits', $allReservedUnits)->with('charges', $charges)->with('additionalCharges', $additionalCharges)->with('additionalServices', $additionalServices);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeReservation(Request $request)
    {
        $this->validate($request, [
            'contactNumber' => 'required|min:11|max:11',
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30'
        ]);

        $reservation = new Reservations;    
        $unitNumbers = array_map('trim', explode(',', $request->input('unitNumber')));  //for the three for loops
        
        
        $reservation->lastName = $request->input('lastName');
        $reservation->firstName = $request->input('firstName');
        $reservation->numberOfPax = $request->input('numberOfPaxGlamping');
        $reservation->numberOfUnits = $request->input('numberOfUnits');        
        $reservation->contactNumber = $request->input('contactNumber');
        $reservation->save();

        for($count = 0; $count < $request->input('numberOfUnits'); $count++) { //for loop two
            
            $accommodationPackage = 'accommodationPackage'.$unitNumbers[$count];
            $checkinDate = 'checkinDate'.$unitNumbers[$count];
            $checkoutDate = 'checkoutDate'.$unitNumbers[$count];

            $totalPrice = 'totalPrice'.$unitNumbers[$count];

            $unit = DB::table('units')->where('unitNumber', '=', $unitNumbers[$count])->select('units.*')->get();

            $reservationUnit = new ReservationUnits;
            $reservationUnit->reservationID = $reservation->id;
            $reservationUnit->unitID = $unit[0]->id;
            $reservationUnit->status = 'reserved';
            $reservationUnit->checkinDatetime = $request->input($checkinDate).' '.'14:00';
            $reservationUnit->checkoutDatetime = $request->input($checkoutDate).' '.'12:00';
            $reservationUnit->numberOfPax = $request->input($accommodationPackage);
            $reservationUnit->serviceID =  $request->input($accommodationPackage);
            $reservationUnit->save();

            $charges = new Charges;
            $charges->quantity = $request->input($accommodationPackage);
            $charges->totalPrice = $request->input($totalPrice);
            $charges->remarks = 'unpaid';
            $charges->reservationID = $reservation->id;
            $charges->unitID = $reservationUnit->unitID;
            $charges->serviceID = $request->input($accommodationPackage);
            $charges->save();
        }

        
        if($request->input('additionalServicesCount') > 0) {
            for($count = 1; $count <= $request->input('additionalServicesCount'); $count++) {
                $additionalServiceID = 'additionalServiceID'.$count;
                $additionalServiceNumberOfPax = 'additionalServiceNumberOfPax'.$count;
                $additionalTotalPrice = 'additionalServiceTotalPrice'.$count;
                if($request->input($additionalServiceID)) {
                    $charges = new Charges;                    
                    $charges->quantity = $request->input($additionalServiceNumberOfPax);
                    $charges->totalPrice = $request->input($additionalTotalPrice);
                    $charges->remarks = 'unpaid';
                    $charges->reservationID = $reservation->id;
                    $charges->serviceID = $request->input($additionalServiceID);
                    $charges->save();
                }
            }
        }
        return redirect('/glamping');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkinGlamping(Request $request)
    {
        $this->validate($request, [
            'contactNumber' => 'required|min:11|max:11',
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30'
        ]);

        //return ReservationUnits::find($request->input('reservationID'));

        $accommodation = new Accommodation;    
        $unitNumbers = array_map('trim', explode(',', $request->input('unitNumber')));  //for the three for loops

        $accommodation->numberOfPax = $request->input('numberOfPaxGlamping');
        $accommodation->numberOfUnits = $request->input('numberOfUnits');
        $accommodation->userID = Auth::user()->id;
        $accommodation->save();

        $guest = new Guests;
        $guest->lastName = $request->input('lastName');
        $guest->firstName = $request->input('firstName');
        $guest->accommodationID = $accommodation->id;   
        $guest->contactNumber = $request->input('contactNumber');
        $guest->save(); 

        $chargesCount = 0;
        $chargesArray = array();

        for($count = 0; $count < $request->input('numberOfUnits'); $count++) { //for loop two
            
            $accommodationPackage = 'accommodationPackage'.$unitNumbers[$count];
            $checkinDate = 'checkinDate'.$unitNumbers[$count];
            $checkoutDate = 'checkoutDate'.$unitNumbers[$count];
            $chargeID = 'charge'.$unitNumbers[$count];

            $totalPrice = 'totalPrice'.$unitNumbers[$count];

            $unit = DB::table('units')->where('unitNumber', '=', $unitNumbers[$count])->select('units.*')->get();

            $accommodationUnit = new AccommodationUnits;
            $accommodationUnit->accommodationID = $accommodation->id;
            $accommodationUnit->unitID = $unit[0]->id;
            $accommodationUnit->status = 'ongoing';
            $accommodationUnit->checkinDatetime = $request->input($checkinDate).' '.'14:00';
            $accommodationUnit->checkoutDatetime = $request->input($checkoutDate).' '.'12:00';
            $accommodationUnit->numberOfPax = $request->input($accommodationPackage);
            $accommodationUnit->serviceID =  $request->input($accommodationPackage);
            $accommodationUnit->save();

            $units = DB::table('reservation_units')
            ->where('reservation_units.reservationID', '=', $request->input('reservationID'))
            ->update(array('status' => 'checkedin'));

            if($request->input($chargeID)) {
                $charge = Charges::find($request->input($chargeID));
                $charge->update([                    
                    'quantity' => $request->input($accommodationPackage),
                    'totalPrice' => $request->input($totalPrice),
                    'remarks' => 'unpaid',
                    'accommodationID' => $accommodation->id,
                    'serviceID' => $request->input($accommodationPackage)
                ]);                
                $chargesCount++;
                array_push($chargesArray, $request->input($chargeID));
            } else {
                $charges = new Charges;
                $charges->quantity = $request->input($accommodationPackage);
                $charges->totalPrice = $request->input($totalPrice);
                $charges->remarks = 'unpaid';
                $charges->accommodationID = $accommodation->id;
                $charges->serviceID = $request->input($accommodationPackage);
                $charges->save();
                $chargesCount++;
                array_push($chargesArray, $charges->id);
            }
        }

        if($request->input('additionalServicesCount') > 0) {
            for($count = 1; $count <= $request->input('additionalServicesCount'); $count++) {
                $additionalServiceID = 'additionalServiceID'.$count;
                $additionalServiceNumberOfPax = 'additionalServiceNumberOfPax'.$count;
                $additionalTotalPrice = 'additionalServiceTotalPrice'.$count;
                $chargeID = 'charge'.$count;
                if($request->input($additionalServiceID)) {
                    if($request->input($chargeID)) {
                        $charge = Charges::find($request->input($chargeID));
                        $charge->update([                    
                            'quantity' => $request->input($additionalServiceNumberOfPax),
                            'totalPrice' => $request->input($additionalTotalPrice),
                            'remarks' => 'unpaid',
                            'accommodationID' => $accommodation->id,
                            'serviceID' => $request->input($additionalServiceID)
                        ]);                
                        $chargesCount++;
                        array_push($chargesArray, $request->input($chargeID));
                    } else {
                        $charges = new Charges;                    
                        $charges->quantity = $request->input($additionalServiceNumberOfPax);
                        $charges->totalPrice = $request->input($additionalTotalPrice);
                        $charges->remarks = 'unpaid';
                        $charges->accommodationID = $accommodation->id;
                        $charges->serviceID = $request->input($additionalServiceID);
                        $charges->save();
                        $chargesCount++;
                        array_push($chargesArray, $charges->id);
                    }
                }
            }
        }

        for($count = 0; $count < $chargesCount; $count++) {
            $paymentEntry = 'payment'.$count;
            if($request->input($paymentEntry)) {
                $payment = new Payments;
                $payment->paymentDatetime = Carbon::now();
                $payment->amount = $request->input($paymentEntry);
                $payment->paymentStatus = 'full';
                $payment->chargeID = $chargesArray[$count];
                $payment->save();

                $charge = Charges::find($chargesArray[$count]);
                $charge->update([
                    'remarks' => 'full'
                ]);
            }
        }

        return redirect('/glamping');
    }

    public function showReservationBackpackerForm($unitID)
    {
        $unit = DB::table('units')
        ->where('id', '=', $unitID)
        ->get();
        return view('lodging.addreserve')->with('unit', $unit);     
        
    }
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reserveBackpacker(Request $request)
    {
        $this->validate($request, [
            'contactNumber' => 'required|min:11|max:11',
            'checkinDate' => 'required', 'checkoutDate' => 'required',
        'firstName' => 'required|max:30', 'lastName' => 'required|max:30'
    ]);

        
    /*if(count($reservedAccommodations)>0){
        for($count=0;$count<count($reservedAccommodations);$count+1){
            if($request->input('checkinDate')<=$reservedAccommodations[$count]){
            //return redirect()->back()->withInput();    
            return("Nakapasok");
            }else{
                return("Error pre");
            }
        }
    }*/

        $BeforeAccommodations = DB::table('accommodations')
        ->select('accommodations.checkinDatetime')
        ->whereDate('accommodations.checkinDatetime', '<>', Carbon::now())
        ->get();
        $AfterAccommodations = DB::table('accommodations')
        ->select('accommodations.checkoutDatetime')
        ->whereDate('accommodations.checkinDatetime', '<>', Carbon::now())            
        ->get();

        /*if($request->input('checkinDate') >= $BeforeAccommodations && $request->input('checkinDate') <= $AfterAccommodations)
        {
            return("Hello");
        }else{
            return $BeforeAccommodations;

        if ($request->input('checkinDate') > $request->input('checkoutDate')){
            return redirect()->back()->withInput();
            
        }
*/
        
        //GAC
        $accommodation = new Accommodation;                 
        $accommodation->numberOfPax = $request->input('numberOfPax');
        $accommodation->checkinDatetime = $request->input('checkinDate').' '.$request->input('checkinTime');
        $accommodation->checkoutDatetime = $request->input('checkoutDate').' '.$request->input('checkoutTime'); 
        $accommodation->serviceID = 5;
        $accommodation->userID = Auth::user()->id;
        //$accommodation->unitID = $request->input('unitID');
        //$accommodation->paymentStatus = $request->input('paymentStatus');
        $accommodation->save();

        $guest = new Guests;
        $guest->lastName = $request->input('lastName');
        $guest->firstName = $request->input('firstName');
        $guest->accommodationID = $accommodation->id;   
        $guest->contactNumber = $request->input('contactNumber');
        $guest->save();

        if ($accommodation->numberOfPax > 1) {
            for ($count = 1; $count < $accommodation->numberOfPax; $count++) {
                $accompanyingGuest = new Guests;

                $lastName = 'lastName'.$count;
                $firstName = 'firstName'.$count;

                $accompanyingGuest->lastName = $request->input($lastName);
                $accompanyingGuest->firstName = $request->input($firstName);
                $accompanyingGuest->accommodationID = $accommodation->id;
                $accompanyingGuest->listedUnder = $guest->id;   
                $accompanyingGuest->save();
            }
        }

        $service = Services::find(5);
        
        $charge = new Charges;
        $charge->quantity = $request->input('numberOfPax');
        $charge->totalPrice = $charge->quantity*$service->price;
        $charge->remarks = $request->input('paymentStatus');
        $charge->accommodationID = $accommodation->id;
        $charge->serviceID = $service->id;
        $charge->save();

        if($request->input('paymentStatus') != 'unpaid') {
            $payment = new Payments;
            $payment->paymentDatetime = Carbon::now();
            $payment->amount = $request->input('amountPaid');
            $payment->paymentStatus = $request->input('paymentStatus');
            $payment->chargeID = $charge->id;
            $payment->save();
        }

        $accommodationUnit = new AccommodationUnits;
        $accommodationUnit->accommodationID = $accommodation->id;
        $accommodationUnit->unitID = $request->input('unitID');
        $accommodationUnit->status = 'ongoing';
        $accommodationUnit->save();

        return redirect('/transient-backpacker');

    }
}


