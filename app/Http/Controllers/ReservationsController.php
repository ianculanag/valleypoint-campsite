<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservations;
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
            ->join('reservation_units', 'reservation_units.reservationID', 'reservations.id')
            ->get();
        
        //return $reservations;

        return view('lodging.viewreservations')->with('reservations', $reservations);
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
        ->where('charges.reservationID', '=', $reservationID)
        ->where('charges.serviceID', '>', '5')
        ->get();

        //return $additionalCharges;

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
}
