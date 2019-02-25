<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $title = 'Valleypoint Campsite Homepage';
        //return view('pages.index', compact('title')); 
        return view('pages.index')->with('title', $title);
    }

    public function lodging(){
        $data = array(
            'title' => 'Lodging Monitoring',
            'services' => ['Make a Reservation','Check-in', 'Check-out']
        );
        return view('pages.lodging')->with($data);
    }

    public function pos(){
        return view('pages.pos'); 
    }

    /*
    public function addusers(){
        return view('admin.addusers');
    }
    */
}
