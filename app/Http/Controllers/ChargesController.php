<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charges;
use App\Payments;

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
}
