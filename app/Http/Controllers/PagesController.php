<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        if(Auth::user()->role == 'admin') {
            return redirect('/admin-dashboard');
        } elseif(Auth::user()->role == 'lodging') {
            return redirect('/glamping');
        } elseif(Auth::user()->role == 'cashier') {
            return redirect('/create-order');
        } else {
            return redirect('/logout'); 
        }
        
    }

    public function lodging(){
        $data = array(
            'title' => 'Lodging Monitoring',
            'services' => ['Make a Reservation','Check-in', 'Check-out']
        );
        return view('pages.lodging')->with($data);
    }


    /*
    public function addusers(){
        return view('admin.addusers');
    }
    */
}
