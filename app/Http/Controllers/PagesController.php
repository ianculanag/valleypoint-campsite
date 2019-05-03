<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        //$title = 'Valleypoint Campsite Homepage';
        //return view('pages.index', compact('title')); 
        //return view('pages.index')->with('title', $title);
        return redirect('/glamping');
        
    }

    public function lodging(){
        $data = array(
            'title' => 'Lodging Monitoring',
            'services' => ['Make a Reservation','Check-in', 'Check-out']
        );
        return view('pages.lodging')->with($data);
    }

    public function pos(){
        return view('restaurant.pos'); 
    }

    /*
    public function addusers(){
        return view('admin.addusers');
    }
    */
}
