<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReservationsController extends Controller
{
    //    
    public function viewReservations()
    {
        $reservations = DB::table('reservations')
        //->orderBy('paymentDatetime')
        ->get();
        
        //return $reservations;

        return view('lodging.viewreservations')->with('reservations', $reservations);
    }
}
