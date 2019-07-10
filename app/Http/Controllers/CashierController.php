<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shifts;
use App\Items;
use App\Products;
use App\Orders;
use App\Payments;
use Carbon\Carbon;
use DB;

class CashierController extends Controller
{
    //

    public function printCashierShiftReport(){

        $shifts = DB::table('items')
            ->leftJoin('orders', 'orders.id', 'items.orderID')
            ->leftJoin('products', 'products.id', 'items.productID')
            ->leftJoin('payments', 'payments.id', 'items.orderID')
            ->leftJoin('shifts', 'shifts.id', 'items.shiftID')
            ->select('items.orderID', 'products.productName',
            'items.quantity', 'products.price', 'items.totalPrice',
            'payments.amount as amount', 'payments.changeDue', 'payments.paymentDatetime',
            'shifts.shiftStart', 'shifts.shiftEnd', 'shifts.cashStart')
            ->whereDate('orders.orderDatetime', '=', Carbon::now()->format('Y-m-d'))
            ->get();
        
            return view('pos.printCashierShiftReport')->with('shifts', $shifts);

    }
    public function showCashierReport(){

        $shifts = DB::table('items')
            ->leftJoin('orders', 'orders.id', 'items.orderID')
            ->leftJoin('products', 'products.id', 'items.productID')
            ->leftJoin('payments', 'payments.id', 'items.orderID')
            ->leftJoin('shifts', 'shifts.id', 'items.shiftID')
            ->select('items.orderID', 'products.productName',
            'items.quantity', 'products.price', 'items.totalPrice',
            'payments.amount as amount', 'payments.changeDue', 'payments.paymentDatetime',
            'shifts.shiftStart', 'shifts.shiftEnd', 'shifts.cashStart')
            ->whereDate('orders.orderDatetime', '=', Carbon::now()->format('Y-m-d'))
            ->get();
        
            return view('pos.cashierShiftReport')->with('shifts', $shifts);
    }
    public function reloadShowCashierReport(){
        $display = Carbon::parse($request->input('cashiereportDate'))->format('Y-m-d');

        $shifts = DB::table('items')
            ->leftJoin('orders', 'orders.id', 'items.orderID')
            ->leftJoin('products', 'products.id', 'items.productID')
            ->leftJoin('payments', 'payments.id', 'itemS.orderID')
            ->leftJoin('shifts', 'shifts.id', 'items.shiftID')
            ->select('items.orderID','products.productName',
            'items.quantity as quantity', 'products.price', 'items.totalPrice',
            'payments.amount', 'payments.changeDue', 'payments.paymentDatetime', 
            'shifts.shiftStart', 'shifts.shiftEnd', 'shifts.cashStart')
            ->whereDate('orders.orderDatetime', '=', Carbon::now()->format('Y-m-d'))
            ->get();
        
            return view('pos.cashierShiftReport')->with('shifts', $shifts)->with('display', $display);
    }
    
}
