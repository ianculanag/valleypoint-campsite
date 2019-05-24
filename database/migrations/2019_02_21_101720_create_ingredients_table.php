<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Ingredients;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('ingredientCategory',['meatAndPoultry', 'produce', 'groceryAndDry', 'beerAndLiquor']);
            $table->string('ingredientName');
            $table->timestamps();
        });

    $ingredient1 = new Ingredients;
    $ingredient1->ingredientCategory = 'meatAndPoultry';
    $ingredient1->ingredientName = 'Pork Liempo';
    $ingredient1->save();

    $ingredient2 = new Ingredients;
    $ingredient2->ingredientCategory = 'meatAndPoultry';
    $ingredient2->ingredientName = 'Chicken Legs';
    $ingredient2->save();

    $ingredient3 = new Ingredients;
    $ingredient3->ingredientCategory = 'meatAndPoultry';
    $ingredient3->ingredientName = 'Chicken Wings';
    $ingredient3->save();

    $ingredient4 = new Ingredients;
    $ingredient4->ingredientCategory = 'meatAndPoultry';
    $ingredient4->ingredientName = 'Ground Beef';
    $ingredient4->save();

    $ingredient5 = new Ingredients;
    $ingredient5->ingredientCategory = 'meatAndPoultry';
    $ingredient5->ingredientName = 'Dried Beef';
    $ingredient5->save();

    $ingredient6 = new Ingredients;
    $ingredient6->ingredientCategory = 'meatAndPoultry';
    $ingredient6->ingredientName = 'Tofu';
    $ingredient6->save();
    
    $ingredient7 = new Ingredients;
    $ingredient7->ingredientCategory = 'meatAndPoultry';
    $ingredient7->ingredientName = 'Tuna Flakes';
    $ingredient7->save();

    $ingredient8 = new Ingredients;
    $ingredient8->ingredientCategory = 'meatAndPoultry';
    $ingredient8->ingredientName = 'Boneless Bangus';
    $ingredient8->save();

    $ingredient9 = new Ingredients;
    $ingredient9->ingredientCategory = 'meatAndPoultry';
    $ingredient9->ingredientName = 'Bangus';
    $ingredient9->save();

    $ingredient10 = new Ingredients;
    $ingredient10->ingredientCategory = 'meatAndPoultry';
    $ingredient10->ingredientName = 'Lechon Kawali';
    $ingredient10->save();

    $ingredient11 = new Ingredients;
    $ingredient11->ingredientCategory = 'produce';
    $ingredient11->ingredientName = 'Potato';
    $ingredient11->save();

    $ingredient12 = new Ingredients;
    $ingredient12->ingredientCategory = 'produce';
    $ingredient12->ingredientName = 'Cabbage';
    $ingredient12->save();

    $ingredient13 = new Ingredients;
    $ingredient13->ingredientCategory = 'produce';
    $ingredient13->ingredientName = 'Long beans';
    $ingredient13->save();

    $ingredient14 = new Ingredients;
    $ingredient14->ingredientCategory = 'produce';
    $ingredient14->ingredientName = 'Eggplant';
    $ingredient14->save();

    $ingredient15 = new Ingredients;
    $ingredient15->ingredientCategory = 'produce';
    $ingredient15->ingredientName = 'Okra';
    $ingredient15->save();

    $ingredient16 = new Ingredients;
    $ingredient16->ingredientCategory = 'produce';
    $ingredient16->ingredientName = 'Bittermelon';
    $ingredient16->save();

    $ingredient17 = new Ingredients;
    $ingredient17->ingredientCategory = 'produce';
    $ingredient17->ingredientName = 'Cucumber';
    $ingredient17->save();

    $ingredient18 = new Ingredients;
    $ingredient18->ingredientCategory = 'produce';
    $ingredient18->ingredientName = 'Tomato';
    $ingredient18->save();

    $ingredient19 = new Ingredients;
    $ingredient19->ingredientCategory = 'produce';
    $ingredient19->ingredientName = 'Chili Pepper';
    $ingredient19->save();

    $ingredient20 = new Ingredients;
    $ingredient20->ingredientCategory = 'produce';
    $ingredient20->ingredientName = 'Long Chili';
    $ingredient20->save();

    $ingredient21 = new Ingredients;
    $ingredient21->ingredientCategory = 'produce';
    $ingredient21->ingredientName = 'Mixed Veggie';
    $ingredient21->save();

    $ingredient22 = new Ingredients;
    $ingredient22->ingredientCategory = 'produce';
    $ingredient22->ingredientName = 'Strawberry';
    $ingredient22->save();   
    
    $ingredient23 = new Ingredients;
    $ingredient23->ingredientCategory = 'produce';
    $ingredient23->ingredientName = 'Banana';
    $ingredient23->save();

    $ingredient24 = new Ingredients;
    $ingredient24->ingredientCategory = 'produce';
    $ingredient24->ingredientName = 'Mango';
    $ingredient24->save();

    $ingredient25 = new Ingredients;
    $ingredient25->ingredientCategory = 'groceryAndDry';
    $ingredient25->ingredientName = 'Sausage';
    $ingredient25->save();

    $ingredient26 = new Ingredients;
    $ingredient26->ingredientCategory = 'groceryAndDry';
    $ingredient26->ingredientName = 'Egg';
    $ingredient26->save();

    $ingredient27 = new Ingredients;
    $ingredient27->ingredientCategory = 'groceryAndDry';
    $ingredient27->ingredientName = 'Spam';
    $ingredient27->save();

    $ingredient28 = new Ingredients;
    $ingredient28->ingredientCategory = 'groceryAndDry';
    $ingredient28->ingredientName = 'Lumpiang Shanghai';
    $ingredient28->save();

    $ingredient29 = new Ingredients;
    $ingredient29->ingredientCategory = 'groceryAndDry';
    $ingredient29->ingredientName = 'Pork Sisig';
    $ingredient29->save();

    $ingredient30 = new Ingredients;
    $ingredient30->ingredientCategory = 'groceryAndDry';
    $ingredient30->ingredientName = 'Prawn Crackers';
    $ingredient30->save();

    $ingredient31 = new Ingredients;
    $ingredient31->ingredientCategory = 'groceryAndDry';
    $ingredient31->ingredientName = 'Tortilla Chips';
    $ingredient31->save();

    $ingredient32 = new Ingredients;
    $ingredient32->ingredientCategory = 'groceryAndDry';
    $ingredient32->ingredientName = 'Bread';
    $ingredient32->save();

    $ingredient33 = new Ingredients;
    $ingredient33->ingredientCategory = 'groceryAndDry';
    $ingredient33->ingredientName = 'Ham & Cheese';
    $ingredient33->save();

    $ingredient34 = new Ingredients;
    $ingredient34->ingredientCategory = 'groceryAndDry';
    $ingredient34->ingredientName = 'Pasta';
    $ingredient34->save();

    $ingredient35 = new Ingredients;
    $ingredient35->ingredientCategory = 'groceryAndDry';
    $ingredient35->ingredientName = 'Kikiam';
    $ingredient35->save();

    $ingredient36 = new Ingredients;
    $ingredient36->ingredientCategory = 'groceryAndDry';
    $ingredient36->ingredientName = 'Tea Bag';
    $ingredient36->save();

    $ingredient37 = new Ingredients;
    $ingredient37->ingredientCategory = 'groceryAndDry';
    $ingredient37->ingredientName = 'Coke Products';
    $ingredient37->save();

    $ingredient38 = new Ingredients;
    $ingredient38->ingredientCategory = 'beerAndLiquor';
    $ingredient38->ingredientName = 'San Mig Light';
    $ingredient38->save();

    $ingredient39 = new Ingredients;
    $ingredient39->ingredientCategory = 'beerAndLiquor';
    $ingredient39->ingredientName = 'San Mig Apple';
    $ingredient39->save();

    $ingredient40 = new Ingredients;
    $ingredient40->ingredientCategory = 'beerAndLiquor';
    $ingredient40->ingredientName = 'Red Horse';
    $ingredient40->save();

    $ingredient41 = new Ingredients;
    $ingredient41->ingredientCategory = 'beerAndLiquor';
    $ingredient41->ingredientName = 'Pale Pilsen';
    $ingredient41->save();
    
    $ingredient42 = new Ingredients;
    $ingredient42->ingredientCategory = 'beerAndLiquor';
    $ingredient42->ingredientName = 'Brew Kettle';
    $ingredient42->save();

    $ingredient43 = new Ingredients;
    $ingredient43->ingredientCategory = 'beerAndLiquor';
    $ingredient43->ingredientName = 'Smirnoff Mule';
    $ingredient43->save();

    $ingredient44 = new Ingredients;
    $ingredient44->ingredientCategory = 'beerAndLiquor';
    $ingredient44->ingredientName = 'Heineken';
    $ingredient44->save();
    
    $ingredient45 = new Ingredients;
    $ingredient45->ingredientCategory = 'beerAndLiquor';
    $ingredient45->ingredientName = 'Ginebra San Miguel';
    $ingredient45->save();

    $ingredient46 = new Ingredients;
    $ingredient46->ingredientCategory = 'beerAndLiquor';
    $ingredient46->ingredientName = 'Jinro';
    $ingredient46->save();
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
