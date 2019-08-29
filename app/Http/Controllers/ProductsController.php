<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;
use App\Ingredients;
use App\Shifts;
use App\User;
use Carbon\Carbon;
use Auth;
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
        $shift->cashStart="";
        $shift->cashierName=Auth::user()->name;
        $shift->save();

        return redirect('/cashStart');
     }

     public function shiftEnd(){
         $shiftEndCount = DB::table('shifts')
         ->where('id','>', '0')
         ->count();

        //  $shiftEnd = DB::table('shifts')
        //  ->where('id', $shiftEndCount)
        //  ->get();
        $shift = DB::table('shifts')
        ->where('id', $shiftEndCount)
        ->update(['shiftEnd' => Carbon::now()->format('Y-m-d h:i:s')]);
        //$shift->shiftEnd = Carbon::now()->format('Y-m-d h:i:s');
        return redirect('/logout');

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

    public function showAddMenuItemForm(){
        $item = DB::table('products')
        ->get(); 

        return view('admin.addmenuitem')->with('items', $item);
    }

    public function addNewMenuItem(Request $request){


        $this->validate($request, [
            'MenuName' => 'required',
            'category' => 'required',
            'price' => 'required',
            'priceGuest' => 'required',
            'ingredientName' => 'required',
            'ingredientCategory' => 'required',
        ]);

        $NewItem = new Products;
        $NewItem->productName = $request->input('MenuName');
        $NewItem->productCategory = $request->input('category');
        $NewItem->price = $request->input('price');
        $NewItem->guestPrice = $request->input('priceGuest');
        $NewItem->save();

        $NewItem = new Ingredients;
        $NewItem->ingredientName = $request->input('ingredientName');
        $NewItem->ingredientCategory = $request->input('ingredientCategory');
        $NewItem->save();

        return redirect('/view-menu-recipe');
    }


    public function viewMenuInfo($userId){
        $userInfo = DB::table('users')
        ->select('id','username', 'name', 'role', 'contactNumber', 'email')
        ->where('id', '=', $userId)
        ->get();
        return view('admin.editUser')->with('userInfo', $userInfo);
    }

    // public function updateRecipe(Request $request){
    //     $NewItem= DB::table('products')
    // //    ->where('id', $request->input('userID'))
    //     ->update(['MenuName' => $request->input('newMenuName'),
    //               'category' => $request->input('newCategory'),
    //               'price' => $request->input('newPrice'),
    //               'priceGuest' => $request->input('newPriceGuest'),

    //     return redirect('/view-')->with('updateMessage', 'User has been updated!');

    // }


    public function showAddCategoryForm(){
        $category = DB::table('products')
        ->get();

        return view('admin.addcategory')->with('category', $category);
    }
    
    public function addNewCategory(Request $request){

        $this->validate($request, [
           'category' => 'required',
        ]);

        $newCategory = new Products;
        $newCategory->productCategory = $request->input('category');
        $newCategory->save();

        return redirect('/view-menu-recipe');
    }

    public function deleteItem($productCount){
       // $product = $this->product->whereProductId($productId)->delete();
       $product = Products::where('id', $productCount)->delete();
        return redirect('/view-menu-recipe')->with('deleteMessage', ' Item has been deleted successfully');

    }



}

