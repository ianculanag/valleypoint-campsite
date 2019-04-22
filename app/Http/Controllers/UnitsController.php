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
    public function transientBackpacker()
    {        
        /*$units = DB::table('units')
        ->leftJoin('accommodations', 'accommodations.unitID', 'units.id')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodations.id')
        ->leftJoin('services', 'services.id', 'accommodations.serviceID')
        ->select('units.*', 'units.id AS unitID','guests.id AS guestID', 'guests.accommodationID', 
        'guests.lastName', 'guests.firstName', 'guests.listedUnder', 'guests.contactNumber', 'accommodations.numberOfPax',
        'accommodations.serviceID', 'accommodations.paymentStatus',
        'accommodations.checkinDatetime', 'accommodations.checkoutDatetime','accommodations.id AS accommodationsID',
        'services.id AS serviceID', 'services.serviceName')
        ->where('guests.listedUnder', '=', null)
        ->orderBy('unitID')
        ->get();
        //return $units;
        return view('lodging.transient')->with('units', $units);*/
        $units = DB::table('units')
        ->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.ID')
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodation_units.accommodationID')
        ->leftJoin('services', 'services.id', 'accommodation_units.serviceID')
        ->select('units.id AS unitID', 'units.unitNumber', 'units.unitType','units.capacity', 'units.partOf',
                 'accommodation_units.status', 'services.serviceName', 
                 'accommodations.id AS accommodationID', 'accommodations.numberOfPax', 'accommodation_units.checkinDatetime', 
                 'accommodation_units.checkoutDatetime', 'accommodation_units.serviceID', 'accommodations.userID',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName',   'guests.contactNumber')      
        ->orderBy('unitID')
        ->get(); 
        
        return view('lodging.transient')->with('units', $units);
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
     * @return \Illuminate\Http\Respone
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
        
        //return $reservations;
        //return $units;
        
        return view('lodging.glamping')->with('units', $units)->with('reservations', $reservations);
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

        return array_merge($units, $reservations);
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

        return $units;
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

        //return $reservationDates;

        return array_merge($accommodationDates, $reservationDates);
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
}
