<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //->orderBy('paymentDatetime')
        ->get();
        
        //return $reservations;

        return view('lodging.viewreservations')->with('reservations', $reservations);
    }

    /**
     * Store a newly created reservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function makeReservation(Request $request)
    {
        $reservation = new Reservations;
        $reservation->reservationDatetime = $request->input('reservationDatetime');
        $reservation->lastName = $request->input('lastName');
        $reservation->firstName = $request->input('firstName');
        $reservation->numberOfPax = $request->input('numberOfPax');
        $reservation->contactNumber = $request->input('contactNumber');
        $reservation->serviceID = $request->input('package');
        $reservation->save();
    }
}
