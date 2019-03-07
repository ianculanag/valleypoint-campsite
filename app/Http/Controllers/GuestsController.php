<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Guests;
use App\Accommodation;
use App\Units;
use Auth;
use Redirect;

class GuestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addGuest()
    {
        //
        $guest = new Guests;
        $guest->lastName = 'Tagudar';
        $guest->firstName = 'Vince';
        $guest->contactNumber = '09087018753';
        $guest->numberOfPax = '2';
        $guest->save();
        
        $accommodation = new Accommodation;
        $accommodation->accommodationType = 'transient';
        $accommodation->price = '3500';
        $accommodation->paymentStatus = 'pending';
        $accommodation->staffID = '1';
        $accommodation->unitID = '3';
        
        $guest->accommodation()->save($accommodation);

        return 'Hello';
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkin(Request $request)
    {
        //
        $guest = new Guests;
        $guest->lastName = $request->input('lastName');
        $guest->firstName = $request->input('firstName');
        $guest->contactNumber = $request->input('contactNumber');
        $guest->numberOfPax = $request->input('numberOfPax');
        $guest->save();

        $accommodation = new Accommodation;         
        $accommodation->guestID = $guest->id;   
        $accommodation->serviceID = '4';
        //$accommodation->price = '3500';
        $accommodation->paymentStatus = 'pending';
        $accommodation->userID = Auth::user()->id;
        $accommodation->unitID = $request->input('unitID');
        $accommodation->checkinDatetime = $request->input('checkinDate').' '.$request->input('checkinTime');
        $accommodation->checkoutDatetime = $request->input('checkoutDate').' '.$request->input('checkoutTime'); 
        $accommodation->save();

        /*$guestStay = new GuestStay;
        $guestStay->guestID = $guest->id;
        $guestStay->accommodationID = $accommodation->id;
        $guestStay->checkinDatetime = $request->input('checkinDate').' '.$request->input('checkinTime');
        $guestStay->checkoutDatetime = $request->input('checkoutDate').' '.$request->input('checkoutTime');
        //$guestStay->checkinDatetime = '2019-03-27 15:45:21';
        //$guestStay->checkoutDatetime = '2019-03-29 15:45:21';
        $guestStay->save();*/

        $unit = Units::find($request->input('unitID'));
        $unit->update([
            'status' => 'occupied'
        ]);

        return redirect('/glamping');
    }

    /**
     * Update guest details
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateDetails(Request $request)
    {

        //$unit = Units::find($request->input('unitID'));
        $user = Guests::find($request->input('guestID'));
        $user->update([
            'firstName' => $request->input('firstName'),
            'lastName' =>  $request->input('lastName'),
            'contactNumber' => $request->input('contactNumber')
            //'numberOfPax' => $numberOfPax
        ]);

        $url = '/editdetails'.'/'.$request->input('unitID');
        //return \Redirect::route('/editdetails', [$request->input('unitID')]);
        //return $url;
        return redirect($url);
    }


    /**
     * Show the check in form
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckinForm($unitID)
    {
        return view('lodging.checkin')->with('unitID', $unitID);
    }

    /**
     * Show the check out form
     *
     * @return \Illuminate\Http\Response
     */
    public function editGuestDetails($unitID)
    {
        $guest = DB::table('units') //get units table
        ->leftJoin('accommodations', 'accommodations.unitID', 'units.id') // join with accommodations
        ->leftJoin('guests', 'guests.accommodationID', 'accommodations.id') // join with guests
        ->leftJoin('services', 'services.id', 'accommodations.serviceID') // join with services
        ->select('units.*', 'units.id AS unitID','guests.id AS guestID', 
        'guests.lastName', 'guests.firstName', 'guests.listedUnder', 'guests.contactNumber', 'accommodations.numberOfPax',
        'accommodations.serviceID', 'accommodations.paymentStatus',
        'accommodations.checkinDatetime', 'accommodations.checkoutDatetime','accommodations.id AS accommodationsID',
        'services.id AS serviceID', 'services.serviceName', 'services.price')
        ->where('units.id', '=', $unitID)
        ->get();
        return view('lodging.editdetails')->with('guest', $guest);
    }

    /**
     * Show the check out form
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckoutForm($unitID)
    {
        $guest = DB::table('units') //get units table
        ->leftJoin('accommodations', 'accommodations.unitID', 'units.id') // join with accommodations
        ->leftJoin('guests', 'guests.accommodationID', 'accommodations.id') // join with guests
        ->leftJoin('services', 'services.id', 'accommodations.serviceID') // join with services
        ->select('units.*', 'units.id AS unitID','guests.id AS guestID', 
        'guests.lastName', 'guests.firstName', 'guests.listedUnder', 'guests.contactNumber', 'accommodations.numberOfPax',
        'accommodations.serviceID', 'accommodations.paymentStatus',
        'accommodations.checkinDatetime', 'accommodations.checkoutDatetime','accommodations.id AS accommodationsID',
        'services.id AS serviceID', 'services.serviceName', 'services.price')
        ->where('units.id', '=', $unitID)
        ->where('guests.listedUnder', '=', null)
        ->get();
        return view('lodging.checkout')->with('guest', $guest);
    }

    public function viewGuests()
    {
        $guest = DB::table('guests')
        ->leftJoin('accommodations', 'accommodations.id', 'guests.accommodationID')
        // ->leftJoin('accommodations', 'accommodations.unitID', 'units.id')
        ->select('guests.*', 'guests.id AS guestID')
        ->get();
       // return $guest;
        return view('lodging.viewguests')->with('guest', $guest);
    }
}
