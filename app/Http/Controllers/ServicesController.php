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
}
