<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Ingredients;
use DB;

class InventoryController extends Controller
{
    /**
     * View inventory
     *
     * @return \Illuminate\Http\Response
     */
    public function viewInventory() {

        $ingredients = DB::table('inventories')
        ->join('ingredients', 'ingredients.id', 'inventories.ingredientID')
        ->get();

        return view('pos.viewinventory')->with('ingredients', $ingredients);
    }
}
