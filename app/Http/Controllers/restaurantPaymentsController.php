<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class restaurantPaymentsController extends Controller
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
     * Show daily restaurant report 
     *
     * @return \Illuminate\Http\Response
     */
    public function todaysRestaurantReport() {
        return view('pos.dailyrestaurantreports');
    }

    /**
     * Show weekly restaurant report 
     *
     * @return \Illuminate\Http\Response
     */
    public function thisWeeksRestaurantReport() {
        return view('pos.weeklyrestaurantreports');
    }

    /**
     * Show monthly restaurant report 
     *
     * @return \Illuminate\Http\Response
     */
    public function thisMonthsRestaurantReport() {
        return view('pos.monthlyrestaurantreports');
    }

    /**
     * Show custom restaurant report 
     *
     * @return \Illuminate\Http\Response
     */
    public function customRestaurantReport() {
        return view('pos.customrestaurantreport');
    }

    public function viewRestaurantPayments(){
        $restaurantPayment = DB::table('payments')
        ->select('payments.ID as paymentID ', 'payments.paymentStatus', 'payments.amount','payments.paymentDatetime')
        ->get();
        
        return view('pos.viewRestaurantPayments')
        ->with ('payments', $restaurantPayment);
    }
}
