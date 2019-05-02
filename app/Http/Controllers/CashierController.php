<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    //


    public function showCashierReport()
    {
        return view('restaurant.cashierShiftReport');
    }
}
