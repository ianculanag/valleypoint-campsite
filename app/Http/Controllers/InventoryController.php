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
     * Reload daily inventory for all categories
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
}
