<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charges;
use App\Payments;
use DB;

class ChargesController extends Controller
{
    //
    public function addAdditionalService(Request $request)
    {
        $charges = new Charges;
        $charges->quantity = $request->input('additionalServiceNumberOfPax');
        $charges->totalPrice = $request->input('additionalServicePrice');
        $charges->remarks = 'full';
        $charges->accommodationID = $request->input('additionalServiceAccommodationID');
        $charges->serviceID = $request->input('additionalServiceName');
        $charges->save();
    }

    /**
     * Display guest charges
     *
     * @return \Illuminate\Http\Response
     */
    public function viewLodgingCharges()
    {
        $charges = DB::table('charges')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'charges.serviceID')
        ->select('charges.id AS chargeID', 'accommodations.id AS accommodationID', 'guests.firstName', 'guests.lastName',
                'services.serviceName', 'charges.quantity', 'charges.totalPrice', 'charges.balance')
        ->get();

        return view('lodging.viewcharges')->with('charges', $charges);
    }
}
