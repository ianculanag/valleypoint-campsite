<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Shifts;
use Carbon\Carbon;
use DB;

class ProductsController extends Controller
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

    public function getProductItem($productID) {
        $productItem = DB::table('products')
        ->where('id', '=', $productID)
        ->get();

        return $productItem;
    }

    /**
     * Shift start dateTime
     * 
     */

    public function viewShiftStartPage(){
        return view('pos.shiftStart');
     }

     public function shiftStart(){
        $shift = new Shifts();
        $shift->ShiftStart=Carbon::now()->format('Y-m-d h:i:s');
        $shift->cashStart="500";
        $shift->save();

        return redirect('/create-order');
     }
    
    public function createOrder()
    {
        $products = DB::table('products')
        ->get();

        $categories = Products::getAllCategories();
        //sort($categories, SORT_STRING);

        //return $categories;
        
        return view ('pos.createorder')
        ->with('products', $products)
        ->with('categories', $categories);
    }

    public function viewMenu($productCategory){
        if($productCategory == 'allProducts') {        
            $products = DB::table('products')
            ->orderBy('productName')
            ->get();
        } else {            
            $products = DB::table('products')
            ->where('productCategory', '=', $productCategory)
            ->orderBy('productName')
            ->get();
        }
        return $products;
    }

    public function searchItem($searchQuery) {
        $products = Products::where('productName','LIKE',"%{$searchQuery}%")
        ->get();
        return $products;
    }

    /**
     * View menu
     *
     * @return \Illuminate\Http\Response
     */
    public function viewMenuItems() { 

        $products = DB::table('products')
        ->orderBy('productName')
        ->get();

        $categories = Products::getAllCategories();

        return view('admin.viewmenu')
        ->with('products', $products)
        ->with('categories', $categories);
    } 

    /**
     * View menu per category
     *
     * @return \Illuminate\Http\Response
     */
    public function viewMenuCategories($category) { 

        if($category == 'allProducts') {
            $products = DB::table('products')
            ->orderBy('productName')
            ->get();
        } else {
            $products = DB::table('products')
            ->where('productCategory', '=', $category)
            ->orderBy('productName')
            ->get();
        }

        return $products;
    } 
 
    /**
     * View recipe of a menu item
     *
     * @return \Illuminate\Http\Response
     */
    public function viewMenuItemRecipe($menuItem) { 
        $recipes = DB::table('recipes')
        ->join('ingredients', 'ingredients.id', 'recipes.ingredientID')
        ->join('products', 'products.id', 'recipes.productID')
        ->where('productID', '=', $menuItem)
        ->get();

        return $recipes;
    }

    /*public function viewAppetizers(){
        $food = DB::table('foods')
        ->where('foodCategory', '=', 'appetizers')
        ->get();

        return $food;
    }
    public function viewBreads(){
        $food = DB::table('foods')
        ->where('foodCategory', '=', 'bread')
        ->get();

        return $food; 
    }
    public function viewBreakfast(){
        $food = DB::table('foods')
        ->where('foodCategory', '=', 'breakfast')
        ->get();

        return $food;
    }
    public function viewGroupmeals(){
        $food = DB::table('foods')
        ->where('foodCategory', '=', 'group meals')
        ->get();

        return $food;
    }
    public function viewNoodles(){
        $food = DB::table('foods')
        ->where('foodCategory', '=', 'noodles')
        ->get();

        return $food;
    }
    public function viewRicebowl(){
        $food = DB::table('foods')
        ->where('foodCategory', '=', 'rice bowls')
        ->get();

        return $food;
    }
    public function viewSoup(){
        $food = DB::table('foods')
        ->where('foodCategory', '=', 'soup')
        ->get();

        return $food;
    }
    public function viewBeverages(){
        $food = DB::table('foods')
        ->where('foodCategory', '=', 'beverages')
        ->get();

        return $food;
    }*/

}

