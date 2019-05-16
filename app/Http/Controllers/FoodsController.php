<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FoodsController extends Controller
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
    
    public function createOrder()
    {
        $food = DB::table('foods')
        ->select('foodCategory', 'foodName')
        ->get();
            
        return view ('pos.createorder')->with ('foods', $food);
    }

    public function viewAppetizers(){
        $food = DB::table('foods')
        ->select('foodCategory', 'foodName')
        ->where('foodCategory', '=', 'appetizers')
        ->get();

        return $food;
    }
    public function viewBreads(){
        $food = DB::table('foods')
        ->select('foodCategory', 'foodName')
        ->where('foodCategory', '=', 'bread')
        ->get();

        return $food; 
    }
    public function viewBreakfast(){
        $food = DB::table('foods')
        ->select('foodCategory', 'foodName')
        ->where('foodCategory', '=', 'breakfast')
        ->get();

        return $food;
    }
    public function viewGroupmeals(){
        $food = DB::table('foods')
        ->select('foodCategory', 'foodName')
        ->where('foodCategory', '=', 'group meals')
        ->get();

        return $food;
    }
    public function viewNoodles(){
        $food = DB::table('foods')
        ->select('foodCategory', 'foodName')
        ->where('foodCategory', '=', 'noodles')
        ->get();

        return $food;
    }
    public function viewRicebowl(){
        $food = DB::table('foods')
        ->select('foodCategory', 'foodName')
        ->where('foodCategory', '=', 'rice bowls')
        ->get();

        return $food;
    }
    public function viewSoup(){
        $food = DB::table('foods')
        ->select('foodCategory', 'foodName')
        ->where('foodCategory', '=', 'soup')
        ->get();

        return $food;
    }
    public function viewBeverages(){
        $food = DB::table('foods')
        ->select('foodCategory', 'foodName')
        ->where('foodCategory', '=', 'beverages')
        ->get();

        return $food;
    }

}

