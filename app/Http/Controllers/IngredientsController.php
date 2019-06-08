<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ingredients;
use DB;

class IngredientsController extends Controller
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
     * View ingredients
     *
     * @return \Illuminate\Http\Response
     */
    public function viewIngredients() { 

        $ingredients = DB::table('ingredients')
        ->get();

        $ingredientCategories = Ingredients::getAllCategories();

        return view('admin.viewingredients')
        ->with('ingredients', $ingredients)
        ->with('ingredientCategories', $ingredientCategories);
    } 

    /**
     * View ingredient per category
     *
     * @return \Illuminate\Http\Response
     */
    public function viewIngredientCategories($category) { 

        if($category == 'allCategories') {
            $ingredients = DB::table('ingredients')
            ->get();
        } else {
            $ingredients = DB::table('ingredients')
            ->where('ingredientCategory', '=', $category)
            ->get();
        }

        return $ingredients;
    } 

}
