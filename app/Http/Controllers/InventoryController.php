<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Ingredients;
use Carbon\Carbon;
use DB;

class InventoryController extends Controller
{
    /**
     * View todays inventory
     *
     * @return \Illuminate\Http\Response
     */
    public function viewTodaysInventory($onDate) { 

        $thisDate = Carbon::parse($onDate);   

        $ingredients = DB::table('inventories')
        ->join('ingredients', 'ingredients.id', 'inventories.ingredientID')
        ->select('inventories.id', 'inventories.quantity','inventories.updated_at',
                 'ingredients.ingredientName', 'ingredients.ingredientCategory')
        ->whereDate('date', '=', $thisDate)
        ->get();

        $ingredientCategories = Ingredients::getAllCategories();

        return view('pos.viewinventory')->with('ingredients', $ingredients) ->with('ingredientCategories', $ingredientCategories);
    }

    /**
     * View inventory of all ingredient category
     *
     * @return \Illuminate\Http\Response
     */
    public function viewAllIngredientCategory() {

        $ingredients = DB::table('inventories')
        ->join('ingredients', 'ingredients.id', 'inventories.ingredientID')
        ->get();

        return $ingredients;
    }

    /**
     * View inventory by ingredient category
     *
     * @return \Illuminate\Http\Response
     */
    public function viewIngredientCategory($ingredientCategory) {

        $ingredients = DB::table('inventories')
        ->join('ingredients', 'ingredients.id', 'inventories.ingredientID')
        ->where('ingredientCategory', '=', $ingredientCategory)
        ->get();

        return $ingredients;
    }

    /**
     * Daily inventory for all categories
     *
     * @return \Illuminate\Http\Response
     */
    public function viewDailyInventory($onDate) { 

        $thisDate = Carbon::parse($onDate);   

        $ingredients = DB::table('inventories')
        ->join('ingredients', 'ingredients.id', 'inventories.ingredientID')
        ->select('inventories.id', 'inventories.quantity','inventories.updated_at',
                 'ingredients.ingredientName', 'ingredients.ingredientCategory')
        ->whereDate('date', '=', $thisDate)
        ->get();

        return $ingredients;
    }

    /**
     * Monthly inventory for all categories
     *
     * @return \Illuminate\Http\Response
     */
    public function viewMonthlyInventory($onMonth, $onYear) { 

        $monthString = '22-'.$onMonth.'-1999';
        $month = Carbon::parse($monthString)->format('m');

        $yearString = '22-12-'.$onYear;
        $year = Carbon::parse($yearString)->format('Y');

        $ingredients = DB::table('inventories')
        ->join('ingredients', 'ingredients.id', 'inventories.ingredientID')
        ->select('inventories.id', 'inventories.quantity','inventories.updated_at',
                 'ingredients.ingredientName', 'ingredients.ingredientCategory')
        ->whereMonth('date', '=', $month)
        ->whereYear('date', '=', $year)
        ->get();

        return $ingredients;
    }

    /**
     * Custom date range inventory for all categories
     *
     * @return \Illuminate\Http\Response
     */
    public function viewCustomInventory($fromDate, $toDate) { 

        $displayFrom = Carbon::parse($fromDate);  
        $displayTo = Carbon::parse($toDate);  

        $ingredients = DB::table('inventories')
        ->join('ingredients', 'ingredients.id', 'inventories.ingredientID')
        ->select('inventories.id', 'inventories.quantity','inventories.updated_at',
                 'ingredients.ingredientName', 'ingredients.ingredientCategory')
        ->whereDate('date', '>=', $displayFrom)
        ->whereDate('date', '<=', $displayTo)
        ->get();

        return $ingredients;
    }
}
