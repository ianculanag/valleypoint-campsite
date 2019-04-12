<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Guests;
use App\Accommodation;
use App\Units;
use App\Charges;
use App\Services;
use App\Payments;
use Carbon\Carbon;
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

        //$users->error;

        for($count = 0; $count < $request->input('chargesCount'); $count++) {
            $existingCharge = 'charge'.$count;
            $paymentEntry = 'payment'.$count;
            if($request->input($paymentEntry)) {
                $payment = new Payments;
                $payment->paymentDatetime = Carbon::now();
                $payment->amount = $request->input($paymentEntry);
                $payment->paymentStatus = 'full';
                $payment->chargeID = $request->input($existingCharge);
                $payment->save();

                $charge = Charges::find($request->input($existingCharge));
                $charge->update([
                    'remarks' => 'full'
                ]);
            }
        }

        $additionalChargesCount = 0;
        $additionalChargesArray = array();

        if($request->input('additionalServicesCount') > 0) {
            for($count = 1; $count <= $request->input('additionalServicesCount'); $count++) {
                $additionalServiceID = 'additionalServiceID'.$count;
                $additionalServiceNumberOfPax = 'additionalServiceNumberOfPax'.$count;
                $additionalTotalPrice = 'additionalServiceTotalPrice'.$count;
                if($request->input($additionalServiceID)) {
                    $charges = new Charges;                    
                    $charges->quantity = $request->input($additionalServiceNumberOfPax);
                    $charges->totalPrice = $request->input($additionalTotalPrice);
                    $charges->balance = $request->input($additionalTotalPrice);
                    $charges->remarks = 'unpaid';
                    $charges->accommodationID = $request->input('accommodationID');
                    $charges->serviceID = $request->input($additionalServiceID);
                    $charges->save();
                    $additionalChargesCount++;
                    array_push($additionalChargesArray, $charges->id);
                }
            }
        }

        $firstAdditionalCharge = $request->input('chargesCount'); //get index of newly added charges

        for($count = 0; $count < $additionalChargesCount; $count++) {
            $index = $count+$firstAdditionalCharge;
            $paymentEntry = 'payment'.$index;
            if($request->input($paymentEntry)) {
                $payment = new Payments;
                $payment->paymentDatetime = Carbon::now();
                $payment->amount = $request->input($paymentEntry);
                $payment->paymentStatus = 'full';
                $payment->chargeID = $additionalChargesArray[$count];
                $payment->save();

                $charge = Charges::find($additionalChargesArray[$count]);
                $charge->update([
                    'remarks' => 'full'
                ]);
            }
        }
        
        $url = '/edit-details'.'/'.$request->input('unitID');
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
     * Show the accommodationDetails
     *
     * @return \Illuminate\Http\Response
     */
    public function viewGuestDetails($unitID)
    {
        $guest = DB::table('units')
        //->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->leftJoin('accommodation_units', function($join) {
            $join->on('accommodation_units.unitID', '=', 'units.ID')
                 ->where('status', 'ongoing');
        })
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodations.id')
        ->leftJoin('services', 'services.id', 'accommodation_units.serviceID')
        ->select('units.id AS unitID', 'units.unitType', 'units.unitNumber', 'units.capacity', 'units.partOf',
                 'accommodation_units.status', 'accommodations.id AS accommodationID', 'accommodations.numberOfPax',
                 'accommodations.numberOfUnits', 'accommodation_units.checkinDatetime', 'accommodation_units.checkoutDatetime',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName', 'guests.contactNumber',
                 'services.id AS serviceID', 'services.serviceType', 'services.serviceName', 'services.price')
        ->where('units.id', '=', $unitID)
        ->get();

        $payments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->where('accommodationID', '=', $guest[0]->accommodationID)
        ->where('remarks', '=','full')
        ->get();

        $pendingPayments = DB::table('charges')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->where('accommodationID', '=', $guest[0]->accommodationID)
        ->where(function ($query) {
            $query->where('remarks', '=','unpaid')
                ->orWhere('remarks', '=','partial');
        })
        ->select('charges.id AS chargeID', 'charges.quantity', 'charges.totalPrice', 'charges.balance',
                 'charges.remarks','services.*', 'accommodations.*' )
        ->get();

        if($guest[0]->numberOfUnits > 1) {
            $otherUnits = DB::table('accommodation_units')
            ->join('units', 'units.id', 'accommodation_units.unitID')
            ->join('services', 'services.id', 'accommodation_units.serviceID')
            ->where('accommodation_units.accommodationID', '=', $guest[0]->accommodationID)
            ->get();

            return view('lodging.editdetails')->with('guest', $guest)->with('pendingPayments', $pendingPayments)->with('payments', $payments)->with('otherUnits', $otherUnits);
        } else {
            return view('lodging.editdetails')->with('guest', $guest)->with('pendingPayments', $pendingPayments)->with('payments', $payments);
        }  
    }

    //View Details backpacker

    /**
     * Show the accommodationDetails
     *
     * @return \Illuminate\Http\Response
     */
    public function viewBackpackerGuestDetails($unitID)
    {
        $guest = DB::table('units')
        ->leftJoin('accommodation_units', 'accommodation_units.unitID', 'units.id')
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodations.id')
        ->leftJoin('services', 'services.id', 'accommodation_units.serviceID')
        ->select('units.id AS unitID', 'units.unitType', 'units.unitNumber', 'units.capacity', 'units.partOf',
                 'accommodation_units.status', 'accommodations.id AS accommodationID', 'accommodations.numberOfPax',
                 'accommodations.numberOfUnits', 'accommodation_units.checkinDatetime', 'accommodation_units.checkoutDatetime',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName', 'guests.contactNumber',
                 'services.id AS serviceID', 'services.serviceType', 'services.serviceName', 'services.price')
        ->where('units.id', '=', $unitID)
        ->get();



        if($guest[0]->numberOfUnits > 1) {
            $otherUnits = DB::table('accommodation_units')
            ->join('units', 'units.id', 'accommodation_units.unitID')
            ->join('services', 'services.id', 'accommodation_units.serviceID')
            ->where('accommodation_units.accommodationID', '=', $guest[0]->accommodationID)
            ->get();

            return view('lodging.editdetails')->with('guest', $guest)->with('pendingPayments', $pendingPayments)->with('payments', $payments)->with('otherUnits', $otherUnits);
        } else {
            return view('lodging.editdetails')->with('guest', $guest)->with('pendingPayments', $pendingPayments)->with('payments', $payments);
        }  
    }

    /**
     * Show the check out form
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckoutForm($unitID)
    {
        $guest = DB::table('units')
        ->leftJoin('accommodation_units', function($join) {
            $join->on('accommodation_units.unitID', '=', 'units.ID')
                 ->where('status', 'ongoing');
        })
        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodations.id')
        ->leftJoin('services', 'services.id', 'accommodation_units.serviceID')
        ->select('units.id AS unitID', 'units.unitType', 'units.unitNumber', 'units.capacity', 'units.partOf',
                 'accommodation_units.status', 'accommodations.id AS accommodationID', 'accommodations.numberOfPax',
                 'accommodations.numberOfUnits', 'accommodation_units.checkinDatetime', 'accommodation_units.checkoutDatetime',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName', 'guests.contactNumber',
                 'services.id AS serviceID', 'services.serviceType', 'services.serviceName', 'services.price')
        ->where('units.id', '=', $unitID)
        ->get();

        $payments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->where('accommodationID', '=', $guest[0]->accommodationID)
        ->where('remarks', '=','full')
        ->get();

        $pendingPayments = DB::table('charges')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->where('accommodationID', '=', $guest[0]->accommodationID)
        ->where(function ($query) {
            $query->where('remarks', '=','unpaid')
                ->orWhere('remarks', '=','partial');
        })
        ->select('charges.id AS chargeID', 'charges.quantity', 'charges.totalPrice', 'charges.balance',
                 'charges.remarks','services.*', 'accommodations.*' )
        ->get();

        $dueToday = DB::table('accommodation_units')
        ->join('units', 'units.id', 'accommodation_units.unitID')
        ->whereDate('accommodation_units.checkoutDatetime', '=', Carbon::now())
        ->where('status', 'ongoing')
        ->where('units.id', '=', $unitID)
        ->get();

        //return $dueToday;
        if($guest[0]->numberOfUnits > 1) {
            $otherUnits = DB::table('accommodation_units')
            ->join('units', 'units.id', 'accommodation_units.unitID')
            ->join('services', 'services.id', 'accommodation_units.serviceID')
            ->where('accommodation_units.accommodationID', '=', $guest[0]->accommodationID)
            ->get();

            return view('lodging.checkout')->with('guest', $guest)->with('pendingPayments', $pendingPayments)->with('payments', $payments)->with('otherUnits', $otherUnits)->with('dueToday', $dueToday);
        } else {
            return view('lodging.checkout')->with('guest', $guest)->with('pendingPayments', $pendingPayments)->with('payments', $payments)->with('dueToday', $dueToday);
        }  
    }

    /**
     * Show the check out form
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckoutFormDueToday($unitID)
    {

        $guest = DB::table('units')
        ->leftJoin('accommodation_units', function($join) {
            $join->on('accommodation_units.unitID', '=', 'units.ID')
                 ->where('status', 'ongoing')
                 ->whereDate('accommodation_units.checkoutDatetime', '=', Carbon::now());
        })

        ->leftJoin('accommodations', 'accommodations.id', 'accommodation_units.accommodationID')
        ->leftJoin('guests', 'guests.accommodationID', 'accommodations.id')
        ->leftJoin('services', 'services.id', 'accommodation_units.serviceID')
        ->select('units.id AS unitID', 'units.unitType', 'units.unitNumber', 'units.capacity', 'units.partOf',
                 'accommodation_units.status', 'accommodations.id AS accommodationID', 'accommodations.numberOfPax',
                 'accommodations.numberOfUnits', 'accommodation_units.checkinDatetime', 'accommodation_units.checkoutDatetime',
                 'guests.id AS guestID', 'guests.lastName', 'guests.firstName', 'guests.contactNumber',
                 'services.id AS serviceID', 'services.serviceType', 'services.serviceName', 'services.price')
        ->where('units.id', '=', $unitID)
        ->get();

        $payments = DB::table('payments')
        ->join('charges', 'charges.id', 'payments.chargeID')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->where('accommodationID', '=', $guest[0]->accommodationID)
        ->where('remarks', '=','full')
        ->get();

        $pendingPayments = DB::table('charges')
        ->join('accommodations', 'accommodations.id', 'charges.accommodationID')
        ->join('services', 'services.id', 'charges.serviceID')
        ->where('accommodationID', '=', $guest[0]->accommodationID)
        ->where(function ($query) {
            $query->where('remarks', '=','unpaid')
                ->orWhere('remarks', '=','partial');
        })
        ->select('charges.id AS chargeID', 'charges.quantity', 'charges.totalPrice',
                 'charges.remarks','services.*', 'accommodations.*' )
        ->get();

        if($guest[0]->numberOfUnits > 1) {
            $otherUnits = DB::table('accommodation_units')
            ->join('units', 'units.id', 'accommodation_units.unitID')
            ->join('services', 'services.id', 'accommodation_units.serviceID')
            ->where('accommodation_units.accommodationID', '=', $guest[0]->accommodationID)
            ->whereDate('accommodation_units.checkoutDatetime', '=', Carbon::now())
            ->get();

            return view('lodging.checkoutDueToday')->with('guest', $guest)->with('pendingPayments', $pendingPayments)->with('payments', $payments)->with('otherUnits', $otherUnits);
        } else {
            return view('lodging.checkoutDueToday')->with('guest', $guest)->with('pendingPayments', $pendingPayments)->with('payments', $payments);
        } 
    }

    /**
     * Show view guests page
     *
     * @return \Illuminate\Http\Response
     */
    public function viewGuests()
    {
        $guest = DB::table('guests')
        ->join('accommodations', 'accommodations.id', 'guests.accommodationID')
        ->join('accommodation_units', 'accommodation_units.accommodationID', 'accommodations.id')
        ->join('services', 'services.id', 'accommodation_units.serviceID')
        ->join('units', 'units.id', 'accommodation_units.unitID')
        ->select('guests.id as guestID', 'guests.lastName', 'guests.firstName', 'guests.contactNumber', 
        'services.serviceName', 'accommodations.numberOfUnits', 'units.unitNumber', 'guests.accommodationID')
        ->where('accommodation_units.status', '=', 'ongoing')
        ->get();

        return view('lodging.viewguests')->with('guest', $guest);
    }
}

 