<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\Items;
use App\Products;
use Carbon\Carbon;
use DB;

class OrdersController extends Controller
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

    /**
     *  Save orders from create order page
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response 
     */
    public function saveOrder(Request $request) {
        $numberOfOrders = $request->input('numberOfOrders');
        
        $order = new Orders;
        $order->queueNumber = $request->input('queueNumber');
        $order->tableNumber = $request->input('tableNumber');
        $order->status = 'ongoing'; //BRUTE FORCE
        $order->orderDatetime = Carbon::now();
        $order->shiftID = '1';
        $order->save();

        for($index = 1; $index <= $numberOfOrders; $index++) {
            $productID = 'productID'.$index;
            $quantity = 'quantity'.$index;
            $totalPrice = 'totalPrice'.$index;
            $paymentStatus = 'pending'; //BRUTE FORCE
            
            if($request->input($productID)) {
                $item = new Items;
                $item->orderID = $order->id;
                $item->productID = $request->input($productID);
                $item->quantity = $request->input($quantity);
                $item->totalPrice = $request->input($totalPrice);
                $item->paymentStatus = $paymentStatus;
                $item->save();
            } 
        }

        return redirect ('/create-order');
    }

    public function viewOrders(){
        $order = DB::table('orders')
        ->select('orders.ID as orderID ', 'orders.orderNumber', 'orders.paymentStatus', 'orders.orderDatetime')
        ->get();
        
        return view('pos.viewOrders')
        ->with ('orders', $order);
    }

    /**
     * Show custom restaurant report 
     *
     * @return \Illuminate\Http\Response
     */
    public function viewOrderSlips() {
        $orders = DB::table('orders')
        ->where('status', '=', 'ongoing')
        ->orderBy('orderDatetime', 'ASC')
        ->get();

        $orderItems = array();

        for($index = 0; $index < count($orders); $index++) {
            $items = DB::table('orders')
            ->join('items', 'items.orderID', 'orders.id')
            ->join('products', 'products.id', 'items.productID')
            ->where('orders.id', '=', $orders[$index]->id)
            ->get();

            array_push($orderItems, $items);
        }

        //return $orderItems;
        return view('pos.vieworderslips')->with('orders', $orders)->with('items', $orderItems);
    }
}
