<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Units;
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
        ->leftJoin('guest_stays', 'guest_stays.accommodationID', 'accommodations.id')
        ->leftJoin('guests', 'guests.id', 'guest_stays.guestID')
        ->select('units.*', 'accommodations.*', 'guests.*')
        ->get(['units.id AS unitID', 'guests.id AS guestID']);
        return view('lodging.transient')->with('units', $units);*/
        $units = DB::table('units')
        ->leftJoin('accommodations', 'accommodations.unitID', 'units.id')
        ->leftJoin('guests', 'guests.id', 'accommodations.guestID')
        ->leftJoin('services', 'services.id', 'accommodations.serviceID')
        ->select('units.*', 'units.id AS unitID','guests.id AS guestID', 
        'guests.lastName', 'guests.firstName', 'guests.listedUnder', 'guests.contactNumber', 'guests.numberOfPax',
        'accommodations.serviceID', 'accommodations.paymentStatus',
        'accommodations.checkinDatetime', 'accommodations.checkoutDatetime','accommodations.id AS accommodationsID',
        'services.id AS serviceID')
        ->get();
        //return $units;
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
        ->leftJoin('accommodations', 'accommodations.unitID', 'units.id')
        ->leftJoin('guest_stays', 'guest_stays.accommodationID', 'accommodations.id')
        ->leftJoin('guests', 'guests.id', 'guest_stays.guestID')
        ->select('units.*', 'units.id AS unitID', 'guest_stays.*', 'guests.id AS guestID', 
        'guests.lastName', 'guests.firstName', 'guests.listedUnder', 'guests.contactNumber', 'guests.numberOfPax',
        'accommodations.accommodationType', 'accommodations.price', 'accommodations.paymentStatus',
        'guest_stays.checkinDatetime', 'guest_stays.checkoutDatetime','accommodations.id AS accommodationsID' )
        ->get();
        //->leftJoin('guest_stays', 'guest_stays.accommodationID', 'accommodations.id')
        //->leftJoin('guests', 'guests.id', 'guest_stays.guestID')
        //->select('units.*', 'accommodations.*', 'guests.*')
        //->get(['units.id AS unitID', 'guests.id AS guestID']);
        return view('lodging.glamping')->with('units', $units);
        //return $units;*/

        $units = DB::table('units')
        ->leftJoin('accommodations', 'accommodations.unitID', 'units.id')
        ->leftJoin('guests', 'guests.id', 'accommodations.guestID')
        ->leftJoin('services', 'services.id', 'accommodations.serviceID')
        ->select('units.*', 'units.id AS unitID','guests.id AS guestID', 
        'guests.lastName', 'guests.firstName', 'guests.listedUnder', 'guests.contactNumber', 'guests.numberOfPax',
        'accommodations.serviceID', 'accommodations.paymentStatus',
        'accommodations.checkinDatetime', 'accommodations.checkoutDatetime','accommodations.id AS accommodationsID',
        'services.id AS serviceID')
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
        //if(Request::ajax()){
        //return 'getRequest has loaded completely';
        //return DB::table('units') //get units table
        //->leftJoin('accommodations', 'accommodations.unitID', 'units.id') // join with accommodations
        //->leftJoin('guest_stays', 'guest_stays.accommodationID', 'accommodations.id') //join with guest stays
        //->leftJoin('guests', 'guests.id', 'guest_stays.guestID') // join with guests
        //->select('units.*', 'accommodations.*', 'guests.*', 'guest_stays.*') // select everything in units, accommodations, and guests
        //->where('units.id', '=', $id)
        //->get(['units.id AS unitID', 'guests.id AS guestID']);
        return DB::table('units')
        ->leftJoin('accommodations', 'accommodations.unitID', 'units.id')
        ->leftJoin('guests', 'guests.id', 'accommodations.guestID')
        ->leftJoin('services', 'services.id', 'accommodations.serviceID')
        ->select('units.*', 'units.id AS unitID','guests.id AS guestID', 
        'guests.lastName', 'guests.firstName', 'guests.listedUnder', 'guests.contactNumber', 'guests.numberOfPax',
        'accommodations.serviceID', 'accommodations.paymentStatus',
        'accommodations.checkinDatetime', 'accommodations.checkoutDatetime','accommodations.id AS accommodationsID',
        'services.id AS serviceID')
        ->where('units.id', '=', $id)
        ->get();
        //return $units;
        //return view('lodging.glamping')->with('units', $units);
        //}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loadGuestDetails($id)
    {
        //if(Request::ajax()){
        //return 'getRequest has loaded completely';
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
}
