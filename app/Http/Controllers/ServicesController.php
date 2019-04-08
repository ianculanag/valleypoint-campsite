<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use DB;

class ServicesController extends Controller
{
    //
    public function getPrices($serviceID)
    {
        return DB::table('services')
        ->where('id', '=', $serviceID)
        ->get();

        //return 'hello';
    }

    /**
     * Display all services
     *
     * @return \Illuminate\Http\Response
     */
    public function viewServices()
    {
        $services = DB::table('services')
        ->get();

        return view('admin.viewservices')->with('services', $services);
    }

    /**
     * Show the add service form
     *
     * @return \Illuminate\Http\Response
     */
    public function showAddServiceForm()
    {
        $services = DB::table('services')
        ->get(); 

        return view('admin.addservice')->with('services', $services);
    }

    /**
     * Add a service
     *
     * @return \Illuminate\Http\Response
     */
    public function addService(Request $request)
    {
        $this->validate($request, [
            'serviceType' => 'required',
            'serviceName' => 'required',
            'price' => 'required',
            'leanPrice' => 'required',
            'peakPrice' => 'required'
        ]);

        $service = new Services;
        $service->serviceType = $request->input('serviceType');
        $service->serviceName = $request->input('serviceName');
        $service->price = $request->input('price');
        $service->leanPrice = $request->input('leanPrice');
        $service->peakPrice = $request->input('peakPrice');
        $service->save(); 

        return redirect('/view-services');
    }
}
