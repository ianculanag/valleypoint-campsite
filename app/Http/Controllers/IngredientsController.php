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
        ->orderBy('ingredientName')
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
            ->orderBy('ingredientName')
            ->get();
        } else {
            $ingredients = DB::table('ingredients')
            ->where('ingredientCategory', '=', $category)
            ->orderBy('ingredientName')
            ->get();
        }

        return $ingredients;
    } 

    /**
     * Delete ingredient modal
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteIngredientModal($ingredientID)
    {   
        $ingredients = DB::table('ingredients')
        ->where('ingredients.id', '=', $ingredientID)
        ->get();

        return $ingredients;
    }

    public function showAddIngredientForm()
    {
        $ingredient = DB::table('ingredients')
        ->get();

        return view('admin.addingredient')->with('ingredient', $ingredient);
    }

    public function addNewIngredient(Request $request)
    {
        $this->validate($request,[
            'ingredientName' => 'required',
            'ingredientCategory' => 'required',
        ]);

        $newIngredient = new Ingredients;
        $newIngredient->ingredientName = $request->input('ingredientName');
        $newIngredient->ingredientCategory = $request->input('ingredientCategory');
        $newIngredient->save();

        return redirect('/view-ingredients');

    }
}
