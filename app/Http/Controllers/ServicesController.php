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

    /**
     * Show edit service form
     *
     * @return \Illuminate\Http\Response
     */
    public function viewServiceDetails($serviceID)
    {
        $services = DB::table('services')
        ->select('services.id AS serviceID', 'services.serviceType', 'services.serviceName', 'services.price', 'services.leanPrice', 'services.peakPrice')
        ->where('services.id', '=', $serviceID)
        ->get();
        
        return view('admin.editservice')->with('services', $services);
    }

    /**
     * Update service details
     *
     * @return \Illuminate\Http\Response
     */
    public function updateService(Request $request)
    {   
        $services = Services::find($request->input('serviceID'));
        $services->update([
            'serviceType' => $request->input('serviceType'),
            'serviceName' => $request->input('serviceName'),
            'price' => $request->input('price'),
            'leanPrice' => $request->input('leanPrice'),
            'peakPrice' => $request->input('peakPrice')
        ]);
        
        return redirect('/view-services');
    }
}
