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
     * Display units in a calendar
     * 
     * @return \Illuminate\Http\Respone
     */
    public function calendar()
    {
        $units = DB::table('units')
        ->get();

        $days = array();

        for($index = 1; $index < 15; $index++){
            array_push($days, Carbon::now()->addDays($index)->format('M j'));
        }

        //return $days;

        return view('lodging.calendar-glamping')->with('units', $units)->with('dates', $days);
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
        ->leftJoin('reservation_units', 'reservation_units.unitID', 'units.id')
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
        
        $url = '/edit-unit'.'/'.$request->input('unitID');
        return redirect($url);
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
        ->get()
        ->toArray();

        $reservationDates = DB::table('reservation_units')
        ->join('reservations', 'reservations.id', 'reservation_units.reservationID')
        ->join('units', 'units.id', 'reservation_units.unitID')
        ->select('reservation_units.unitID', 'units.unitNumber', 'reservation_units.checkinDatetime',
                 'reservation_units.checkoutDatetime', 'reservations.id AS reservationID')
        ->where('reservation_units.status', '=', 'reserved')
        ->get()
        ->toArray();

        //return $reservationDates;

        return array_merge($accommodationDates, $reservationDates);
    }
}
