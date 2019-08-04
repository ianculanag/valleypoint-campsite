@extends('layouts.app')

@section('content')
    <div class="container pb-5">
        <div class="pt-3 pb-3 text-center">
            <a href="{{ URL::previous() }}">
                <span style="float:left;">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    <strong>Back</strong>
                </span>
            </a>
        </div>        
        <form method="POST" action="/ingredient-added">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                   

            <div class="col-md-6 offset-md-3">
                <div class="card col-md-10 offset-md-1 py-4 ">
                    <div class="card-body">
                        <div class="pb-3 text-center">
                            <h3>Add Ingredient</h3>
                        </div>
                        <div class="form-group">
                            <input type="text" required="required" class="form-control" name="ingredientName" placeholder="Name" maxlength=25>
                        </div>
                        <div class="form-group pb-3">
                            <select class="custom-select d-block w-100" id="state" required="required" name="ingredientCategory" placeholder="Category">
                                <option value="meatAndPoultry">Meat and Poultry</option>
                                <option value="produce">Produce</option>
                                <option value="groceryAndDry">Grocery and Dry</option>
                                <option value="beerAndLiquor">Beer and Liquor</option>
                            </select>
                        </div>
                       
                        <button type="submit" class="btn btn-block btn-success mt-4">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection