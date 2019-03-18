<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Guests;
use App\Accommodation;
use App\Units;
use App\AdditionalCharges;
use App\Services;
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

        //for ('listedUnder', '=', $guest[0]->guestID) {}
        if ($request->numberOfPax > 1) {

            $accompanyingGuests = DB::table('guests')
            ->where('listedUnder', '=', $request->input('guestID'))
            ->get();

            //return $accompanyingGuests;

            for ($count = 1; $count < $request->numberOfPax; $count++) {
                $firstName = 'firstName'.$count;
                $lastName = 'lastName'.$count;

                $user = Guests::find($accompanyingGuests[$count-1]->id);
                $user->update([
                    'firstName' => $request->input($firstName),
                    'lastName' =>  $request->input($lastName)
                ]);
            }
        }
        /*
        if ($request->input('numberOfAdditionalCharges') > 0) {

            $services = DB::table('services')
            ->where('id', '>', 5)
            ->get();

            for ($count = 1; $count <= $request->input('numberOfAdditionalCharges'); $count++) {
                $serviceID = 'serviceID'.$count;
                $numberOfPax = 'numberOfPaxAdditional'.$count;
                $paymentStatus = 'paymentStatus'.$count;

                $service = DB::table('services')
                ->where('id', '=', $request->input($serviceID))
                ->get();

                $price = $service[0]->price;
                $pax = $request->input($numberOfPax);
                $totalPrice = $price * $pax;

                $additionalCharge = new AdditionalCharges;
                $additionalCharge->accommodationID = $request->input('accommodationID');
                $additionalCharge->serviceID = $request->input($serviceID);
                $additionalCharge->numberOfPax = $request->input($numberOfPax);
                $additionalCharge->totalPrice = $totalPrice;
                $additionalCharge->paymentStatus = $request->input($paymentStatus);
                $additionalCharge->save();
                
                //$totalPrice = $service->price * $numberOfPax;

                //EARTHQUAKE DRILL

            }
        }*/

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
        $guest = DB::table('units')
        ->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodations.id')
        ->leftJoin('services', 'services.id', 'accommodations.serviceID')
        ->select('units.id AS unitID', 'units.unitType', 'units.unitNumber', 'units.capacity', 'units.partOf',
                 'accommodation_units.status', 'accommodations.id AS accommodationID', 'accommodations.numberOfPax',
                 'accommodations.checkinDatetime', 'accommodations.checkoutDatetime',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName', 'guests.listedUnder', 'guests.contactNumber',
                 'services.id AS serviceID', 'services.serviceType', 'services.serviceName', 'services.price')
        ->where('units.id', '=', $unitID)
        ->where('guests.listedUnder', '=', null)
        ->get();

        //return $guest;

        $accompanyingGuest = DB::table('guests')
        ->select('guests.*')
        ->where('listedUnder', '=', $guest[0]->guestID)
        ->get();

        //return $accompanyingGuest;

        $charges = DB::table('charges')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->leftJoin('payments', 'payments.chargeID', 'charges.id')
        ->where('accommodationID', '=', $guest[0]->accommodationID)
        ->get();

        //return $charges;

        return view('lodging.editdetails')->with('guest', $guest)->with('accompanyingGuest', $accompanyingGuest)->with('charges', $charges);
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
        
        $accompanyingGuest = DB::table('guests')
        ->select('guests.*')
        ->where('listedUnder', '=', $guest[0]->guestID)
        ->get();

        return view('lodging.checkout')->with('guest', $guest)->with('accompanyingGuest', $accompanyingGuest);
    }

    public function viewGuests()
    {
        $guest = DB::table('guests')
        ->leftJoin('accommodations', 'accommodations.id', 'guests.accommodationID')
        ->leftJoin('services', 'services.id', 'accommodations.serviceID')
        ->select('guests.*', 'guests.id AS guestID', 'serviceName', 'accommodations.numberOfPax')
        ->get();
       // return $guest;
        return view('lodging.viewguests')->with('guest', $guest);
    }
}

