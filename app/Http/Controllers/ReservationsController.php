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
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->where('units.unitType', '=', 'room')
        ->orWhere('units.unitType', '=', 'tent')
        ->orderBy('reservations.id')
        ->get();
        
        //$reservations =  $reservations->unique('reservationID');

        //return $reservations;

        return view('lodging.viewreservations')->with('reservations', $reservations);
    }

    /**
     * Cancel reservation modal
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelReservationModal($reservationID, $unitID)
    {
        $reservations = DB::table('reservations')
        ->join('reservation_units', function($join) {
            $join->on('reservation_units.reservationID', '=', 'reservations.id')
                 ->where('status', '=','reserved');
        })
        ->join('services', 'services.id', 'reservation_units.serviceID')
        ->where('reservations.id', '=', $reservationID)
        ->where('unitID', '=', $unitID)

        ->get();

        return $reservations;
    }
    
    /**
     * Cancel reservations.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelReservation($reservationID, $unitID)
    {
        DB::table('reservation_units')
        ->where('reservationID', '=', $reservationID)
        ->where('unitID', '=', $unitID)
        ->update(array('status' => 'canceled'));

        return redirect('/view-reservations');
    }

    /**
     * Cancel all reservations made by this guest modal
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelGuestReservationModal($reservationID)
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
     * Cancel all reservations made by this guest
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelGuestReservation($reservationID)
    {
        DB::table('reservation_units')
        ->where('reservationID', '=', $reservationID)
        ->update(array('status' => 'canceled'));

        return redirect('/view-reservations');
    }

    /**
     * Display reservationForm.
     *
     * @return \Illuminate\Http\Response
     */
    public function showGlampingReservationForm($unitID)
    {        
        $unit = DB::table('units')
        ->where('id', '=', $unitID)
        ->get();

        $unitSource = DB::table('units')
        ->select('units.unitNumber')
        ->where('units.unitType', '=', 'tent')
        ->orderBy('id', 'ASC')
        ->get();

        return view('lodging.reservationGlamping')->with('unit', $unit)->with('unitSource', $unitSource);
    }

    /**
     * Show the reservation form
     *
     * @return \Illuminate\Http\Response
     */
    public function showGlampingReserveFromFinder(Request $request)
    {
        $unitsSelected =  explode(',', $request->input('checkedUnits'));

        $units = array();
        $unitNumber = array();

        for($count = 0; $count < count($unitsSelected); $count++) {
            $unit = DB::table('units')
            ->where('id', '=',$unitsSelected[$count])
            ->get();

            array_push($units, $unit[0]);
            array_push($unitNumber, $unit[0]->unitNumber);
        }

        //return $units;
        $charges = $units;

        $givenCheckinDate =  $request->input('checkin');
        $givenCheckoutDate = $request->input('checkout');

        $unitSource = DB::table('units')
        ->select('units.unitNumber')
        ->where('units.unitType', '=', 'tent')
        ->orderBy('id', 'ASC')
        ->get();

        return view('lodging.reservationGlamping')->with('unitNumber', $unitNumber)->with('units', $units)->with('charges', $charges)->with('givenCheckinDate', $givenCheckinDate)->with('givenCheckoutDate', $givenCheckoutDate)->with('unitSource', $unitSource);
    }

    /**
     * Show the reservation form
     *
     * @return \Illuminate\Http\Response
     */
    public function showReserveFromCalendar($unitID, $reservationDate)
    {
        $unitsSelected =  explode(',', $unitID);

        $units = array();
        $unitNumber = array();

        for($count = 0; $count < count($unitsSelected); $count++) {
            $unit = DB::table('units')
            ->where('id', '=',$unitsSelected[$count])
            ->get();

            array_push($units, $unit[0]);
            array_push($unitNumber, $unit[0]->unitNumber);
        }

        //return $units;
        $charges = $units;

        $givenCheckinDate = $reservationDate;
        $givenCheckoutDate = Carbon::parse($reservationDate)->addDays(1)->format('Y-m-d');

        $unitSource = DB::table('units')
        ->select('units.unitNumber')
        ->where('units.unitType', '=', 'tent')
        ->orderBy('id', 'ASC')
        ->get();

        return view('lodging.reservationGlamping')->with('unitNumber', $unitNumber)->with('units', $units)->with('charges', $charges)->with('givenCheckinDate', $givenCheckinDate)->with('givenCheckoutDate', $givenCheckoutDate)->with('unitSource', $unitSource);
    }

    /**
     * Display reservationForm.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewReservationDetails($unitID, $reservationID)
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
        ->where('reservation_units.checkinDatetime', '=', $reservedUnit[0]->checkinDatetime)
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
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->select('charges.id AS chargeID', 'charges.quantity', 'charges.totalPrice', 'charges.reservationID',
                 'reservation_units.unitID', 'reservation_units.numberOfPax', 'reservation_units.checkinDatetime',
                 'reservation_units.checkoutDatetime', 'units.unitNumber', 'services.serviceName',
                 'services.price')
        ->where('charges.reservationID', '=', $reservationID)
        ->where('charges.serviceID', '<', '6')
        ->get();

        //return $charges;

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

        $unitSource = DB::table('units')
        ->select('units.unitNumber')
        ->where('units.unitType', '=', 'tent')
        ->orderBy('id', 'ASC')
        ->get();

        //return $additionalServices;

        return view('lodging.viewGlampingReservation')->with('unit', $unit)->with('reservation', $reservation)->with('reservedUnit', $reservedUnit)->with('otherReservedUnits', $otherReservedUnits)->with('allReservedUnits', $allReservedUnits)->with('charges', $charges)->with('additionalCharges', $additionalCharges)->with('additionalServices', $additionalServices)->with('unitSource', $unitSource);
    }

    public function saveGlampingReservation(Request $request)
    {
        $fuck = DB::tabls('fuc');
        $this->validate($request, [
            'contactNumber' => 'required|min:11|max:11',
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30'
        ]);

        $unitNumbers = array_map('trim', explode(',', $request->input('unitNumber')));  //for the three for loops
        
        $reservation = Reservations::find($request->input('reservationID'));
        $reservation->update([
            'lastName' => $request->input('lastName'),
            'firstName' => $request->input('firstName'),
            'numberOfPax' => $request->input('numberOfPaxGlamping'),
            'numberOfUnits' => $request->input('numberOfUnits'),    
            'contactNumber' => $request->input('contactNumber'),
        ]);

        for($count = 0; $count < $request->input('numberOfUnits'); $count++) { //for loop two            
            $accommodationPackage = 'accommodationPackage'.$unitNumbers[$count];
            $checkinDate = 'checkinDate'.$unitNumbers[$count];
            $checkoutDate = 'checkoutDate'.$unitNumbers[$count];
            
            $unit = DB::table('units')->where('unitNumber', '=', $unitNumbers[$count])->select('units.*')->get();

            $units = DB::table('reservation_units')
            ->where('reservation_units.reservationID', '=', $request->input('reservationID'))
            ->update(array(
                //'unitID' => $unit[0]->id,
                'checkinDatetime' => $request->input($checkinDate).' '.'14:00',
                'checkoutDatetime' => $request->input($checkoutDate).' '.'12:00',
                'numberOfPax' => $request->input($accommodationPackage),
                'serviceID' => $request->input($accommodationPackage)
            ));
        }

        return redirect('/glamping');
    }

    /**
     * Display checkin form from reservation.
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
        ->where('reservation_units.checkinDatetime', '=', $reservedUnit[0]->checkinDatetime)
        ->get();

        $allReservedUnits = DB::table('reservation_units')
        ->join('services', 'services.id', 'reservation_units.serviceID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->where('reservation_units.reservationID', '=', $reservationID)        
        ->where('reservation_units.checkinDatetime', '=', $reservedUnit[0]->checkinDatetime)
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
        ->where(function($query) use ($reservationID) {
            $query->where('charges.remarks', '=', 'unpaid')
                  ->orWhere('charges.remarks', '=', 'partial');
        })
        ->groupBy('chargeID')
        ->get();

        //return $charges;

        $additionalCharges = DB::table('charges')
        ->join('services', 'services.id', 'charges.serviceID')
        ->where('charges.reservationID', '=', $reservationID)
        ->where('charges.serviceID', '>', '5')
        ->where(function($query) use ($reservationID) {
            $query->where('charges.remarks', '=', 'unpaid')
                  ->orWhere('charges.remarks', '=', 'partial');
        })
        ->get();

        $additionalServices = DB::table('charges')
        ->join('services', 'services.id', 'charges.serviceID')
        ->select('charges.id AS chargeID', 'charges.quantity', 'charges.totalPrice',
                 'charges.remarks', 'charges.reservationID', 'charges.unitID',
                 'services.*')
        ->where('charges.reservationID', '=', $reservationID)
        ->where('charges.serviceID', '>', '5')
        ->get();

        $unitSource = DB::table('units')
        ->select('units.unitNumber')
        ->where('units.unitType', '=', 'tent')
        ->orderBy('id', 'ASC')
        ->get();

        //return $additionalServices;

        return view('lodging.checkinGlampingReservation')->with('unit', $unit)->with('reservation', $reservation)->with('reservedUnit', $reservedUnit)->with('otherReservedUnits', $otherReservedUnits)->with('allReservedUnits', $allReservedUnits)->with('charges', $charges)->with('additionalCharges', $additionalCharges)->with('additionalServices', $additionalServices)->with('unitSource', $unitSource);
    }

    /**
     * Display checkin form from reservation.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBackpackerCheckinForm($unitID, $reservationID)
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
        ->where('units.unitType', '=', 'room')
        ->get();

        //return $reservedUnit;

        /*$groups = DB::table('reservation_units')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->select('reservation_units.reservationID', 'reservation_units.numberOfBunks', 'reservation_units.status', 'reservation_units.checkinDatetime', 
                 'reservation_units.checkoutDatetime', 'reservation_units.groupID', 'units.partOf')
        ->groupBy('reservation_units.groupID')
        ->where('reservation_units.reservationID', '=', $reservationID)
        ->where('units.partOf', '=', $unitID)
        ->where('units.unitType', '=', 'bed')
        ->get();*/

        //return $groups;

        //return $reservedBeds;

        $otherReservedUnits = DB::table('reservation_units')
        ->join('services', 'services.id', 'reservation_units.serviceID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->where('reservation_units.reservationID', '=', $reservationID)
        ->where('reservation_units.unitID', '!=', $unitID)        
        //->where('reservation_units.checkinDatetime', '=', $reservedUnit[0]->checkinDatetime)
        ->where('units.unitType', '=', 'room')
        ->get();

        //return $otherReservedUnits;

        /*$groupArray = array();

        foreach($otherReservedUnits as $otherReservedUnit) {
            $otherGroup = DB::table('reservation_units')
            ->join('units', 'units.id', 'reservation_units.unitID')
            ->select('reservation_units.reservationID', 'reservation_units.numberOfBunks', 'reservation_units.status', 'reservation_units.checkinDatetime', 
                    'reservation_units.checkoutDatetime', 'reservation_units.groupID', 'units.partOf')
            ->groupBy('reservation_units.groupID')
            ->where('reservation_units.reservationID', '=', $reservationID)
            ->where('units.partOf', '=', $otherReservedUnit->unitID)
            ->where('units.unitType', '=', 'bed')
            ->get()
            ->toArray();

            //return $groups;

            $groupArray = array_merge($groupArray, $otherGroup);
        }*/

        //return $groupArray;

        //return $otherReservedUnits;

        $allReservedUnits = DB::table('reservation_units')
        ->join('services', 'services.id', 'reservation_units.serviceID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->where('reservation_units.reservationID', '=', $reservationID)        
        //->where('reservation_units.checkinDatetime', '=', $reservedUnit[0]->checkinDatetime)
        ->where('units.unitType', '=', 'room')
        //->orderByRaw($unitID)
        ->get();

        //return $allReservedUnits;
        
        $charges = DB::table('charges')
        ->join('services', 'services.id', 'charges.serviceID')
        //->join('units', 'units.id', 'charges.unitID')
        ->select('charges.id AS chargeID', 'charges.quantity', 'charges.totalPrice', 'charges.remarks',
                 'charges.reservationID', 'services.serviceName', 'services.price')
        ->where('charges.reservationID', '=', $reservationID)
        ->where('charges.serviceID', '=', '5')
        ->where(function($query) use ($reservationID) {
            $query->where('charges.remarks', '=', 'unpaid')
                  ->orWhere('charges.remarks', '=', 'partial');
        })
        ->get();

        $backpackerQuantity = $charges[0]->quantity;
        //return $charges;

        $additionalCharges = DB::table('charges')
        ->join('services', 'services.id', 'charges.serviceID')
        ->where('charges.reservationID', '=', $reservationID)
        ->where('charges.serviceID', '>', '6')
        ->where(function($query) use ($reservationID) {
            $query->where('charges.remarks', '=', 'unpaid')
                  ->orWhere('charges.remarks', '=', 'partial');
        })
        ->get();

        //return $additionalCharges;

        $additionalServices = DB::table('charges')
        ->join('services', 'services.id', 'charges.serviceID')
        ->select('charges.id AS chargeID', 'charges.quantity', 'charges.totalPrice',
                 'charges.remarks', 'charges.reservationID', 'charges.unitID',
                 'services.*')
        ->where('charges.reservationID', '=', $reservationID)
        ->where('charges.serviceID', '>', '6')
        ->get();

        //return $additionalServices;

        $unitSource = DB::table('units')
        ->select('units.unitNumber')
        ->where('units.unitType', '=', 'room')
        ->orderBy('id', 'ASC')
        ->get();

        $beds = DB::table('units')
        ->where('units.unitType', '=', 'bed')
        ->where('partOf', '=', $unitID)
        ->orderBy('id', 'ASC')
        ->get();

        //return $additionalServices;

        return view('lodging.checkinBackpackerReservation')
        ->with('unit', $unit)->with('reservation', $reservation)
        ->with('reservedUnit', $reservedUnit)
        //->with('groups', $groups)
        //->with('otherGroups', $groupArray)
        ->with('otherReservedUnits', $otherReservedUnits)
        ->with('allReservedUnits', $allReservedUnits)
        ->with('charges', $charges)
        ->with('backpackerQuantity', $backpackerQuantity)
        ->with('additionalCharges', $additionalCharges)
        ->with('additionalServices', $additionalServices)->with('unitSource', $unitSource)
        ->with('beds', $beds);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reserveGlamping(Request $request)
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
            $charges->balance = $request->input($totalPrice);
            $charges->remarks = 'unpaid';
            $charges->unitID = $reservationUnit->unitID;
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
                    $charges->balance = $request->input($additionalTotalPrice);
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
    /*
    public function reserveBackpacker(Request $request)
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
        $reservation->numberOfPax = $request->input('numberOfPaxBackpacker');
        $reservation->numberOfUnits = $request->input('numberOfUnits');        
        $reservation->contactNumber = $request->input('contactNumber');
        $reservation->save();

        $totalNumberOfBunks= 0;

        for($count = 0; $count < $request->input('numberOfUnits'); $count++) { //for loop two
            
            $numberOfGroups = 'numberOfGroupsIn'.$unitNumbers[$count];

            $unit = DB::table('units')->where('unitNumber', '=', $unitNumbers[$count])->select('units.*')->get();

            $beds = DB::table('units')
            ->leftJoin('reservation_units', 'reservation_units.unitID', 'units.id')
            ->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.id')
            ->where('partOf', '=', $unit[0]->id)           
            ->where('reservation_units.status', '=', null)
            ->where('accommodation_units.status', '=', null)  
            ->orWhere('reservation_units.status', '!=', 'reserved')
            ->orWhere('accommodation_units.status', '!=', 'ongoing')
            ->where('units.unitType', '=', 'bed')
            ->orderBy('id', 'ASC')
            ->get();

            //return $beds;

            $checkinDates = array();
            $checkoutDates = array();

            $bedCounter = 0;

            for($index = 1; $index <= $request->input($numberOfGroups); $index++) {
                $numberOfBeds = 'numberOfBeds'.$unitNumbers[$count];
                $checkinDate = 'checkinDate'.$unitNumbers[$count];
                $checkoutDate = 'checkoutDate'.$unitNumbers[$count];

                for($counter = 0; $counter < $request->input($numberOfBeds); $counter++) {
                    $reservationUnit = new ReservationUnits;
                    $reservationUnit->reservationID = $reservation->id;
                    $reservationUnit->unitID = $beds[$bedCounter]->id;
                    $reservationUnit->status = 'reserved';
                    $reservationUnit->checkinDatetime = $request->input($checkinDate).' '.'14:00';
                    $reservationUnit->checkoutDatetime = $request->input($checkoutDate).' '.'12:00';
                    $reservationUnit->numberOfPax = 1;
                    $reservationUnit->numberOfBunks = $request->input($numberOfBeds);
                    $reservationUnit->groupID = $index;
                    $reservationUnit->serviceID =  '5';
                    $reservationUnit->save();
                    $bedCounter++;
                }
                
                $totalNumberOfBunks += $request->input($numberOfBeds);

                array_push($checkinDates, $request->input($checkinDate));
                array_push($checkoutDates, $request->input($checkoutDate));
            }

            $reservationUnit = new ReservationUnits;
            $reservationUnit->reservationID = $reservation->id;
            $reservationUnit->unitID = $unit[0]->id;
            $reservationUnit->status = 'reserved';

            //return $checkinDates[0];

            
            $earliestCheckinDate = '3000-12-25';
            $latestCheckoutDate = '2000-1-1';

            for($dateIndex = 0; $dateIndex < $request->input($numberOfGroups); $dateIndex++) {
                if ($checkinDates[$dateIndex] <= $earliestCheckinDate) {
                    $earliestCheckinDate = $checkinDates[$dateIndex];
                }

                if ($checkoutDates[$dateIndex] >= $latestCheckoutDate) {
                    $latestCheckoutDate = $checkoutDates[$dateIndex];
                }
            }

            $reservationUnit->checkinDatetime = $earliestCheckinDate.' '.'14:00';
            $reservationUnit->checkoutDatetime = $latestCheckoutDate.' '.'12:00';
            $reservationUnit->numberOfGroups = $request->input($numberOfGroups);
            $reservationUnit->numberOfPax = $bedCounter;
            $reservationUnit->numberOfBunks = $bedCounter;
            $reservationUnit->serviceID =  '5';
            $reservationUnit->save();
        }       

        $charges = new Charges;
        $charges->quantity = $request->input('backpackerQuantity');
        $charges->totalPrice = $request->input('totalPrice');
        $charges->balance = $request->input('totalPrice');
        $charges->remarks = 'unpaid';
        $charges->reservationID = $reservation->id;
        //$charges->unitID = $reservationUnit->unitID;
        $charges->serviceID = '5';
        $charges->save();

        if($request->input('additionalServicesCount') > 0) {
            for($count = 1; $count <= $request->input('additionalServicesCount'); $count++) {
                $additionalServiceID = 'additionalServiceID'.$count;
                $additionalServiceNumberOfPax = 'additionalServiceNumberOfPax'.$count;
                $additionalTotalPrice = 'additionalServiceTotalPrice'.$count;
                if($request->input($additionalServiceID)) {
                    $charges = new Charges;                    
                    $charges->quantity = $request->input($additionalServiceNumberOfPax);
                    $charges->totalPrice = $request->input($additionalTotalPrice);
                    $charges->balance = $request->input($additionalTotalPrice);
                    $charges->remarks = 'unpaid';
                    $charges->reservationID = $reservation->id;
                    $charges->serviceID = $request->input($additionalServiceID);
                    $charges->save();
                }
            }
        }
        
        return redirect('/backpacker');
    }  OLD METHOD*/ 

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
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30'
        ]);

        $reservation = new Reservations;    
        $unitNumbers = array_map('trim', explode(',', $request->input('unitNumber')));  //for the three for loops

        $reservation->lastName = $request->input('lastName');
        $reservation->firstName = $request->input('firstName');
        $reservation->numberOfPax = $request->input('numberOfPaxBackpacker');
        $reservation->numberOfUnits = $request->input('numberOfUnits');        
        $reservation->contactNumber = $request->input('contactNumber');
        $reservation->save();

        $totalNumberOfBunks= 0;

        for($count = 0; $count < $request->input('numberOfUnits'); $count++) { 

            $unit = DB::table('units')->where('unitNumber', '=', $unitNumbers[$count])->select('units.*')->get();

            $numberOfBeds = 'numberOfBeds'.$unitNumbers[$count];
            $checkinDate = 'checkinDate'.$unitNumbers[$count];
            $checkoutDate = 'checkoutDate'.$unitNumbers[$count];

            $beds = DB::table('units')
            ->leftJoin('reservation_units', 'reservation_units.unitID', 'units.id')
            ->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.id')                    
            ->where('partOf', '=', $unit[0]->id)    
            ->where('reservation_units.status', '=', null)
            ->where('accommodation_units.status', '=', null)  
            ->orWhere(function($query) use ($request, $checkinDate, $unit) {
                $query->where('accommodation_units.checkoutDatetime', '<=', $request->input($checkinDate).' 12:00:00')
                      ->where('accommodation_units.status', '!=', 'ongoing')
                      ->where('partOf', '=', $unit[0]->id);
            })
            ->orWhere(function($query) use ($request, $unit, $checkoutDate) {
                $query->where('accommodation_units.checkinDatetime', '>=', $request->input($checkoutDate).' 14:00:00')
                      ->where('accommodation_units.status', '!=', 'ongoing')
                      ->where('partOf', '=', $unit[0]->id);
            })        
            ->orWhere(function($query) use ($request, $checkinDate, $unit) {
                $query->where('reservation_units.checkoutDatetime', '<=', $request->input($checkinDate).' 12:00:00')
                    ->where('partOf', '=', $unit[0]->id)
                    ->orWhere(function($queryB) {
                        $queryB->where('reservation_units.status', '=', 'canceled');
                    });
            })
            ->orWhere(function($query) use ($request, $unit, $checkoutDate) {
                $query->where('reservation_units.checkinDatetime', '>=', $request->input($checkoutDate).' 14:00:00')
                    ->where('partOf', '=', $unit[0]->id)
                    ->orWhere(function($queryB) {
                        $queryB->where('reservation_units.status', '=', 'canceled');
                    });
            })
            ->where('units.unitType', '=', 'bed')           
            ->orderBy('id', 'ASC')
            ->get();

            //return $beds;

            $bedCounter = 0;

            for($counter = 0; $counter < $request->input($numberOfBeds); $counter++) {
                //FOR BEDS
                $reservationUnit = new ReservationUnits;
                $reservationUnit->reservationID = $reservation->id;
                $reservationUnit->unitID = $beds[$bedCounter]->id;
                $reservationUnit->status = 'reserved';
                $reservationUnit->checkinDatetime = $request->input($checkinDate).' '.'14:00';
                $reservationUnit->checkoutDatetime = $request->input($checkoutDate).' '.'12:00';
                $reservationUnit->numberOfPax = 1;
                $reservationUnit->numberOfBunks = $request->input($numberOfBeds);
                $reservationUnit->serviceID =  '5';
                $reservationUnit->save();
                $bedCounter++;
            }

            //FOR ROOMS
            $reservationUnit = new ReservationUnits;
            $reservationUnit->reservationID = $reservation->id;
            $reservationUnit->unitID = $unit[0]->id;
            $reservationUnit->status = 'reserved';
            $reservationUnit->checkinDatetime = $request->input($checkinDate).' '.'14:00';
            $reservationUnit->checkoutDatetime = $request->input($checkoutDate).' '.'12:00';
            $reservationUnit->numberOfPax = $bedCounter;
            $reservationUnit->numberOfBunks = $bedCounter;
            $reservationUnit->serviceID =  '5';
            $reservationUnit->save();
        }       

        $charges = new Charges;
        $charges->quantity = $request->input('backpackerQuantity');
        $charges->totalPrice = $request->input('totalPrice');
        $charges->balance = $request->input('totalPrice');
        $charges->remarks = 'unpaid';
        $charges->reservationID = $reservation->id;
        $charges->unitID = $reservationUnit->unitID;
        $charges->serviceID = '5';
        $charges->save();

        if($request->input('additionalServicesCount') > 0) {
            for($count = 1; $count <= $request->input('additionalServicesCount'); $count++) {
                $additionalServiceID = 'additionalServiceID'.$count;
                $additionalServiceNumberOfPax = 'additionalServiceNumberOfPax'.$count;
                $additionalTotalPrice = 'additionalServiceTotalPrice'.$count;
                if($request->input($additionalServiceID)) {
                    $charges = new Charges;                    
                    $charges->quantity = $request->input($additionalServiceNumberOfPax);
                    $charges->totalPrice = $request->input($additionalTotalPrice);
                    $charges->balance = $request->input($additionalTotalPrice);
                    $charges->remarks = 'unpaid';
                    $charges->reservationID = $reservation->id;
                    $charges->serviceID = $request->input($additionalServiceID);
                    $charges->save();
                }
            }
        }
        
        return redirect('/backpacker');
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

        $existingGuest = DB::table('reservation_units')
        ->where('reservation_units.reservationID', '=', $request->input('reservationID'))
        ->where('reservation_units.status', '=', 'checkedin')
        ->get();

        $unitNumbers = array_map('trim', explode(',', $request->input('unitNumber')));  //for the three for loops

        //return sizeof($unitNumbers);
        //return $existingGuest;

        if(count($existingGuest) > 0) {
            $chargesCount = 0;
            $chargesArray = array();

            $checkedinUnit = DB::table('reservation_units')
            ->select('reservation_units.unitID')
            ->where('reservation_units.reservationID', '=', $request->input('reservationID'))
            ->where('reservation_units.status', '=', 'checkedin')
            ->get();

            //return $checkedinUnit[0]->unitID;

            $accommodationID = DB::table('accommodation_units')
            ->select('accommodation_units.unitID', 'accommodation_units.accommodationID')
            ->where('accommodation_units.unitID', '=', $checkedinUnit[0]->unitID)
            ->where('status', '=', 'ongoing')
            ->get();

            //return $accommodationID[0]->unitID;

            for($count = 0; $count < sizeof($unitNumbers); $count++) { //for loop two
                
                $accommodationPackage = 'accommodationPackage'.$unitNumbers[$count];
                $checkinDate = 'checkinDate'.$unitNumbers[$count];
                $checkoutDate = 'checkoutDate'.$unitNumbers[$count];
                $chargeID = 'charge'.$unitNumbers[$count];

                $totalPrice = 'totalPrice'.$unitNumbers[$count];

                $unit = DB::table('units')->where('unitNumber', '=', $unitNumbers[$count])->select('units.*')->get();

                $accommodationUnit = new AccommodationUnits;
                $accommodationUnit->accommodationID = $accommodationID[0]->unitID;
                $accommodationUnit->unitID = $unit[0]->id;
                $accommodationUnit->status = 'ongoing';
                $accommodationUnit->checkinDatetime = $request->input($checkinDate).' '.'14:00';
                $accommodationUnit->checkoutDatetime = $request->input($checkoutDate).' '.'12:00';
                $accommodationUnit->numberOfPax = $request->input($accommodationPackage);
                $accommodationUnit->serviceID =  $request->input($accommodationPackage);
                $accommodationUnit->save();

                $units = DB::table('reservation_units')
                ->where('reservation_units.reservationID', '=', $request->input('reservationID'))
                ->where('reservation_units.unitID', '=', $unit[0]->id)
                ->update(array('status' => 'checkedin'));

                if($request->input($chargeID)) {
                    $charge = Charges::find($request->input($chargeID));
                    $charge->update([                    
                        'quantity' => $request->input($accommodationPackage),
                        'totalPrice' => $request->input($totalPrice),
                        'balance' => $request->input($totalPrice),
                        'remarks' => 'unpaid',
                        'accommodationID' => $accommodationID[0]->accommodationID,
                        'serviceID' => $request->input($accommodationPackage)
                    ]);                
                    $chargesCount++;
                    array_push($chargesArray, $request->input($chargeID));
                } else {
                    $charges = new Charges;
                    $charges->quantity = $request->input($accommodationPackage);
                    $charges->totalPrice = $request->input($totalPrice);
                    $charges->balance = $request->input($totalPrice);
                    $charges->remarks = 'unpaid';
                    $charges->accommodationID = $accommodationID[0]->accommodationID;
                    $charges->unitID = $accommodationUnit->unitID;
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
                                'balance' => $request->input($additionalTotalPrice),
                                'remarks' => 'unpaid',
                                'accommodationID' => $accommodationID[0]->unitID,
                                'serviceID' => $request->input($additionalServiceID)
                            ]);                
                            $chargesCount++;
                            array_push($chargesArray, $request->input($chargeID));
                        } else {
                            $charges = new Charges;                    
                            $charges->quantity = $request->input($additionalServiceNumberOfPax);
                            $charges->totalPrice = $request->input($additionalTotalPrice);
                            $charges->balance = $request->input($additionalTotalPrice);
                            $charges->remarks = 'unpaid';
                            $charges->accommodationID = $accommodationID[0]->unitID;
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
        } else {
            $accommodation = new Accommodation;   
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

            for($count = 0; $count < sizeof($unitNumbers); $count++) { //for loop two
                
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
                ->where('reservation_units.unitID', '=', $unit[0]->id)
                ->update(array('status' => 'checkedin'));

                if($request->input($chargeID)) {
                    $charge = Charges::find($request->input($chargeID));
                    $charge->update([                    
                        'quantity' => $request->input($accommodationPackage),
                        'totalPrice' => $request->input($totalPrice),
                        'balance' => $request->input($totalPrice),
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
                    $charges->balance = $request->input($totalPrice);
                    $charges->remarks = 'unpaid';
                    $charges->accommodationID = $accommodation->id;
                    $charges->unitID = $accommodationUnit->unitID;
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
                                'balance' => $request->input($additionalTotalPrice),
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
                            $charges->balance = $request->input($additionalTotalPrice);
                            $charges->remarks = 'unpaid';
                            $charges->accommodationID = $accommodation->id;
                            $charges->unitID = $accommodationUnit->id;
                            $charges->serviceID = $request->input($additionalServiceID);
                            $charges->save();
                            $chargesCount++;
                            array_push($chargesArray, $charges->id);
                        }
                    }
                }
            }

            $amountPaid = $request->input('amountPaid');

            if($request->input('amountPaid') == '') {
                $amountPaid = 0;
            }

            for($count = 0; $count < $chargesCount; $count++) {
                $paymentEntry = 'payment'.$count;
                if($request->input($paymentEntry)) {
                    $payment = new Payments;
                    $payment->paymentDatetime = Carbon::now();
                    
                    $chargePrice = $request->input($paymentEntry);

                    if(!($amountPaid == 0)) {
                        if(($amountPaid - $chargePrice) >= 0) {
                            $amountPaid -= $chargePrice;
                            $payment->amount = $chargePrice;
                            $payment->paymentStatus = 'full';
                            $payment->chargeID = $chargesArray[$count];
                            $payment->save();
            
                            $charge = Charges::find($chargesArray[$count]);
                            $charge->update([
                                'remarks' => 'full',
                                'balance' => '0'
                            ]);
                            
                        } else if(($amountPaid - $chargePrice) < 0) {
                            $payment->amount = $amountPaid;
                            $payment->paymentStatus = 'partial';
                            $payment->chargeID = $chargesArray[$count];
                            $payment->save();

                            $balance = $chargePrice - $amountPaid;
            
                            $charge = Charges::find($chargesArray[$count]);
                            $charge->update([
                                'remarks' => 'partial',
                                'balance' => $balance
                            ]);    
                            $amountPaid = 0;                    
                        }
                    }
                }
            }
            $deletedCharges = DB::table('charges')
            ->where('reservationID', '=', $request->input('reservationID'))
            ->where('accommodationID', '=', null)
            ->delete();
        }  
        return redirect('/glamping');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkinBackpacker(Request $request)
    {
        $this->validate($request, [
            'contactNumber' => 'required|min:11|max:11',
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30'
        ]);
       // $fuck = DBS::table('gago');
        //return ReservationUnits::find($request->input('reservationID'));

        $existingGuest = DB::table('reservation_units')
        ->where('reservation_units.reservationID', '=', $request->input('reservationID'))
        ->where('reservation_units.status', '=', 'checkedin')
        ->get();

        //return $existingGuest;

        $unitNumbers = array_map('trim', explode(',', $request->input('unitNumber')));  //for the three for loops

        //return sizeof($unitNumbers);
        //return $existingGuest;

        if(count($existingGuest) > 0) {
            $chargesCount = 0;
            $chargesArray = array();

            $checkedinUnit = DB::table('reservation_units')
            ->select('reservation_units.unitID')
            ->where('reservation_units.reservationID', '=', $request->input('reservationID'))
            ->where('reservation_units.status', '=', 'checkedin')
            ->get();

            //return $checkedinUnit[0]->unitID;

            $accommodationID = DB::table('accommodation_units')
            ->select('accommodation_units.unitID', 'accommodation_units.accommodationID')
            ->where('accommodation_units.unitID', '=', $checkedinUnit[0]->unitID)
            ->where('status', '=', 'ongoing')
            ->get();

            //return $accommodationID[0]->unitID;

            for($count = 0; $count < sizeof($unitNumbers); $count++) { //for loop two
                
                $accommodationPackage = 'accommodationPackage'.$unitNumbers[$count];
                $checkinDate = 'checkinDate'.$unitNumbers[$count];
                $checkoutDate = 'checkoutDate'.$unitNumbers[$count];
                $chargeID = 'charge'.$unitNumbers[$count];

                $totalPrice = 'totalPrice'.$unitNumbers[$count];

                $unit = DB::table('units')->where('unitNumber', '=', $unitNumbers[$count])->select('units.*')->get();

                $accommodationUnit = new AccommodationUnits;
                $accommodationUnit->accommodationID = $accommodationID[0]->unitID;
                $accommodationUnit->unitID = $unit[0]->id;
                $accommodationUnit->status = 'ongoing';
                $accommodationUnit->checkinDatetime = $request->input($checkinDate).' '.'14:00';
                $accommodationUnit->checkoutDatetime = $request->input($checkoutDate).' '.'12:00';
                $accommodationUnit->numberOfPax = $request->input($accommodationPackage);
                $accommodationUnit->serviceID =  $request->input($accommodationPackage);
                $accommodationUnit->save();

                $units = DB::table('reservation_units')
                ->where('reservation_units.reservationID', '=', $request->input('reservationID'))
                ->where('reservation_units.unitID', '=', $unit[0]->id)
                ->update(array('status' => 'checkedin'));

                if($request->input($chargeID)) {
                    $charge = Charges::find($request->input($chargeID));
                    $charge->update([                    
                        'quantity' => $request->input($accommodationPackage),
                        'totalPrice' => $request->input($totalPrice),
                        'balance' => $request->input($totalPrice),
                        'remarks' => 'unpaid',
                        'accommodationID' => $accommodationID[0]->accommodationID,
                        'serviceID' => $request->input($accommodationPackage)
                    ]);                
                    $chargesCount++;
                    array_push($chargesArray, $request->input($chargeID));
                } else {
                    $charges = new Charges;
                    $charges->quantity = $request->input($accommodationPackage);
                    $charges->totalPrice = $request->input($totalPrice);
                    $charges->balance = $request->input($totalPrice);
                    $charges->remarks = 'unpaid';
                    $charges->accommodationID = $accommodationID[0]->accommodationID;
                    $charges->unitID = $accommodationUnit->unitID;
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
                                'balance' => $request->input($additionalTotalPrice),
                                'remarks' => 'unpaid',
                                'accommodationID' => $accommodationID[0]->unitID,
                                'serviceID' => $request->input($additionalServiceID)
                            ]);                
                            $chargesCount++;
                            array_push($chargesArray, $request->input($chargeID));
                        } else {
                            $charges = new Charges;                    
                            $charges->quantity = $request->input($additionalServiceNumberOfPax);
                            $charges->totalPrice = $request->input($additionalTotalPrice);
                            $charges->balance = $request->input($additionalTotalPrice);
                            $charges->remarks = 'unpaid';
                            $charges->accommodationID = $accommodationID[0]->unitID;
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
        } else {
            $accommodation = new Accommodation;   
            $accommodation->numberOfPax = $request->input('numberOfPaxBackpacker');
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

            for($count = 0; $count < $request->input('numberOfUnits'); $count++) {

                $unit = DB::table('units')->where('unitNumber', '=', $unitNumbers[$count])->select('units.*')->get();

                /*$beds = DB::table('units')
                ->leftJoin('reservation_units', 'reservation_units.unitID', 'units.id')
                ->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.id')
                ->where('partOf', '=', $unit[0]->id)           
                ->where('accommodation_units.status', '=', null)  
                ->orWhere('accommodation_units.status', '!=', 'ongoing')
                ->where('units.unitType', '=', 'bed')
                ->orderBy('id', 'ASC')
                ->get();*/

                $numberOfBeds = 'numberOfBeds'.$unitNumbers[$count];
                $checkinDate = 'checkinDate'.$unitNumbers[$count];
                $checkoutDate = 'checkoutDate'.$unitNumbers[$count];

                $beds = DB::table('units')
                ->leftJoin('reservation_units', 'reservation_units.unitID', 'units.id')
                ->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.id')                    
                ->where('partOf', '=', $unit[0]->id)    
                ->where('reservation_units.status', '=', null)
                ->where('accommodation_units.status', '=', null)  
                ->orWhere(function($query) use ($request, $checkinDate, $unit) {
                    $query->where('accommodation_units.checkoutDatetime', '<=', $request->input($checkinDate).' 12:00:00')
                        ->where('partOf', '=', $unit[0]->id);
                })
                ->orWhere(function($query) use ($request, $unit, $checkoutDate) {
                    $query->where('accommodation_units.checkinDatetime', '>=', $request->input($checkoutDate).' 14:00:00')
                        ->where('partOf', '=', $unit[0]->id);
                })
                ->orWhere(function($query) use ($request, $checkinDate, $unit) {
                    $query->where('reservation_units.checkoutDatetime', '<=', $request->input($checkinDate).' 12:00:00')
                        ->orWhere('reservationID', $request->input('reservationID'))
                        ->where('partOf', '=', $unit[0]->id)
                        ->orWhere(function($queryB) {
                            $queryB->where('reservation_units.status', '=', 'canceled');
                        });
                })
                ->orWhere(function($query) use ($request, $unit, $checkoutDate) {
                    $query->where('reservation_units.checkinDatetime', '>=', $request->input($checkoutDate).' 14:00:00')
                        ->orWhere('reservationID', $request->input('reservationID'))
                        ->where('partOf', '=', $unit[0]->id)
                        ->orWhere(function($queryB) {
                            $queryB->where('reservation_units.status', '=', 'canceled');
                        });
                })
                ->where('units.unitType', '=', 'bed')           
                ->orderBy('id', 'ASC')
                ->get();

                //return $beds;

                $bedCounter = 0;

                for($counter = 0; $counter < $request->input($numberOfBeds); $counter++) {
                    $accommodationUnit = new AccommodationUnits;
                    $accommodationUnit->accommodationID = $accommodation->id;
                    $accommodationUnit->unitID = $beds[$bedCounter]->id;
                    $accommodationUnit->status = 'ongoing';
                    $accommodationUnit->checkinDatetime = $request->input($checkinDate).' '.'14:00';
                    $accommodationUnit->checkoutDatetime = $request->input($checkoutDate).' '.'12:00';
                    $accommodationUnit->numberOfPax = 1;
                    $accommodationUnit->numberOfBunks =  $request->input($numberOfBeds);;
                    //$accommodationUnit->groupID = $index;
                    $accommodationUnit->serviceID =  '5';
                    $accommodationUnit->save();
                    $bedCounter++;
                    
                    $units = DB::table('reservation_units')
                    ->where('reservation_units.reservationID', '=', $request->input('reservationID'))
                    ->where('reservation_units.unitID', '=', $accommodationUnit->unitID)
                    ->update(array('status' => 'checkedin'));
                }

                $accommodationUnit = new AccommodationUnits;
                $accommodationUnit->accommodationID = $accommodation->id;
                $accommodationUnit->unitID = $unit[0]->id;
                $accommodationUnit->status = 'ongoing';
                $accommodationUnit->checkinDatetime = $request->input($checkinDate).' '.'14:00';
                $accommodationUnit->checkoutDatetime = $request->input($checkoutDate).' '.'12:00';
                //$accommodationUnit->numberOfGroups = $request->input($numberOfGroups);
                $accommodationUnit->numberOfPax = $bedCounter;
                $accommodationUnit->numberOfBunks = $bedCounter;
                $accommodationUnit->serviceID =  '5';
                $accommodationUnit->save();

                
                $units = DB::table('reservation_units')
                ->where('reservation_units.reservationID', '=', $request->input('reservationID'))
                ->where('reservation_units.unitID', '=', $unit[0]->id)
                ->update(array('status' => 'checkedin'));
            }       

            $charge = Charges::find($request->input('chargeBackpacker'));
            $charge->update([                    
                'quantity' => $request->input('backpackerQuantity'),
                'totalPrice' => $request->input('totalPrice'),
                'remarks' => 'unpaid',
                'accommodationID' => $accommodation->id,
                'serviceID' => '5'
            ]);                
            $chargesCount++;
            array_push($chargesArray, $request->input('chargeBackpacker'));

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
                                'balance' => $request->input($additionalTotalPrice),
                                'remarks' => 'unpaid',
                                'serviceID' => $request->input($additionalServiceID)
                            ]);                
                            $chargesCount++;
                            array_push($chargesArray, $request->input($chargeID));
                        } else {
                            $charges = new Charges;                    
                            $charges->quantity = $request->input($additionalServiceNumberOfPax);
                            $charges->totalPrice = $request->input($additionalTotalPrice);
                            $charges->balance = $request->input($additionalTotalPrice);
                            $charges->remarks = 'unpaid';
                            $charges->accommodationID = $accommodation->accommodationID;
                            $charges->serviceID = $request->input($additionalServiceID);
                            $charges->save();
                            $chargesCount++;
                            array_push($chargesArray, $charges->id);
                        }
                    }
                }
            }

            $amountPaid = $request->input('amountPaid');

            if($request->input('amountPaid') == '') {
                $amountPaid = 0;
            }

            for($count = 0; $count < $chargesCount; $count++) {
                $paymentEntry = 'payment'.$count;
                if($request->input($paymentEntry)) {
                    $payment = new Payments;
                    $payment->paymentDatetime = Carbon::now();
                    
                    $chargePrice = $request->input($paymentEntry);

                    if(!($amountPaid == 0)) {
                        if(($amountPaid - $chargePrice) >= 0) {
                            $amountPaid -= $chargePrice;
                            $payment->amount = $chargePrice;
                            $payment->paymentStatus = 'full';
                            $payment->chargeID = $chargesArray[$count];
                            $payment->save();
            
                            $charge = Charges::find($chargesArray[$count]);
                            $charge->update([
                                'remarks' => 'full',
                                'balance' => '0'
                            ]);
                            
                        } else if(($amountPaid - $chargePrice) < 0) {
                            $payment->amount = $amountPaid;
                            $payment->paymentStatus = 'partial';
                            $payment->chargeID = $chargesArray[$count];
                            $payment->save();

                            $balance = $chargePrice - $amountPaid;
            
                            $charge = Charges::find($chargesArray[$count]);
                            $charge->update([
                                'remarks' => 'partial',
                                'balance' => $balance
                            ]);    
                            $amountPaid = 0;                    
                        }
                    }
                }
            }            
            $deletedCharges = DB::table('charges')
            ->where('reservationID', '=', $request->input('reservationID'))
            ->where('accommodationID', '=', null)
            ->delete();
        } 
        return redirect('/backpacker');
    }

    /**
     * Display reservationForm.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBackpackerReservationForm($unitID)
    {        
        $unit = DB::table('units')
        ->where('id', '=', $unitID)
        ->get();

        $unitSource = DB::table('units')
        ->select('units.unitNumber')
        ->where('units.unitType', '=', 'room')
        ->orderBy('id', 'ASC')
        ->get();

        $beds = DB::table('units')
        ->where('units.unitType', '=', 'bed')
        ->where('partOf', '=', $unitID)
        ->orderBy('id', 'ASC')
        ->get();

        return view('lodging.reservationBackpacker')->with('unit', $unit)->with('unitSource', $unitSource)->with('beds', $beds);
    }

    
}


