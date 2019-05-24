<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * View inventory
     *
     * @return \Illuminate\Http\Response
     */
    public function viewInventory() {

        return view('pos.viewinventory');
    }
}
