<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Arr;
use App\Guests;
use App\Accommodation;
use App\AccommodationUnits;
use App\Units;
use App\Services;
use App\Charges;
use App\Payments;
use Carbon\Carbon;
use Auth;

class AccommodationsController extends Controller
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
     * Show the check in form
     *
     * @return \Illuminate\Http\Response
     */
    public function showCheckinForm($unitID)
    {
        $unit = DB::table('units')
        ->where('id', '=', $unitID)
        ->get();
        return view('lodging.checkinGlamping')->with('unit', $unit);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkinGlamping(Request $request)
    {
        $this->validate($request, [
            'contactNumber' => 'required|min:11|max:11',
            'firstName' => 'required|max:30',
            'lastName' => 'required|max:30'
        ]);

        $accommodation = new Accommodation;    
        $unitNumbers = array_map('trim', explode(',', $request->input('unitNumber')));  //for the three for loops

        $accommodation->numberOfPax = $request->input('numberOfPaxGlamping');
        $accommodation->numberOfUnits = $request->input('numberOfUnits');
        $accommodation->userID = Auth::user()->id;
        $accommodation->save();

        $guest = new Guests;
        $guest->lastName = $request->input('lastName');
        $guest->firstName = $request->input('firstName');
        $guest->accommodationID = $accommodation->id;   
        $guest->contactNumber = $request->input('contactNumber');
        $guest->save(); 

        $chargesCount = 0;
        $chargesArray = array();

        for($count = 0; $count < $request->input('numberOfUnits'); $count++) { //for loop two
            
            $accommodationPackage = 'accommodationPackage'.$unitNumbers[$count];
            $checkinDate = 'checkinDate'.$unitNumbers[$count];
            $checkoutDate = 'checkoutDate'.$unitNumbers[$count];

            $totalPrice = 'totalPrice'.$unitNumbers[$count];

            $unit = DB::table('units')->where('unitNumber', '=', $unitNumbers[$count])->select('units.*')->get();

            $accommodationUnit = new AccommodationUnits;
            $accommodationUnit->accommodationID = $accommodation->id;
            $accommodationUnit->unitID = $unit[0]->id;
            $accommodationUnit->status = 'ongoing';
            $accommodationUnit->checkinDatetime = $request->input($checkinDate).' '.'14:00';
            $accommodationUnit->checkoutDatetime = $request->input($checkoutDate).' '.'12:00';
            $accommodationUnit->numberOfPax = $request->input($accommodationPackage);
            $accommodationUnit->serviceID =  $request->input($accommodationPackage);
            $accommodationUnit->save();

            $charges = new Charges;
            $charges->quantity = $request->input($accommodationPackage);
            $charges->totalPrice = $request->input($totalPrice);
            $charges->remarks = 'unpaid';
            $charges->accommodationID = $accommodation->id;
            $charges->serviceID = $request->input($accommodationPackage);
            $charges->save();
            $chargesCount++;
            array_push($chargesArray, $charges->id);
        }

        if($request->input('additionalServicesCount') > 0) {
            for($count = 1; $count <= $request->input('additionalServicesCount'); $count++) {
                $additionalServiceID = 'additionalServiceID'.$count;
                $additionalServiceNumberOfPax = 'additionalServiceNumberOfPax'.$count;
                $additionalTotalPrice = 'additionalServiceTotalPrice'.$count;
                if($request->input($additionalServiceID)) {
                    $charges = new Charges;                    
                    $charges->quantity = $request->input($additionalServiceNumberOfPax);
                    $charges->totalPrice = $request->input($additionalTotalPrice);
                    $charges->remarks = 'unpaid';
                    $charges->accommodationID = $accommodation->id;
                    $charges->serviceID = $request->input($additionalServiceID);
                    $charges->save();
                    $chargesCount++;
                    array_push($chargesArray, $charges->id);
                }
            }
        }

        for($count = 0; $count < $chargesCount; $count++) {
            $paymentEntry = 'payment'.$count;
            if($request->input($paymentEntry)) {
                $payment = new Payments;
                $payment->paymentDatetime = Carbon::now();
                $payment->amount = $request->input($paymentEntry);
                $payment->paymentStatus = 'full';
                $payment->chargeID = $chargesArray[$count];
                $payment->save();

                $charge = Charges::find($chargesArray[$count]);
                $charge->update([
                    'remarks' => 'full'
                ]);
            }
        }

        return redirect('/glamping');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkinBackpacker(Request $request)
    {
        $this->validate($request, [
            'contactNumber' => 'required|min:11|max:11',
            'checkinDate' => 'required', 'checkoutDate' => 'required',
        'firstName' => 'required|max:30', 'lastName' => 'required|max:30'
    ]);

        
    /*if(count($reservedAccommodations)>0){
        for($count=0;$count<count($reservedAccommodations);$count+1){
            if($request->input('checkinDate')<=$reservedAccommodations[$count]){
            //return redirect()->back()->withInput();    
            return("Nakapasok");
            }else{
                return("Error pre");
            }
        }
    }*/

        $BeforeAccommodations = DB::table('accommodations')
        ->select('accommodations.checkinDatetime')
        ->whereDate('accommodations.checkinDatetime', '<>', Carbon::now())
        ->get();
        $AfterAccommodations = DB::table('accommodations')
        ->select('accommodations.checkoutDatetime')
        ->whereDate('accommodations.checkinDatetime', '<>', Carbon::now())            
        ->get();

        /*if($request->input('checkinDate') >= $BeforeAccommodations && $request->input('checkinDate') <= $AfterAccommodations)
        {
            return("Hello");
        }else{
            return $BeforeAccommodations;

        if ($request->input('checkinDate') > $request->input('checkoutDate')){
            return redirect()->back()->withInput();
            
        }
*/
        
        //GAC
        $accommodation = new Accommodation;                 
        $accommodation->numberOfPax = $request->input('numberOfPax');
        $accommodation->checkinDatetime = $request->input('checkinDate').' '.$request->input('checkinTime');
        $accommodation->checkoutDatetime = $request->input('checkoutDate').' '.$request->input('checkoutTime'); 
        $accommodation->serviceID = 5;
        $accommodation->userID = Auth::user()->id;
        //$accommodation->unitID = $request->input('unitID');
        //$accommodation->paymentStatus = $request->input('paymentStatus');
        $accommodation->save();

        $guest = new Guests;
        $guest->lastName = $request->input('lastName');
        $guest->firstName = $request->input('firstName');
        $guest->accommodationID = $accommodation->id;   
        $guest->contactNumber = $request->input('contactNumber');
        $guest->save();

        if ($accommodation->numberOfPax > 1) {
            for ($count = 1; $count < $accommodation->numberOfPax; $count++) {
                $accompanyingGuest = new Guests;

                $lastName = 'lastName'.$count;
                $firstName = 'firstName'.$count;

                $accompanyingGuest->lastName = $request->input($lastName);
                $accompanyingGuest->firstName = $request->input($firstName);
                $accompanyingGuest->accommodationID = $accommodation->id;
                $accompanyingGuest->listedUnder = $guest->id;   
                $accompanyingGuest->save();
            }
        }

        $service = Services::find(5);
        
        $charge = new Charges;
        $charge->quantity = $request->input('numberOfPax');
        $charge->totalPrice = $charge->quantity*$service->price;
        $charge->remarks = $request->input('paymentStatus');
        $charge->accommodationID = $accommodation->id;
        $charge->serviceID = $service->id;
        $charge->save();

        if($request->input('paymentStatus') != 'unpaid') {
            $payment = new Payments;
            $payment->paymentDatetime = Carbon::now();
            $payment->amount = $request->input('amountPaid');
            $payment->paymentStatus = $request->input('paymentStatus');
            $payment->chargeID = $charge->id;
            $payment->save();
        }

        $accommodationUnit = new AccommodationUnits;
        $accommodationUnit->accommodationID = $accommodation->id;
        $accommodationUnit->unitID = $request->input('unitID');
        $accommodationUnit->status = 'ongoing';
        $accommodationUnit->save();

        return redirect('/transient-backpacker');

    }



    /**
     *  Add reservation guests
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response 
     */

    public function addReservation(Request $request)
    {

        $accommodation = new Accommodation;
        $accommodation->serviceID = '6';
        $accommodation->paymentStatus = 'pending';
        $accommodation->userID = Auth::user()->id;
        $accommodation->unitID = $request->input('unitID');
        $accommodation->checkinDatetime = $request->input('checkinDate').' '.$request->input('checkinTime');
        $accommodation->checkoutDatetime = $request->input('checkoutDate').' '.$request->input('checkoutTime');
        $accommodation->numberOfPax = $request->input('numberOfPax'); 
        $accommodation->save();

        $guest = new Guests;
        $guest->accommodationID = $accommodation->id;
        $guest->lastname = $request->input('lastName');
        $guest->firstname = $request->input('firstName');
        $guest->contactNumber = $request->input('contactNumber');
        $guest->save();

        return redirect ('/glamping');
    }

        /**
     * Display all reservations.
     * 
     * @return \Illuminate\Http\Response
     */
    public function viewReservation()
    {
        $reserve = DB::table('guests')
        ->leftJoin('accommodations', 'accommodations.id', 'guests.accommodationID')
        ->leftJoin('units', 'units.id', 'accommodations.unitID')
        ->leftJoin('services', 'services.id', 'accommodations.serviceID')
        ->select('units.id as unitID', 'accommodations.id as accommodationID', 'guests.id as guestID',
        'services.id as serviceID', 'units.unitNumber', 'units.unitType', 'units.partOf', 'units.capacity',
        'guests.accommodationID', 'guests.lastName', 'guests.firstName', 'guests.listedUnder', 
        'guests.contactNumber','accommodations.unitID', 'accommodations.serviceID', 
        'accommodations.numberOfPax', 'accommodations.paymentStatus', 'accommodations.checkinDatetime',
        'accommodations.checkoutDatetime', 'services.serviceName', 'services.price')
        ->get();
        return view('lodging.viewreserve')->with('reserve', $reserve);
        //return $reserve;

    }
    /**
    * Show the check in backpacker form
    *
    * @return \Illuminate\Http\Response
    */
    public function showCheckinBackpackerForm($unitID)
    {
        $unit = DB::table('units')
        ->where('id', '=', $unitID)
        ->get();
        return view('lodging.checkinBackpacker')->with('unit', $unit);     
        
    }

    /**
     * Show add Reservation form
     * 
     * @return \Illuminate\Http\Response
     */
    public function showAddReserveForm($unitID)
    {
        return view ('lodging.addreserve')->with('unitID', $unitID);
    }

    /**
     * Checkout glamping guests
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkoutGlamping(Request $request)
    {

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
        
        $url = '/checkout'.'/'.$request->input('unitID');
        return redirect($url);
    }

}