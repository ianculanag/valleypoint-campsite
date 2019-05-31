<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Orders;
use App\Items;
use App\Products;
use App\RestaurantTable;
use App\Inventory;
use App\Ingredients;
use App\Payments;
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
        $order->totalBill = $request->input('totalBill');
        $order->discountAmount = $request->input('discountAmount');
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
                
                //$this->updateInventory($request->input($productID), $request->input($quantity));
            } 
        }

        //toggle table status
        if(!($request->input('tableNumber')=='')) {
            $table = RestaurantTable::find($request->input('tableNumber'));
            $table->update([
                'status' => 'occupied'
            ]);
        }

        return redirect ('/create-order');
    }

    /**
     * Save additional orders
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response 
     */
    public function saveAdditionalOrder(Request $request) {
        
        //Update orders
        $order = Orders::find($request->input('orderID'));
        $order->update([
            'queueNumber' => $request->input('queueNumber'),
            'totalBill' => $request->input('totalBill'),
            'discountAmount' => $request->input('discountAmount')
        ]);

        //Clear existing items for update
        $existingItems = Items::where('orderID', $request->input('orderID'))->delete();

        $numberOfOrders = $request->input('numberOfOrders');

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
                
                //$this->updateInventory($request->input($productID), $request->input($quantity));
            } 
        }

        //toggle table status
        if(!($request->input('tableNumber')=='')) {
            $table = RestaurantTable::find($request->input('tableNumber'));
            $table->update([
                'status' => 'occupied'
            ]);
        }

        return redirect ('/view-tables');
    }

    /**
     *  Update inventory upon checkout
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response 
     */
    public function updateInventory($productID, $quantity) {
        $ingredients = DB::table('recipes')
        ->where('productID', '=', $productID)
        ->get();

        //return $ingredients;

        $inventoryToday = DB::table('inventories')
        ->where('date', '=', Carbon::now()->format('Y-m-d'))
        ->get();

        //return $inventoryToday;
        
        for($count = 0; $count < count($ingredients); $count++) {
            $itemExists = false;
            for($index = 0; $index < count($inventoryToday); $index++) {
                if($ingredients[$count]->ingredientID == $inventoryToday[$index]->ingredientID) {
                    $itemExists = true;
                    $oldQuantity  = $inventoryToday[$index]->quantity;
                    $existingInventoryEntryID = $inventoryToday[$index]->id;
                }
            }

            if($itemExists) {
                $newQuantity = $oldQuantity + $ingredients[$count]->quantity*$quantity;
                $inventoryEntry = Inventory::find($existingInventoryEntryID);
                $inventoryEntry->update([
                    'quantity' => $newQuantity
                ]);
            } else {                                    
                $inventoryEntry = new Inventory;
                $inventoryEntry->ingredientID = $ingredients[$count]->ingredientID;
                $inventoryEntry->quantity = $ingredients[$count]->quantity*$quantity;
                $inventoryEntry->date = Carbon::now()->format('Y-m--d');
                $inventoryEntry->save();
            }
        }
    }

    /**
     * Show orders
     *
     * @return \Illuminate\Http\Response
     */
    public function viewOrders(){
        $order = DB::table('orders')
        ->get();
        
        return view('pos.viewOrders')
        ->with ('orders', $order);
    }

    /**
     * Show current order slips 
     *
     * @return \Illuminate\Http\Response
     */
    public function viewOrderSlips() {
        $orders = DB::table('orders')
        ->where('status', '=', 'ongoing')
        ->orderBy('orderDatetime', 'DESC')
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

        //return $items;
        return view('pos.vieworderslips')->with('orders', $orders)->with('items', $orderItems);
    }

    /**
     * Show table order slip 
     *
     * @return \Illuminate\Http\Response
     */
    public function loadTableOrders($tableNumber) {
        $tableOrder = array();

        $order = DB::table('orders')
        ->where('status', '=', 'ongoing')
        ->where('tableNumber', '=', $tableNumber)
        ->get();

        $items = DB::table('orders')
        ->join('items', 'items.orderID', 'orders.id')
        ->join('products', 'products.id', 'items.productID')
        ->where('orders.id', '=', $order[0]->id)
        ->get();

        array_push($tableOrder, $order);
        array_push($tableOrder, $items);

        return $tableOrder;
    }

    /**
     * Show table details
     *
     * @return \Illuminate\Http\Response
     */
    public function loadTable($tableNumber) {
        $table = DB::table('restaurant_tables')
        ->where('id', '=', $tableNumber)
        ->get();

        return $table;
    }

    /**
     * Table View 
     *
     * @return \Illuminate\Http\Response
     */
    public function viewTables()
    {
        $tables = DB::table('restaurant_tables')
        ->leftJoin('orders', 'orders.tableNumber', 'restaurant_tables.id')
        ->select('restaurant_tables.*', 'orders.id AS orderID', 'orders.queueNumber',
                'orders.tableNumber AS orderTableNumber', 'orders.totalBill', 'orders.status AS orderStatus',
                'orders.orderDatetime', 'orders.shiftID')
        //->where('orders.status', '!=', 'finished')
        ->orderBy('id', 'ASC')
        ->get();

        //return $tables;

        $firstTable = DB::table('restaurant_tables')
        ->first();

        $items = DB::table('orders')
        ->join('items', 'items.orderID', 'orders.id')
        ->join('products', 'products.id', 'items.productID')
        ->where('status', '=', 'ongoing')
        ->where('tableNumber', '=', $firstTable->id)
        ->get();

        //return $items;

        if(count($items) > 0) {
            $orderQueueNumber = $items[0]->queueNumber;
            $totalBill = $items[0]->totalBill;

            return view('pos.tableview')->with('tables', $tables)->with('firstTable', $firstTable)
                ->with('items', $items)->with('orderQueueNumber', $orderQueueNumber)->with('totalBill', $totalBill);
        } else {
            return view('pos.tableview')->with('tables', $tables)->with('firstTable', $firstTable)
                ->with('items', $items);
        }
    }

    /**
     * Update table number
     *
     * @return \Illuminate\Http\Response
     */
    public function updateTableNumber($orderID, $tableNumber, $oldTableNumber) {
        $order = Orders::find($orderID);
        $order->update([
            'tableNumber' => $tableNumber
        ]);

        $table = RestaurantTable::find($tableNumber);
        $oldTable = RestaurantTable::find($oldTableNumber);

        if($table != $oldTable) {
            $table->update([
                'status' => 'occupied'
            ]);

            $oldTable->update([
                'status' => 'available'
            ]);
        }
    }

    /**
     * Add table number
     *
     * @return \Illuminate\Http\Response
     */
    public function addTableNumber($orderID, $tableNumber) {
        $order = Orders::find($orderID);
        $order->update([
            'tableNumber' => $tableNumber
        ]);

        $table = RestaurantTable::find($tableNumber);

        $table->update([
            'status' => 'occupied'
        ]);
    }
 
    /**
     * Update queue number
     *
     * @return \Illuminate\Http\Response
     */
    public function updateQueueNumber($orderID, $queueNumber, $oldQueueNumber) {
        $order = Orders::find($orderID);
        $order->update([
            'queueNumber' => $queueNumber
        ]);
    }

    /**
     * Reload table view on table number update
     *
     * @return \Illuminate\Http\Response
     */
    public function reloadTables()
    {
        $tables = DB::table('restaurant_tables')
        ->leftJoin('orders', 'orders.tableNumber', 'restaurant_tables.id')
        ->select('restaurant_tables.*', 'orders.id AS orderID', 'orders.queueNumber',
                'orders.tableNumber AS orderTableNumber', 'orders.totalBill', 'orders.status AS orderStatus',
                'orders.orderDatetime', 'orders.shiftID')
        ->orderBy('id', 'ASC')
        ->get();

        return $tables;
    }

    /**
     * Show order slip upon bill out
     * 
     * @return \Illuminate\Http\Response
     */
    public function showBilloutOrderSlip($orderID)
    {
        $order = Orders::find($orderID);

        $items = DB::table('orders')
        ->join('items', 'items.orderID', 'orders.id')
        ->join('products', 'products.id', 'items.productID')
        ->where('orders.id', '=', $orderID)
        ->get();

        return view('pos.checkoutBill')
        ->with('items', $items)
        ->with('order', $order);
    }
    
    /**
     * Add order in existing order
     * 
     * @return \Illuminate\Http\Response
     */
    public function addOrder($orderID)
    {
        $order = Orders::find($orderID);

        //return $order;

        $items = DB::table('orders')
        ->join('items', 'items.orderID', 'orders.id')
        ->join('products', 'products.id', 'items.productID')
        ->where('orders.id', '=', $orderID)
        ->get();

        //return $items;

        //ProductsController@createOrder
        $products = DB::table('products')
        ->get();

        $categories = Products::getAllCategories();

        return view('pos.createorder')
        ->with('order', $order)
        ->with('items', $items)
        ->with('products', $products)
        ->with('categories', $categories);
    }

    /**
     * End the order transaction
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response 
     */
    public function finishOrderTransaction(Request $request) {
        $order = Orders::find($request->input('orderID'));
        $order->update([
            'totalBill' => $request->input('totalBill'),
            'discountAmount' => $request->input('discountAmount'),
            'status' => 'finished'
        ]);

        $payment = new Payments;
        $payment->paymentDatetime = Carbon::now();
        $payment->amount = $request->input('tenderedAmount');
        $payment->changeDue = $request->input('changeDue');
        $payment->paymentStatus = 'full';
        $payment->orderID = $request->input('orderID');
        $payment->save();
        
        $numberOfOrders = $request->input('numberOfOrders');

        for($index = 1; $index <= $numberOfOrders; $index++) {
            $productID = 'productID'.$index;
            $quantity = 'quantity'.$index;
            $paymentStatus = 'paid';
            
            if($request->input($productID)) {
                $item = DB::table('items')
                ->where('orderID', '=', $request->input('orderID'))
                ->where('productID', '=', $request->input($productID))
                ->update(array('paymentStatus' => $paymentStatus));
                
                $this->updateInventory($request->input($productID), $request->input($quantity));
            } 
        }

        //toggle table status
        $table = RestaurantTable::find($order->tableNumber);
        $table->update([
            'status' => 'available'
        ]);

        return redirect('/view-tables');
    }
}
