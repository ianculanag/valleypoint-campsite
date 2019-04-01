<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Units;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        ->leftJoin('services', 'services.id', 'accommodations.serviceID')
        ->select('units.id AS unitID', 'units.unitNumber', 'units.unitType','units.capacity', 'units.partOf',
                 'accommodation_units.status', 'services.serviceName', 
                 'accommodations.id AS accommodationID', 'accommodations.numberOfPax', 'accommodations.checkinDatetime', 
                 'accommodations.checkoutDatetime', 'accommodations.serviceID', 'accommodations.userID',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName',   'guests.contactNumber')      
        ->orderBy('unitID')
        ->get(); 
        
        return view('lodging.transient')->with('units', $units);
    }

    /**
     * Display all glamping units.
     * 
     * @return \Illuminate\Http\Response
     */
    public function glamping()
    {
        /*$units = DB::table('units')
        ->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.ID')
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodation_units.accommodationID')
        ->leftJoin('services', 'services.id', 'accommodations.serviceID')
        ->select('units.id AS unitID', 'units.unitNumber', 'units.unitType','units.capacity', 'units.partOf',
                 'accommodation_units.status', 'services.serviceName', 
                 'accommodations.id AS accommodationID', 'accommodations.numberOfPax', 'accommodations.checkinDatetime', 
                 'accommodations.checkoutDatetime', 'accommodations.serviceID', 'accommodations.userID',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName', 'guests.contactNumber')   
        //->where('guests.listedUnder', '=', null)        
        ->orderBy('unitID')
        ->get(); */

        $units = DB::table('units')
        ->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.ID')
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
        
        return view('lodging.glamping')->with('units', $units);
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
    public function loadUnit($id)
    {
        return DB::table('units')
        ->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.ID')
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodation_units.accommodationID')
        ->leftJoin('services', 'services.id', 'accommodations.serviceID')
        ->select('units.id AS unitID', 'units.unitNumber', 'units.unitType','units.capacity', 'units.partOf',
                 'accommodation_units.status', 'services.serviceName', 
                 'accommodations.id AS accommodationID', 'accommodations.numberOfPax', 'accommodations.checkinDatetime', 
                 'accommodations.checkoutDatetime', 'accommodations.serviceID', 'accommodations.userID',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName',   'guests.contactNumber')   
        ->where('unitID', '=', $id)   
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
        return view('lodging.guestcheckout')->with('guest', $guest);
        //}
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
     * Get accommodation and reservation dates on units.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDates()
    {
        $dates = DB::table('accommodation_units')
        ->join('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->join('units', 'units.id', 'accommodation_units.unitID')
        ->select('accommodation_units.unitID', 'units.unitNumber', 'accommodations.checkinDatetime', 'accommodations.checkoutDatetime')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->get();

        return $dates;
    }
}
