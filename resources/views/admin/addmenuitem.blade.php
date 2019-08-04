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
        <form method="POST" action="/menu-item-added">
            @csrf
            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">                   

            <div class="col-md-6 offset-md-3">
                <div class="card col-md-12 offset-md-1 py-4 ">
                    <div class="card-body">
                        <div class="pb-3 text-center">
                            <h3>Add Menu Item</h3>
                        </div>
                        <div class="form-group">
                            <input type="text" required="required" class="form-control" name="MenuName" placeholder="Name" maxlength=25>
                        </div>
                        <div class="form-group pb-3">
                            <select class="custom-select d-block w-100" id="state" required="required" name="category" placeholder="Category">
                                <option value="appetizers">Appetizers</option>
                                <option value="bread">Bread</option>
                                <option value="breakfast">Breakfast</option>
                                <option value="groupMeals">Group Meals</option>
                                <option value="noodles">Noodles</option>
                                <option value="riceBowls">Rice Bowls</option>
                                <option value="soups">Soups</option>
                                <option value="specialRiceMeals">Special Rice Meals</option>
                                <option value="Extras">Extras</option>
                                <option value="Beverages">Beverages</option>
                                <option value="Liquors">Liquors</option>
                            </select>
                        </div>

                        <div class="form-group row">
                        <div class="col-md-5 mb-1">
                        <p>Ingredient Name</p>
                                 <select class="custom-select d-block w-100" id="state" required="required" name="ingredientName" placeholder="Ingredient Name">
                                <option value="bangus">Bangus</option>
                                <option value="bonelessBangus">Boneless Bangus</option>
                                <option value="chickenLegs">Chicken Legs</option>
                                <option value="chickenWings">Chicken Wings</option>
                                <option value="groundBeef">Ground Beef</option>
                                <option value="lechonKawali">Lechon Kawali</option>
                                <option value="porkLiempo">Pork Liempo</option>
                                <option value="sukiyakiBeef">Sukiyaki Beef</option>
                                <option value="tofu">Tofu</option>
                                <option value="tunaFlakes">Tuna Flakes</option>
                                <option value="banana">Banana</option>
                                <option value="bittermelon">Bittermelon</option>
                                <option value="cabbage">Cabbage</option>
                                <option value="calamansi">Calamansi</option>
                                <option value="chiliPepper">Chili Pepper</option>
                                <option value="cucumber">Cucumber</option>
                                <option value="eggplant">Eggplant</option>
                                <option value="longBeans">Long beans</option>
                                <option value="longChili">Long Chili</option>
                                <option value="mango">Mango</option>
                                <option value="mixedVeggie">Mixed Veggie</option>
                                <option value="okra">Okra</option>
                                <option value="onion">Onion</option>
                                <option value="potato">Potato</option>
                                <option value="strawberry">Strawberry</option>
                                <option value="tomato">Tomato</option>
                                <option value="bacon">Bacon</option>
                                <option value="baguioBeans">Baguio Beans</option>
                                <option value="bananaBlossom">Banana Blossom</option>
                                <option value="bihonPasta">Bihon Pasta</option>
                                <option value="bread">Bread</option>
                                <option value="butter">Butter</option>
                                <option value="cantonPasta">Canton Pasta</option>
                                <option value="cheese">Cheese</option>
                                <option value="chocolateSyrup">Chocolate Syrup</option>
                                <option value="coffee">Coffee</option>
                                <option value="coke">Coke Products</option>
                                <option value="egg">Egg</option>
                                <option value="fries">Fries</option>
                                <option value="ham">Ham</option>
                                <option value="icedTea">Iced Tea</option>
                                <option value="kikiam">Kikiam</option>
                                <option value="lumpiangShanghai">Lumpiang Shanghai</option>
                                <option value="milk">Milk</option>
                                <option value="mushroom">Mushroom</option>
                                <option value="nachosChips">Nachos Chips</option>
                                <option value="pasta">Pasta</option>
                                <option value="peanutButter">Peanut Butter</option>
                                <option value="porkSisig">Pork Sisig</option>
                                <option value="prawnCrackers">Prawn Crackers</option>
                                <option value="radish">Radish</option>
                                <option value="sausage">Sausage</option>
                                <option value="sinigangMix">Sinigang Mix</option>
                                <option value="spam">Spam</option>
                                <option value="squash">Squash</option>
                                <option value="strawberrySyrup">Strawberry Syrup</option>
                                <option value="stringBeans">String beans</option>
                                <option value="teaBag">Tea Bag</option>
                                <option value="tocino">Tocino</option>
                            </select>
                        </div>

                        
                        <div class="col-md-6 mb-2">
                        <p>Ingredient Category</p>
                                 <select class="custom-select d-block w-100" id="state" required="required" name="ingredientCategory" placeholder="Category">
                                <option value="meatAndPoultry">Meat and Poultry</option>
                                <option value="produce">Produce</option>
                                <option value="groceryAndDry">Grocery and Dry</option>
                                <option value="beerAndLiquor">Beer and Liquor</option>
                            </select>
                          
                        </div>

                        <div class="form-group row" style="margin-top: 2.5em">
                        <div class="col-md-7 mb-2">
                            <button type="button" id="additionalServiceFormAdd" class="btn btn-primary additionalServiceFormAdd">
                                <span class="fa fa-plus" aria-hidden="true"></span>
                            </button>
                            </div>                       
                        </div>

                        <div class="form-group row" style="margin-left: .2em">
                            <div class="col-md-5 mb-2">
                            <input type="number" required="required" class="form-control" name="price" placeholder="Price" minlength=4 maxlength=25>
                        </div>
                        <div class="col-md-6 mb-2">
                            <input type="number" required="required" class="form-control" name="priceGuest" placeholder="Price Guest" minlength=4 maxlength=25>
                        </div>
                        </div>
                    
                        <button type="submit" class="btn btn-block btn-success mt-4">Add</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection