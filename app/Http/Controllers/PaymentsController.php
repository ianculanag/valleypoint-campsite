<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PaymentsController extends Controller
{
     /**
     * Display payment transactions for lodging.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewLodgingSales()
    {
        $payments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('guests', 'guests.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'charges.serviceID')
        ->where('guests.listedUnder', '=', null)
        //->orderBy('paymentDatetime')
        ->get();

        //return $payments;

        return view('lodging.payments')->with('payments', $payments);
    }
}
