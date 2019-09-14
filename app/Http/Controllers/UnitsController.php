<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Units;
use App\Services;
use App\Reservations;
use App\ReservationUnits;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use \PDF;

class UnitsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        //$units = Units::all();
        //$units = Units::orderBy('unitNumber')->paginate(1); 
        //$units = Units::where('unitNumber)
    }

    /**
     * Display all transient and backpacker units
     * 
     * @return \Illuminate\Http\Response
     */
    /*public function transientBackpacker()
    {        
        $rooms = DB::table('units')
        ->where('units.unitType', 'room')
        ->get();

        //return $rooms;

        $roomAccommodations = array();
        $roomGuestNames = array();
        $roomCheckoutDates = array();

        for($index = 0; $index < count($rooms); $index++) {
            $bedAccommodations = DB::table('accommodation_units')
            ->join('guests', 'guests.accommodationID', 'accommodation_units.accommodationID')
            ->join('units', 'units.id', 'accommodation_units.unitID')
            ->where('status', 'ongoing')
            ->where('partOf', $rooms[$index]->id)
            //->groupBy('accommodation_units.accommodationID')
            ->get();

            $bedNameAccommodations = DB::table('accommodation_units')
            ->join('guests', 'guests.accommodationID', 'accommodation_units.accommodationID')
            ->join('units', 'units.id', 'accommodation_units.unitID')
            ->where('status', 'ongoing')
            ->where('partOf', $rooms[$index]->id)
            ->groupBy('accommodation_units.accommodationID')
            ->get();

            $checkoutAccommodations = DB::table('accommodation_units')
            ->join('guests', 'guests.accommodationID', 'accommodation_units.accommodationID')
            ->join('units', 'units.id', 'accommodation_units.unitID')
            ->where('status', 'ongoing')
            ->where('partOf', $rooms[$index]->id)
            ->groupBy('accommodation_units.accommodationID', 'accommodation_units.groupID')
            ->get();
            array_push($roomAccommodations, $bedAccommodations);
            array_push($roomGuestNames, $bedNameAccommodations);
            array_push($roomCheckoutDates, $checkoutAccommodations);
        }

        $roomReservations = array();
        $roomReservationNames = array();
        $roomCheckinDates = array();
        $roomCheckinsToday = array();

        for($index = 0; $index < count($rooms); $index++) {
            $bedReservations = DB::table('reservation_units')
            ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
            ->join('units', 'units.id', 'reservation_units.unitID')
            ->where('status', 'reserved')
            ->where('partOf', $rooms[$index]->id)
            //->groupBy('accommodation_units.accommodationID')
            ->get();

            //return $bedReservations;

            $bedNameReservations = DB::table('reservation_units')
            ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
            ->join('units', 'units.id', 'reservation_units.unitID')
            ->where('status', 'reserved')
            ->where('partOf', $rooms[$index]->id)
            ->groupBy('reservation_units.reservationID')
            ->get();
            

            $checkinReservations = DB::table('reservation_units')
            ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
            ->join('units', 'units.id', 'reservation_units.unitID')
            ->where('status', 'reserved')
            ->where('partOf', $rooms[$index]->id)
            ->groupBy('reservation_units.reservationID', 'reservation_units.groupID')
            ->orderBy('reservation_units.checkinDatetime')
            ->get();

            $checkinsToday = DB::table('reservation_units')
            ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
            ->join('units', 'units.id', 'reservation_units.unitID')
            ->where('status', 'reserved')
            ->where('partOf', $rooms[$index]->id)
            ->where('checkinDatetime', '=', Carbon::now()->format('Y-m-d 14:00'))
            ->groupBy('reservation_units.reservationID')
            
            ->get();
            array_push($roomReservations, $bedReservations);
            array_push($roomReservationNames, $bedNameReservations);
            array_push($roomCheckinDates, $checkinReservations);
            array_push($roomCheckinsToday, $checkinsToday);
        }

        //return $roomReservations;
        //return $roomReservationNames;
        //return $roomCheckinDates;
        //return $roomCheckinsToday;

        $capacities = DB::table('units')
        ->select('units.capacity')
        ->where('units.unitType', '=', 'room')
        ->groupBy('units.capacity')
        ->get();

        $capacityArray = array();

        for($index = 0; $index < count($capacities); $index++) {
            array_push($capacityArray, $capacities[$index]->capacity);
        }
        
        return view('lodging.transient')
        ->with('rooms', $rooms)
        ->with('roomAccommodations', $roomAccommodations)
        ->with('roomGuestNames', $roomGuestNames)
        ->with('roomCheckoutDates', $roomCheckoutDates)
        ->with('roomReservations', $roomReservations)
        ->with('roomReservationNames', $roomReservationNames)
        ->with('roomCheckinsToday', $roomCheckinsToday)
        ->with('roomCheckinDates', $roomCheckinDates)
        ->with('capacityArray', $capacityArray);
        //->with('reservations', $reservations);
    }*/

    /**
     * Display all backpacker units
     * 
     * @return \Illuminate\Http\Response 
     */
    public function backpacker()
    {
        $rooms = DB::table('units')
        ->where('units.unitType', 'room')
        ->get();

        $capacities = DB::table('units')
        ->select('units.capacity')
        ->where('units.unitType', '=', 'room')
        ->groupBy('units.capacity')
        ->get();

        $capacityArray = array();

        for($index = 0; $index < count($capacities); $index++) {
            array_push($capacityArray, $capacities[$index]->capacity);
        }

        $roomAccommodations = array();
        $roomReservations = array();

        for($index = 0; $index < count($rooms); $index++) {
            $bedAccommodations = DB::table('accommodations')
            ->leftJoin('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
            ->leftJoin('units', 'units.id', 'accommodation_units.unitID')
            ->leftJoin('guests', 'guests.accommodationID', 'accommodations.id')
            ->where('status', 'ongoing')
            ->where('units.unitType', 'room')
            ->where('units.id', $rooms[$index]->id)
            ->get();

            $bedReservations = DB::table('reservations')
            ->leftJoin('reservation_units', 'reservation_units.reservationID', 'reservations.id')
            ->leftJoin('units', 'units.id', 'reservation_units.unitID')
            ->where('status', 'reserved')
            ->where('units.unitType', 'room')
            ->where('units.id', $rooms[$index]->id)
            ->get();

            array_push($roomAccommodations, $bedAccommodations);
            array_push($roomReservations, $bedReservations);
        }

        //return $roomAccommodations;
        //return $roomReservations;

        return view('lodging.backpacker')
        ->with('rooms', $rooms)
        ->with('capacityArray', $capacityArray)
        ->with('roomAccommodations', $roomAccommodations)
        ->with('roomReservations', $roomReservations);
    }

    /**
     * Display tents in a calendar
     * 
     * @return \Illuminate\Http\Respone
     */
    public function calendarGlamping()
    {
        $units = DB::table('units')
        ->where('units.unitType', '=', 'tent')
        ->get();

        $days = array();

        //$from = null;
        //$to = null;

        for($index = 0; $index < 15 ; $index++){
            array_push($days, Carbon::now()->addDays($index)->format('Y-m-d'));
        }

        $accommodationDates = DB::table('accommodation_units')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('units', 'units.id', 'accommodation_units.unitID')
        ->select('accommodation_units.unitID', 'units.unitNumber', 'accommodation_units.checkinDatetime',
                 'accommodation_units.checkoutDatetime', 'accommodations.id AS accommodationID',
                 'guests.firstName', 'guests.lastName')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        $reservationDates = DB::table('reservation_units')
        ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->select('reservation_units.unitID', 'units.unitNumber', 'reservation_units.checkinDatetime',
                 'reservation_units.checkoutDatetime', 'reservations.id AS reservationID',
                 'reservations.firstName', 'reservations.lastName')
        ->where('reservation_units.status', '=', 'reserved')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        $blockDates = array_merge($accommodationDates, $reservationDates);

        //return $blockDates;

        $dateStrings = array();

        for($count = 0; $count < count($blockDates); $count++) {
            $dateString = $blockDates[$count]->unitNumber.Carbon::parse($blockDates[$count]->checkinDatetime)->format('Y-m-d').'PM';
            array_push($dateStrings, $dateString);
        }

        //return $dateStrings;

        return view('lodging.calendarglamping')->with('units', $units)->with('dates', $days)->with('blockDates', $blockDates)->with('dateStrings', $dateStrings);
    }

    /**
     * Reload clandar view for glamping
     * 
     * @return \Illuminate\Http\Response
     */
    public function reloadCalendarGlamping(Request $request)
    {
        $units = DB::table('units')
        ->where('units.unitType', '=', 'tent')
        ->get();

        $days = array();

        $from = Carbon::parse($request->input('glampingCalendarFrom'))->format('Y-m-d');
        $to = Carbon::parse($request->input('glampingCalendarTo'))->format('Y-m-d');

        $interval = date_diff(Carbon::parse($request->input('glampingCalendarFrom')), Carbon::parse($request->input('glampingCalendarTo')))->days;

        //return $interval; 

        if($interval < 15) {
            for($index = 0; $index < 15 ; $index++){
                array_push($days, Carbon::parse($request->input('glampingCalendarFrom'))->addDays($index)->format('Y-m-d'));
            }
        } else {
            for($index = 0; $index < $interval+1 ; $index++){
                array_push($days, Carbon::parse($request->input('glampingCalendarFrom'))->addDays($index)->format('Y-m-d'));
            }
        }

        $accommodationDates = DB::table('accommodation_units')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('units', 'units.id', 'accommodation_units.unitID')
        ->select('accommodation_units.unitID', 'units.unitNumber', 'accommodation_units.checkinDatetime',
                 'accommodation_units.checkoutDatetime', 'accommodations.id AS accommodationID',
                 'guests.firstName', 'guests.lastName')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        $reservationDates = DB::table('reservation_units')
        ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->select('reservation_units.unitID', 'units.unitNumber', 'reservation_units.checkinDatetime',
                 'reservation_units.checkoutDatetime', 'reservations.id AS reservationID',
                 'reservations.firstName', 'reservations.lastName')
        ->where('reservation_units.status', '=', 'reserved')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        $blockDates = array_merge($accommodationDates, $reservationDates);

        $dateStrings = array();

        for($count = 0; $count < count($blockDates); $count++) {
            $dateString = $blockDates[$count]->unitNumber.Carbon::parse($blockDates[$count]->checkinDatetime)->format('Y-m-d').'PM';
            array_push($dateStrings, $dateString);
        }

        return view('lodging.calendarglamping')->with('units', $units)->with('dates', $days)->with('blockDates', $blockDates)->with('dateStrings', $dateStrings)->with('from', $from)->with('to', $to);
    }

    /**
     * Display rooms in a calendar
     * 
     * @return \Illuminate\Http\Respone
     */
    public function calendarBackpacker()
    {
        $units = DB::table('units')
        ->where('units.unitType', '=', 'room')
        ->get();

        $days = array();

        for($index = 0; $index < 15; $index++){
            array_push($days, Carbon::now()->addDays($index)->format('Y-m-d'));
        }

        $accommodationDates = DB::table('accommodation_units')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('units', 'units.id', 'accommodation_units.unitID')
        ->select('accommodation_units.unitID', 'units.unitNumber', 'accommodation_units.checkinDatetime',
                 'accommodation_units.checkoutDatetime', 'accommodations.id AS accommodationID')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        $reservationDates = DB::table('reservation_units')
        ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->select('reservation_units.unitID', 'units.unitNumber', 'reservation_units.checkinDatetime',
                 'reservation_units.checkoutDatetime', 'reservations.id AS reservationID')
        ->where('reservation_units.status', '=', 'reserved')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        $blockDates = array_merge($accommodationDates, $reservationDates);

        //return $blockDates;

        $dateStrings = array();

        for($count = 0; $count < count($blockDates); $count++) {
            $dateString = $blockDates[$count]->unitNumber.Carbon::parse($blockDates[$count]->checkinDatetime)->format('Y-m-d').'PM';
            array_push($dateStrings, $dateString);
        }

        //return $dateStrings;

        return view('lodging.calendarbackpacker')->with('units', $units)->with('dates', $days)->with('blockDates', $blockDates)->with('dateStrings', $dateStrings);
    }

    /**
     * Reload clandar view for backpacker
     * 
     * @return \Illuminate\Http\Respone
     */
    public function reloadCalendarBackpacker(Request $request)
    {
        $units = DB::table('units')
        ->where('units.unitType', '=', 'room')
        ->get();

        $days = array();

        $from = Carbon::parse($request->input('backpackerCalendarFrom'))->format('Y-m-d');
        $to = Carbon::parse($request->input('backpackerCalendarTo'))->format('Y-m-d');

        $interval = date_diff(Carbon::parse($request->input('backpackerCalendarFrom')), Carbon::parse($request->input('backpackerCalendarTo')))->days;

        if($interval < 15) {
            for($index = 0; $index < 15 ; $index++){
                array_push($days, Carbon::parse($request->input('backpackerCalendarFrom'))->addDays($index)->format('Y-m-d'));
            }
        } else {
            for($index = 0; $index < $interval+1 ; $index++){
                array_push($days, Carbon::parse($request->input('backpackerCalendarFrom'))->addDays($index)->format('Y-m-d'));
            }
        }

        $accommodationDates = DB::table('accommodation_units')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('units', 'units.id', 'accommodation_units.unitID')
        ->select('accommodation_units.unitID', 'units.unitNumber', 'accommodation_units.checkinDatetime',
                 'accommodation_units.checkoutDatetime', 'accommodations.id AS accommodationID',
                 'guests.firstName', 'guests.lastName')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        $reservationDates = DB::table('reservation_units')
        ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->select('reservation_units.unitID', 'units.unitNumber', 'reservation_units.checkinDatetime',
                 'reservation_units.checkoutDatetime', 'reservations.id AS reservationID',
                 'reservations.firstName', 'reservations.lastName')
        ->where('reservation_units.status', '=', 'reserved')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        $blockDates = array_merge($accommodationDates, $reservationDates);

        $dateStrings = array();

        for($count = 0; $count < count($blockDates); $count++) {
            $dateString = $blockDates[$count]->unitNumber.Carbon::parse($blockDates[$count]->checkinDatetime)->format('Y-m-d').'PM';
            array_push($dateStrings, $dateString);
        }

        return view('lodging.calendarbackpacker')->with('units', $units)->with('dates', $days)->with('blockDates', $blockDates)->with('dateStrings', $dateStrings)->with('from', $from)->with('to', $to);
    }

    /**
     * Display all glamping units.
     * 
     * @return \Illuminate\Http\Response
     */
    public function glamping()
    {
        $units = DB::table('units')
        //->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.ID')
        ->leftJoin('accommodation_units', function($join) {
            $join->on('accommodation_units.unitID', '=', 'units.ID')
                 ->where('status', 'ongoing');
        })
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodation_units.accommodationID')
        ->leftJoin('services', 'services.id', 'accommodation_units.serviceID')
        ->select('units.id AS unitID', 'units.unitNumber', 'units.unitType','units.capacity', 'units.partOf',
                 'accommodation_units.status', 'accommodation_units.checkinDatetime AS checkinDatetime', 
                 'accommodation_units.numberOfPax', 'accommodation_units.serviceID AS serviceID',
                 'accommodation_units.checkoutDatetime AS checkoutDatetime', 'services.serviceName',
                 'accommodations.id AS accommodationID', 'accommodations.userID', 
                 'accommodations.numberOfPax AS totalNumberOfPax', 'accommodations.numberOfUnits',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName', 'guests.contactNumber')
        ->orderBy('unitID')
        ->get();

        //return $units;

        $reservations = DB::table('reservations')
        ->join('reservation_units', function($join) {
            $join->on('reservation_units.reservationID', '=', 'reservations.id')
                 ->where('status', 'reserved');
        })
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->orderBy('reservation_units.checkinDatetime')
        ->get();

        $charges = DB::table('charges')
        ->get();

        //return $charges;
        
        //return $reservations;
        //return $units;
        
        return view('lodging.glamping')->with('units', $units)->with('reservations', $reservations)->with('charges', $charges);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Return all unit numbers.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadTents()
    {
        return $units = DB::table('units')
        ->select('units.unitNumber')
        ->where('units.unitType', '=', 'tent')
        ->orderBy('id', 'ASC')
        ->get();

        //$units = Units::sortable()->paginate(8);
        //return view('admin.viewunits',compact('units'))->with('units', $units);
    }

    /**
     * Return room capacity.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadRoomCapacity($unitNumber)
    {
        $selectedUnit = DB::table('units')
        ->where('units.unitNumber', '=', $unitNumber)
        ->get();

        $beds = DB::table('units')
        ->where('units.unitType', '=', 'bed')
        ->where('partOf', '=', $selectedUnit[0]->id)
        ->orderBy('id', 'ASC')
        ->get();

        return count($beds);

        //$units = Units::sortable()->paginate(8);
        //return view('admin.viewunits',compact('units'))->with('units', $units);
    }

    /**
     * Return all unit ids with unit numbers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGlampingTents()
    {
        return $units = DB::table('units')
        ->where('units.unitType', '=', 'tent')
        ->orderBy('id', 'ASC')
        ->get();

        //$units = Units::sortable()->paginate(8);
        //return view('admin.viewunits',compact('units'))->with('units', $units);
    }

    /**
     * Return all unit ids with unit numbers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getBackpackerRooms()
    {
        return $units = DB::table('units')
        ->where('units.unitType', '=', 'room')
        ->orderBy('id', 'ASC')
        ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loadGlampingUnit($id)
    {
        $units = DB::table('units')
        //->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.ID')
        ->leftJoin('accommodation_units', function($join) {
            $join->on('accommodation_units.unitID', '=', 'units.ID')
                 ->where('status', 'ongoing');
        })
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodation_units.accommodationID')
        ->leftJoin('services', 'services.id', 'accommodation_units.serviceID')
        ->select('units.id AS unitID', 'units.unitNumber', 'units.unitType','units.capacity', 'units.partOf',
                 'accommodation_units.status', 'accommodation_units.checkinDatetime AS checkinDatetime', 
                 'accommodation_units.numberOfPax', 'accommodation_units.serviceID AS serviceID',
                 'accommodation_units.checkoutDatetime AS checkoutDatetime', 'services.serviceName',
                 'accommodations.id AS accommodationID', 'accommodations.userID', 
                 'accommodations.numberOfPax AS totalNumberOfPax', 'accommodations.numberOfUnits',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName', 'guests.contactNumber')
        ->where('unitID', '=', $id)
        ->get()
        ->toArray(); 

        $reservations = DB::table('units')
        //->leftJoin('reservation_units', 'reservation_units.unitID', 'units.id')
        ->join('reservation_units', function($join) {
            $join->on('reservation_units.unitID', '=', 'units.id')
                 ->where('status', 'reserved');
        })
        ->leftJoin('reservations', 'reservations.id', 'reservation_units.reservationID')
        ->leftJoin('services', 'services.id', 'reservation_units.serviceID')
        ->select('reservations.id AS reservationID', 'reservations.lastName AS reservationLastName', 
                'reservations.firstName AS reservationFirstName', 'reservations.numberOfPax AS reservationNumberOfPax',
                'reservations.numberOfUnits AS reservationNumberOfUnits', 'reservations.contactNumber AS reservationContactNumber',
                'reservation_units.status AS reservationStatus', 'reservation_units.checkinDatetime AS reservationCheckinDatetime', 
                'reservation_units.checkoutDatetime AS reservationCheckoutDatetime', 'services.id AS serviceID',
                'services.serviceType AS serviceType', 'services.serviceName AS serviceName')
        ->where('unitID', '=', $id)
        ->get()
        ->toArray(); 

        $remainingAvailed = DB::table('accommodation_units')
        ->leftJoin('units', 'units.id', 'accommodation_units.unitID')
        ->where('accommodationID', '=', $units[0]->accommodationID)
        ->where('status', 'ongoing')
        ->select('accommodation_units.accommodationID AS remainingAccommodations')
        ->get()
        ->toArray();

        $remainingArray = array();
        $remaining = 0;

        foreach ($remainingAvailed as $availed) {
            $remaining++;
        }

        array_push($remainingArray, $remaining);

        return array_merge($units, $reservations, $remainingAvailed, $remainingArray);
    }

    /**
     * Return room details.
     *
     * @return \Illuminate\Http\Response
     */
    public function loadBackpackerUnit($id)
    {
        /*$units = DB::table('units')
        ->leftJoin('accommodation_units', function($join) {
            $join->on('accommodation_units.unitID', '=', 'units.ID')
                 ->where('status', 'ongoing');
        })
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodation_units.accommodationID')
        ->leftJoin('services', 'services.id', 'accommodation_units.serviceID')
        ->select('units.id AS unitID', 'units.unitNumber', 'units.unitType','units.capacity', 'units.partOf',
                 'accommodation_units.status', 'accommodation_units.checkinDatetime AS checkinDatetime', 
                 'accommodation_units.numberOfPax', 'accommodation_units.serviceID AS serviceID',
                 'accommodation_units.checkoutDatetime AS checkoutDatetime', 'services.serviceName',
                 'accommodations.id AS accommodationID', 'accommodations.userID', 
                 'accommodations.numberOfPax AS totalNumberOfPax', 'accommodations.numberOfUnits',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName', 'guests.contactNumber')
        ->where('unitID', '=', $id)
        ->get()
        ->toArray(); */
        $units = DB::table('units')
        ->leftJoin('accommodation_units', function($join) {
            $join->on('accommodation_units.unitID', '=', 'units.ID')
                 ->where('accommodation_units.status', 'ongoing');
        })
        ->leftJoin('reservation_units', function($join) {
            $join->on('reservation_units.unitID', '=', 'units.ID')
                 ->where('reservation_units.status', 'reserved');
        })
        ->leftJoin('reservations', 'reservations.id', 'reservation_units.reservationID')
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodation_units.accommodationID')
        ->leftJoin('services', 'services.id', 'accommodation_units.serviceID')
        ->select('units.id AS unitID', 'units.unitNumber', 'units.unitType','units.capacity', 'units.partOf',
                 'accommodation_units.status', 'accommodation_units.checkinDatetime AS checkinDatetime', 
                 'accommodation_units.numberOfBunks', 'accommodation_units.serviceID AS serviceID',
                 'accommodation_units.checkoutDatetime AS checkoutDatetime', 'services.serviceName',
                 'accommodations.id AS accommodationID', 'accommodations.userID', 
                 'accommodations.numberOfPax AS totalNumberOfPax', 'accommodations.numberOfUnits',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName', 'guests.contactNumber',
                 'reservations.id AS reservationID', 'reservations.lastName AS reservationLastName', 
                 'reservations.firstName AS reservationFirstName', 'reservation_units.numberOfBunks AS reservationNumberOfBunks',
                 'reservations.numberOfUnits AS reservationNumberOfUnits', 'reservations.contactNumber AS reservationContactNumber',
                 'reservation_units.status AS reservationStatus', 'reservation_units.checkinDatetime AS reservationCheckinDatetime', 
                 'reservation_units.checkoutDatetime AS reservationCheckoutDatetime')
        ->where('units.id', '=', $id)
        ->get();
        /*$numberOfPaxArray = array();
        for($index = 0; $index < count($units); $index++) {
            array_push($numberOfPaxArray, $units[$index]->numberOfPax);
        }*/
        return $units;
    }
    /**
     * Load empty or available room details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function loadBackpackerAvailableUnit($id)
     {
         return DB::table('units')
         ->leftJoin('reservation_units', function($join) {
             $join->on('reservation_units.unitID', '=', 'units.id')
                  ->where('status', 'reserved');
         })
         ->leftJoin('reservations', 'reservations.id', 'reservation_units.reservationID')
         ->leftJoin('services', 'services.id', 'reservation_units.serviceID')
         ->select('units.id AS unitID', 'units.unitNumber', 'units.unitType','units.capacity',
                  'reservations.id AS reservationID', 'reservations.lastName AS lastName', 
                  'reservations.firstName AS firstName', 'reservation_units.numberOfBunks AS numberOfBunks',
                  'reservations.numberOfUnits AS numberOfUnits', 'reservations.contactNumber AS contactNumber',
                  'reservation_units.status AS status', 'reservation_units.checkinDatetime AS checkinDatetime', 
                  'reservation_units.checkoutDatetime AS checkoutDatetime', 'services.id AS serviceID',
                  'services.serviceType AS serviceType', 'services.serviceName AS serviceName')
         ->where('units.id', '=', $id)
         ->get();
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loadGuestDetails($id)
    {
        $guest = DB::table('units') //get units table
        ->leftJoin('accommodations', 'accommodations.unitID', 'units.id') // join with accommodations
        ->leftJoin('guest_stays', 'guest_stays.accommodationID', 'accommodations.id') //join with guest stays
        ->leftJoin('guests', 'guests.id', 'guest_stays.guestID') // join with guests
        ->select('units.*', 'accommodations.*', 'guests.*', 'guest_stays.*') // select everything in units, accommodations, and guests
        ->where('guests.id', '=', $id)
        ->get(['units.id AS unitID', 'guests.id AS guestID']);
        //return $guest;
        return view('lodging.guest-checkout')->with('guest', $guest);
        //}
    }

    /**
     * Load empty or available unit details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loadGlampingAvailableUnit($id)
    {
        return DB::table('units')
        //->leftJoin('reservation_units', 'reservation_units.unitID', 'units.id')
        ->leftJoin('reservation_units', function($join) {
            $join->on('reservation_units.unitID', '=', 'units.id')
                 ->where('status', 'reserved');
        })
        ->leftJoin('reservations', 'reservations.id', 'reservation_units.reservationID')
        ->leftJoin('services', 'services.id', 'reservation_units.serviceID')
        ->select('units.id AS unitID', 'units.unitNumber', 'units.unitType','units.capacity',
                 'reservations.id AS reservationID', 'reservations.lastName AS lastName', 
                 'reservations.firstName AS firstName', 'reservations.numberOfPax AS numberOfPax',
                 'reservations.numberOfUnits AS numberOfUnits', 'reservations.contactNumber AS contactNumber',
                 'reservation_units.status AS status', 'reservation_units.checkinDatetime AS checkinDatetime', 
                 'reservation_units.checkoutDatetime AS checkoutDatetime', 'services.id AS serviceID',
                 'services.serviceType AS serviceType', 'services.serviceName AS serviceName')
        //->select('units.id AS unitID')
        ->where('units.id', '=', $id)
        ->get();
    }

    /**
     * Display all units.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewUnits()
    {
        $units = DB::table('units')
        ->where('units.unitType', '!=', 'bed')
        ->orderBy('id', 'ASC')
        ->get();

        return view('admin.viewunits')->with('units', $units);
        //$units = Units::sortable()->paginate(8);
        //return view('admin.viewunits',compact('units'))->with('units', $units);
    }

    /**
     * Display all tents.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewTents()
    {
        $units = DB::table('units')
        ->where('units.unitType', '=', 'tent')
        ->orderBy('id', 'ASC')
        ->get();

        $header = 'Tents';

        return view('admin.viewunits')->with('units', $units)->with('header', $header);
    }

    /**
     * Display all rooms.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewRooms()
    {
        $units = DB::table('units')
        ->where('units.unitType', '=', 'room')
        ->orderBy('id', 'ASC')
        ->get();

        $header = 'Rooms';

        return view('admin.viewunits')->with('units', $units)->with('header', $header);;
    }

    /**
     * Show the add unit form
     *
     * @return \Illuminate\Http\Response
     */
    public function showAddUnitForm()
    {
        $units = DB::table('units')
        ->get(); 

        return view('admin.addunit')->with('units', $units);
    }

    /**
     * Add a unit
     *
     * @return \Illuminate\Http\Response
     */
    public function addUnit(Request $request)
    {
        $this->validate($request, [
            'unitType' => 'required',
            'unitNumber' => 'required|min:5|max:10',
            'capacity' => 'required|min:1|max:20',
        ]);

        $unit = new Units;
        $unit->unitType = $request->input('unitType');
        $unit->unitNumber = $request->input('unitNumber');
        $unit->capacity = $request->input('capacity');
        $unit->save(); 

        return redirect('/view-units');
    }

    /**
     * Show edit unit form
     *
     * @return \Illuminate\Http\Response
     */
    public function viewUnitDetails($unitID)
    {
        $units = DB::table('units')
        ->select('units.id AS unitID', 'units.unitType', 'units.unitNumber', 'units.capacity')
        ->where('units.id', '=', $unitID)
        ->get();
        
        return view('admin.editunit')->with('units', $units);
    }

    /**
     * Update unit details
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUnit(Request $request)
    {   
        $units = Units::find($request->input('unitID'));
        $units->update([
            'unitType' => $request->input('unitType'),
            'unitNumber' => $request->input('unitNumber'),
            'capacity' => $request->input('capacity')
        ]);
        
        return redirect('/view-units');
    }

    /**
     * Delete unit modal
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUnitModal($unitID)
    {   
        $units = DB::table('units')
        ->select('units.id AS unitID', 'units.unitType', 'units.unitNumber', 'units.capacity')
        ->where('units.id', '=', $unitID)
        ->get();

        return $unit;
    }

    /**
     * Delete unit
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteUnit($unitID)
    {   
        DB::table('units')->where('id', '=', $unitID)
        ->delete();

        return redirect('/view-units');
    }

    /**
     * Get accommodation and reservation dates on units.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDates()
    {
        $accommodationDates = DB::table('accommodation_units')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('units', 'units.id', 'accommodation_units.unitID')
        ->select('accommodation_units.unitID', 'units.unitNumber', 'accommodation_units.checkinDatetime',
                 'accommodation_units.checkoutDatetime', 'accommodations.id AS accommodationID')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->where('units.unitType', '=', 'tent')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        $reservationDates = DB::table('reservation_units')
        ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->select('reservation_units.unitID', 'units.unitNumber', 'reservation_units.checkinDatetime',
                 'reservation_units.checkoutDatetime', 'reservations.id AS reservationID')
        ->where('reservation_units.status', '=', 'reserved')
        ->where('units.unitType', '=', 'tent')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        //return $reservationDates;

        return array_merge($accommodationDates, $reservationDates);
    }

    /**
     * Get accommodation and reservation dates on units.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRoomDates()
    {
        /*$accommodationDates = DB::table('accommodation_units')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('units', 'units.id', 'accommodation_units.unitID')
        ->select('accommodation_units.unitID', 'units.unitNumber', 'accommodation_units.checkinDatetime',
                 'accommodation_units.checkoutDatetime', 'accommodations.id AS accommodationID')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->where('units.unitType', '!=', 'tent')
        ->orderBy('units.id')
        ->get()
        ->toArray();

        $reservationDates = DB::table('reservation_units')
        ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->select('reservation_units.unitID', 'units.unitNumber', 'reservation_units.checkinDatetime',
                 'reservation_units.checkoutDatetime', 'reservations.id AS reservationID')
        ->where('reservation_units.status', '=', 'reserved')
        ->where('units.unitType', '!=', 'tent')
        ->orderBy('units.id')
        ->get()
        ->toArray();*/

        $rooms = DB::table('units')
        ->where('units.unitType', 'room')
        ->get();

        $roomAccommodations = array();
        $roomReservations = array();

        $roomDates = array();

        for($index = 0; $index < count($rooms); $index++) {
            $bedAccommodations = DB::table('accommodations')
            ->leftJoin('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
            ->leftJoin('units', 'units.id', 'accommodation_units.unitID')
            ->leftJoin('guests', 'guests.accommodationID', 'accommodations.id')
            ->select('accommodation_units.unitID', 'units.unitNumber', 'accommodation_units.numberOfBunks',
                     'accommodation_units.checkinDatetime', 'accommodation_units.checkoutDatetime')
            ->where('status', 'ongoing')
            ->where('units.unitType', 'room')
            ->where('units.id', $rooms[$index]->id)
            ->get()
            ->toArray();

            $bedReservations = DB::table('reservations')
            ->leftJoin('reservation_units', 'reservation_units.reservationID', 'reservations.id')
            ->leftJoin('units', 'units.id', 'reservation_units.unitID')
            ->select('reservation_units.unitID', 'units.unitNumber', 'reservation_units.checkinDatetime',
                     'reservation_units.checkoutDatetime', 'reservations.id AS reservationID',
                     'reservation_units.numberOfBunks')
            ->where('status', 'reserved')
            ->where('units.unitType', 'room')
            ->where('units.id', $rooms[$index]->id)
            ->get()
            ->toArray();

            array_push($roomAccommodations, $bedAccommodations);
            array_push($roomReservations, $bedReservations);

            array_push($roomDates, array_merge($bedAccommodations, $bedReservations));
        }

        //return $reservationDates;

        return array($roomDates);

        //return array_merge($accommodationDates, $reservationDates);
    }

    /**
     * Display tents in a calendar
     * 
     * @return \Illuminate\Http\Respone
     */
    public function loadAdminDashboard()
    {
        $admin = DB::table('users')
        ->where('role', '=', 'admin')
        ->get();

        $lodging = DB::table('users')
        ->where('role', '=', 'lodging')
        ->get();

        $tents = DB::table('units')
        ->where('unitType', '=', 'tent')
        ->get();

        $rooms = DB::table('units')
        ->where('unitType', '=', 'room')
        ->get();

        $packages = DB::table('services')
        ->where('serviceType', '=', 'package')
        ->get();

        $services = DB::table('services')
        ->where('serviceType', '=', 'service')
        ->get();

        $extra = DB::table('services')
        ->where('serviceType', '=', 'extra')
        ->get();

        $damage = DB::table('services')
        ->where('serviceType', '=', 'damage')
        ->get();

        return view('admin.admindashboard')->with('admin', $admin)->with('lodging', $lodging)
            ->with('tents', $tents)->with('rooms', $rooms)->with('packages', $packages)
            ->with('services', $services)->with('extra', $extra)->with('damage', $damage);
    }
    
    /**
     * Show todays lodging report
     *
     * @return \Illuminate\Http\Response
     */
    public function todaysLodgingReport()
    {
        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();
        
        $glampingAccommodations = DB::table('accommodations')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->get();

        $tents = DB::table('units')
        ->where('units.unitType', '=', 'tent')
        ->get();

        $occupiedTents = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->where('units.unitType', '=', 'tent')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkinDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkoutDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        $backpackerAccommodations = DB::table('accommodations')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('services.serviceName', '=', 'Backpacker')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->get();

        $rooms = DB::table('units')
        ->where('units.unitType', '=', 'room')
        ->get();

        $occupiedRooms = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->where('units.unitType', '=', 'room')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkinDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkoutDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereDate('payments.paymentDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereDate('payments.paymentDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        return view('lodging.dailylodgingreports')->with('units', $units)
            ->with('glampingAccommodations', $glampingAccommodations)->with('tents', $tents)
            ->with('occupiedTents', $occupiedTents)->with('glampingArrivals', $glampingArrivals)
            ->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerAccommodations', $backpackerAccommodations)->with('rooms', $rooms)
            ->with('occupiedRooms', $occupiedRooms)->with('backpackerArrivals', $backpackerArrivals)
            ->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }

    public function todaysLodgingReportPrint()
    {
        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();
        
        $glampingAccommodations = DB::table('accommodations')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->get();

        $tents = DB::table('units')
        ->where('units.unitType', '=', 'tent')
        ->get();

        $occupiedTents = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->where('units.unitType', '=', 'tent')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkinDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkoutDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        $backpackerAccommodations = DB::table('accommodations')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('services.serviceName', '=', 'Backpacker')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->get();

        $rooms = DB::table('units')
        ->where('units.unitType', '=', 'room')
        ->get();

        $occupiedRooms = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->where('units.unitType', '=', 'room')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkinDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkoutDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereDate('payments.paymentDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereDate('payments.paymentDatetime', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        return view('lodging.dailyLodgingPrint')->with('units', $units)
            ->with('glampingAccommodations', $glampingAccommodations)->with('tents', $tents)
            ->with('occupiedTents', $occupiedTents)->with('glampingArrivals', $glampingArrivals)
            ->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerAccommodations', $backpackerAccommodations)->with('rooms', $rooms)
            ->with('occupiedRooms', $occupiedRooms)->with('backpackerArrivals', $backpackerArrivals)
            ->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }

    /**
     * Show daily lodging report depending on date input
     *
     * @return \Illuminate\Http\Response 
     */
    public function reloadDailyLodgingReport(Request $request)
    {
        $display = Carbon::parse($request->input('lodgingReportDate'))->format('Y-m-d');

        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();
        
        $glampingAccommodations = DB::table('accommodations')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereDate('accommodation_units.checkinDatetime', '<=', $display)
        ->whereDate('accommodation_units.checkoutDatetime', '>', $display)
        ->get();

        $tents = DB::table('units')
        ->where('units.unitType', '=', 'tent')
        ->get();

        $occupiedTents = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkinDatetime', '<=', $display)
        ->whereDate('accommodation_units.checkoutDatetime', '>', $display)
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkinDatetime', '=', $display)
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkoutDatetime', '=', $display)
        ->get();

        $backpackerAccommodations = DB::table('accommodations')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereDate('accommodation_units.checkinDatetime', '=', $display)
        ->get();

        $rooms = DB::table('units')
        ->where('units.unitType', '=', 'room')
        ->get();

        $occupiedRooms = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkinDatetime', '<=', $display)
        ->whereDate('accommodation_units.checkoutDatetime', '>', $display)
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkinDatetime', '=', $display)
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkoutDatetime', '=', $display)
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereDate('payments.paymentDatetime', '>=', $display)
        ->whereDate('payments.paymentDatetime', '=', $display)
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereDate('payments.paymentDatetime', '>=', $display)
        ->whereDate('payments.paymentDatetime', '<=', $display)
        ->get();

        return view('lodging.dailylodgingreports')->with('units', $units)->with('display', $display)
            ->with('glampingAccommodations', $glampingAccommodations)->with('tents', $tents)
            ->with('occupiedTents', $occupiedTents)->with('glampingArrivals', $glampingArrivals)
            ->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerAccommodations', $backpackerAccommodations)->with('rooms', $rooms)
            ->with('occupiedRooms', $occupiedRooms)->with('backpackerArrivals', $backpackerArrivals)
            ->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }

    /**
     * Show this week's lodging report
     *
     * @return \Illuminate\Http\Response
     */
    public function thisWeeksLodgingReport()
    {
        $displayto = Carbon::now()->addDays(6)->format('Y-m-d');

        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkinDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkinDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereDate('payments.paymentDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereDate('payments.paymentDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();

        return view('lodging.weeklylodgingreports')->with('units', $units)->with('displayto', $displayto)
            ->with('glampingArrivals', $glampingArrivals)->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerArrivals', $backpackerArrivals)->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }
    public function thisWeeksLodgingReportPrint()
    {
        $displayto = Carbon::now()->addDays(6)->format('Y-m-d');

        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkinDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkinDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereDate('payments.paymentDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereDate('payments.paymentDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();

        return view('lodging.weeklyLodgingPrint')->with('units', $units)->with('displayto', $displayto)
            ->with('glampingArrivals', $glampingArrivals)->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerArrivals', $backpackerArrivals)->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }

    /**
     * Show weekly lodging report based on date input
     *
     * @return \Illuminate\Http\Response
     */
    public function reloadWeeklyLodgingReport(Request $request)
    {
        $displayfrom = Carbon::parse($request->input('lodgingReportDate'))->format('Y-m-d');
        $displayto = Carbon::parse($request->input('lodgingReportDate'))->addDays(6)->format('Y-m-d');

        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkinDatetime', '>=', $displayfrom)
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', $displayfrom)
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkinDatetime', '>=', $displayfrom)
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', $displayfrom)
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereDate('payments.paymentDatetime', '>=', $displayfrom)
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereDate('payments.paymentDatetime', '>=', $displayfrom)
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();

        return view('lodging.weeklylodgingreports')->with('units', $units)->with('displayfrom', $displayfrom)->with('displayto', $displayto)
            ->with('glampingArrivals', $glampingArrivals)->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerArrivals', $backpackerArrivals)->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }

    /**
     * Show this month's lodging report
     *
     * @return \Illuminate\Http\Response
     */
    public function thisMonthsLodgingReport()
    {
        //$displayto = Carbon::now()->addDays(6)->format('Y-m-d');
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        $thisYear = Carbon::now()->format('Y');

        $display = Carbon::now()->format('M Y');

        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereMonth('accommodation_units.checkinDatetime', '=', $month)
        ->whereYear('accommodation_units.checkinDatetime', '=', $year)
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereMonth('accommodation_units.checkoutDatetime', '=', $month)
        ->whereYear('accommodation_units.checkoutDatetime', '=', $year)
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereMonth('accommodation_units.checkinDatetime', '=', $month)
        ->whereYear('accommodation_units.checkinDatetime', '=', $year)
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereMonth('accommodation_units.checkoutDatetime', '=', $month)
        ->whereYear('accommodation_units.checkoutDatetime', '=', $year)
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereMonth('payments.paymentDatetime', '=', $month)
        ->whereYear('payments.paymentDatetime', '=', $year)
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereMonth('payments.paymentDatetime', '=', $month)
        ->whereYear('payments.paymentDatetime', '=', $year)
        ->get();

        return view('lodging.monthlylodgingreports')->with('units', $units)->with('month', $month)->with('year', $year)->with('thisYear', $thisYear)->with('display', $display)
            ->with('glampingArrivals', $glampingArrivals)->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerArrivals', $backpackerArrivals)->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }

    public function thisMonthsLodgingReportPrint()
    {
        //$displayto = Carbon::now()->addDays(6)->format('Y-m-d');
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');

        $thisYear = Carbon::now()->format('Y');

        $display = Carbon::now()->format('M Y');

        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereMonth('accommodation_units.checkinDatetime', '=', $month)
        ->whereYear('accommodation_units.checkinDatetime', '=', $year)
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereMonth('accommodation_units.checkoutDatetime', '=', $month)
        ->whereYear('accommodation_units.checkoutDatetime', '=', $year)
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereMonth('accommodation_units.checkinDatetime', '=', $month)
        ->whereYear('accommodation_units.checkinDatetime', '=', $year)
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereMonth('accommodation_units.checkoutDatetime', '=', $month)
        ->whereYear('accommodation_units.checkoutDatetime', '=', $year)
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereMonth('payments.paymentDatetime', '=', $month)
        ->whereYear('payments.paymentDatetime', '=', $year)
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereMonth('payments.paymentDatetime', '=', $month)
        ->whereYear('payments.paymentDatetime', '=', $year)
        ->get();

        return view('lodging.monthlyLodgingPrint')->with('units', $units)->with('month', $month)->with('year', $year)->with('thisYear', $thisYear)->with('display', $display)
            ->with('glampingArrivals', $glampingArrivals)->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerArrivals', $backpackerArrivals)->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }

    /**
     * Show monthly lodging report based on month and year input
     *
     * @return \Illuminate\Http\Response
     */
    public function reloadMonthlyLodgingReport(Request $request)
    {
        $monthString = '22-'.$request->input('selectMonth').'-1999';
        $month = Carbon::parse($monthString)->format('m');
        
        $yearString = '22-12-'.$request->input('selectYear');
        $year = Carbon::parse($yearString)->format('Y');

        $dateInput = '22-'.$month.'-'.$year;

        $thisYear = Carbon::now()->format('Y');

        $display = Carbon::parse($dateInput)->format('M Y');

        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereMonth('accommodation_units.checkinDatetime', '=', $month)
        ->whereYear('accommodation_units.checkinDatetime', '=', $year)
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereMonth('accommodation_units.checkoutDatetime', '=', $month)
        ->whereYear('accommodation_units.checkoutDatetime', '=', $year)
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereMonth('accommodation_units.checkinDatetime', '=', $month)
        ->whereYear('accommodation_units.checkinDatetime', '=', $year)
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereMonth('accommodation_units.checkoutDatetime', '=', $month)
        ->whereYear('accommodation_units.checkoutDatetime', '=', $year)
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereMonth('payments.paymentDatetime', '=', $month)
        ->whereYear('payments.paymentDatetime', '=', $year)
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereMonth('payments.paymentDatetime', '=', $month)
        ->whereYear('payments.paymentDatetime', '=', $year)
        ->get();

        return view('lodging.monthlylodgingreports')->with('units', $units)->with('month', $month)->with('year', $year)->with('thisYear', $thisYear)->with('display', $display)
            ->with('glampingArrivals', $glampingArrivals)->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerArrivals', $backpackerArrivals)->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }

    /**
     * Show custom lodging report
     *
     * @return \Illuminate\Http\Response
     */
    public function customLodgingReport()
    {
        $displayto = Carbon::now()->addDays(1)->format('Y-m-d');

        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkinDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkinDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereDate('payments.paymentDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereDate('payments.paymentDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();

        return view('lodging.customlodgingreport')->with('units', $units)->with('displayto', $displayto)
            ->with('glampingArrivals', $glampingArrivals)->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerArrivals', $backpackerArrivals)->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }

    public function customLodgingReportPrint()
    {
        $displayto = Carbon::now()->addDays(1)->format('Y-m-d');

        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkinDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkinDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereDate('payments.paymentDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereDate('payments.paymentDatetime', '>=', Carbon::now()->format('Y-m-d'))
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();

        return view('lodging.customLodgingPrint')->with('units', $units)->with('displayto', $displayto)
            ->with('glampingArrivals', $glampingArrivals)->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerArrivals', $backpackerArrivals)->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }
    /**
     * Show custom lodging report
     *
     * @return \Illuminate\Http\Response
     */
    public function reloadCustomLodgingReport(Request $request)
    {
        $displayfrom = Carbon::parse($request->input('displayFrom'))->format('Y-m-d');
        $displayto = Carbon::parse($request->input('displayTo'))->format('Y-m-d');

        $units = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->get();

        $glampingArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkinDatetime', '>=', $displayfrom)
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $glampingDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'tent')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', $displayfrom)
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $backpackerArrivals = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkinDatetime', '>=', $displayfrom)
        ->whereDate('accommodation_units.checkinDatetime', '<=', $displayto)
        ->get();

        $backpackerDepartures = DB::table('units')
        ->join('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->where('units.unitType', '=', 'room')
        ->whereDate('accommodation_units.checkoutDatetime', '>=', $displayfrom)
        ->whereDate('accommodation_units.checkoutDatetime', '<=', $displayto)
        ->get();

        $glampingPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', 'like', '%Glamping%')
        ->whereDate('payments.paymentDatetime', '>=', $displayfrom)
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();
        
        $backpackerPayments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->join('guests', 'guests.accommodationID', 'charges.accommodationID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->where('services.serviceName', '=', 'Backpacker')
        ->whereDate('payments.paymentDatetime', '>=', $displayfrom)
        ->whereDate('payments.paymentDatetime', '<=', $displayto)
        ->get();

        return view('lodging.customlodgingreport')->with('units', $units)->with('displayfrom', $displayfrom)->with('displayto', $displayto)
            ->with('glampingArrivals', $glampingArrivals)->with('glampingDepartures', $glampingDepartures)
            ->with('backpackerArrivals', $backpackerArrivals)->with('backpackerDepartures', $backpackerDepartures)
            ->with('glampingPayments', $glampingPayments)->with('backpackerPayments', $backpackerPayments);
    }
}
