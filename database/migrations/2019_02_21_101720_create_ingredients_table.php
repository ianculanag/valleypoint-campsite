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

    $ingredient28 = new Ingredients;
    $ingredient28->ingredientCategory = 'meatAndPoultry';
    $ingredient28->ingredientName = 'Dried Beef';
    $ingredient28->save();

    $ingredient5 = new Ingredients;
    $ingredient5->ingredientCategory = 'meatAndPoultry';
    $ingredient5->ingredientName = 'Tofu';
    $ingredient5->save();
    
    $ingredient6 = new Ingredients;
    $ingredient6->ingredientCategory = 'meatAndPoultry';
    $ingredient6->ingredientName = 'Tuna Flakes';
    $ingredient6->save();

    $ingredient7 = new Ingredients;
    $ingredient7->ingredientCategory = 'meatAndPoultry';
    $ingredient7->ingredientName = 'Boneless Bangus';
    $ingredient7->save();

    $ingredient8 = new Ingredients;
    $ingredient8->ingredientCategory = 'meatAndPoultry';
    $ingredient8->ingredientName = 'Bangus';
    $ingredient8->save();

    $ingredient32 = new Ingredients;
    $ingredient32->ingredientCategory = 'meatAndPoultry';
    $ingredient32->ingredientName = 'Lechon Kawali';
    $ingredient32->save();

    $ingredient9 = new Ingredients;
    $ingredient9->ingredientCategory = 'produce';
    $ingredient9->ingredientName = 'Potato';
    $ingredient9->save();

    $ingredient10 = new Ingredients;
    $ingredient10->ingredientCategory = 'produce';
    $ingredient10->ingredientName = 'Cabbage';
    $ingredient10->save();

    $ingredient11 = new Ingredients;
    $ingredient11->ingredientCategory = 'produce';
    $ingredient11->ingredientName = 'Long beans';
    $ingredient11->save();

    $ingredient12 = new Ingredients;
    $ingredient12->ingredientCategory = 'produce';
    $ingredient12->ingredientName = 'Eggplant';
    $ingredient12->save();

    $ingredient13 = new Ingredients;
    $ingredient13->ingredientCategory = 'produce';
    $ingredient13->ingredientName = 'Okra';
    $ingredient13->save();

    $ingredient14 = new Ingredients;
    $ingredient14->ingredientCategory = 'produce';
    $ingredient14->ingredientName = 'Bittermelon';
    $ingredient14->save();

    $ingredient15 = new Ingredients;
    $ingredient15->ingredientCategory = 'produce';
    $ingredient15->ingredientName = 'Cucumber';
    $ingredient15->save();

    $ingredient16 = new Ingredients;
    $ingredient16->ingredientCategory = 'produce';
    $ingredient16->ingredientName = 'Tomato';
    $ingredient16->save();

    $ingredient24 = new Ingredients;
    $ingredient24->ingredientCategory = 'produce';
    $ingredient24->ingredientName = 'Chili Pepper';
    $ingredient24->save();

    $ingredient25 = new Ingredients;
    $ingredient25->ingredientCategory = 'produce';
    $ingredient25->ingredientName = 'Long Chili';
    $ingredient25->save();

    $ingredient31 = new Ingredients;
    $ingredient31->ingredientCategory = 'produce';
    $ingredient31->ingredientName = 'Mixed Veggie';
    $ingredient31->save();

    $ingredient34 = new Ingredients;
    $ingredient34->ingredientCategory = 'produce';
    $ingredient34->ingredientName = 'Strawberry';
    $ingredient34->save();   
    
    $ingredient35 = new Ingredients;
    $ingredient35->ingredientCategory = 'produce';
    $ingredient35->ingredientName = 'Banana';
    $ingredient35->save();

    $ingredient36 = new Ingredients;
    $ingredient36->ingredientCategory = 'produce';
    $ingredient36->ingredientName = 'Mango';
    $ingredient36->save();

    $ingredient17 = new Ingredients;
    $ingredient17->ingredientCategory = 'groceryAndDry';
    $ingredient17->ingredientName = 'Sausage';
    $ingredient17->save();

    $ingredient18 = new Ingredients;
    $ingredient18->ingredientCategory = 'groceryAndDry';
    $ingredient18->ingredientName = 'Egg';
    $ingredient18->save();

    $ingredient19 = new Ingredients;
    $ingredient19->ingredientCategory = 'groceryAndDry';
    $ingredient19->ingredientName = 'Spam';
    $ingredient19->save();

    $ingredient20 = new Ingredients;
    $ingredient20->ingredientCategory = 'groceryAndDry';
    $ingredient20->ingredientName = 'Lumpiang Shanghai';
    $ingredient20->save();

    $ingredient21 = new Ingredients;
    $ingredient21->ingredientCategory = 'groceryAndDry';
    $ingredient21->ingredientName = 'Pork Sisig';
    $ingredient21->save();

    $ingredient22 = new Ingredients;
    $ingredient22->ingredientCategory = 'groceryAndDry';
    $ingredient22->ingredientName = 'Prawn Crackers';
    $ingredient22->save();

    $ingredient23 = new Ingredients;
    $ingredient23->ingredientCategory = 'groceryAndDry';
    $ingredient23->ingredientName = 'Tortilla Chips';
    $ingredient23->save();

    $ingredient26 = new Ingredients;
    $ingredient26->ingredientCategory = 'groceryAndDry';
    $ingredient26->ingredientName = 'Bread';
    $ingredient26->save();

    $ingredient27 = new Ingredients;
    $ingredient27->ingredientCategory = 'groceryAndDry';
    $ingredient27->ingredientName = 'Ham & Cheese';
    $ingredient27->save();

    $ingredient29 = new Ingredients;
    $ingredient29->ingredientCategory = 'groceryAndDry';
    $ingredient29->ingredientName = 'Pasta';
    $ingredient29->save();

    $ingredient30 = new Ingredients;
    $ingredient30->ingredientCategory = 'groceryAndDry';
    $ingredient30->ingredientName = 'Kikiam';
    $ingredient30->save();

    $ingredient38 = new Ingredients;
    $ingredient38->ingredientCategory = 'groceryAndDry';
    $ingredient38->ingredientName = 'Tea Bag';
    $ingredient38->save();

    $ingredient33 = new Ingredients;
    $ingredient33->ingredientCategory = 'groceryAndDry';
    $ingredient33->ingredientName = 'Coke Products';
    $ingredient33->save();

    $ingredient39 = new Ingredients;
    $ingredient39->ingredientCategory = 'beerAndLiquor';
    $ingredient39->ingredientName = 'San Mig Light';
    $ingredient39->save();

    $ingredient40 = new Ingredients;
    $ingredient40->ingredientCategory = 'beerAndLiquor';
    $ingredient40->ingredientName = 'San Mig Apple';
    $ingredient40->save();

    $ingredient41 = new Ingredients;
    $ingredient41->ingredientCategory = 'beerAndLiquor';
    $ingredient41->ingredientName = 'Red Horse';
    $ingredient41->save();

    $ingredient42 = new Ingredients;
    $ingredient42->ingredientCategory = 'beerAndLiquor';
    $ingredient42->ingredientName = 'Pale Pilsen';
    $ingredient42->save();
    
    $ingredient43 = new Ingredients;
    $ingredient43->ingredientCategory = 'beerAndLiquor';
    $ingredient43->ingredientName = 'Brew Kettle';
    $ingredient43->save();

    $ingredient44 = new Ingredients;
    $ingredient44->ingredientCategory = 'beerAndLiquor';
    $ingredient44->ingredientName = 'Smirnoff Mule';
    $ingredient44->save();

    $ingredient45 = new Ingredients;
    $ingredient45->ingredientCategory = 'beerAndLiquor';
    $ingredient45->ingredientName = 'Heineken';
    $ingredient45->save();
    
    $ingredient46 = new Ingredients;
    $ingredient46->ingredientCategory = 'beerAndLiquor';
    $ingredient46->ingredientName = 'Ginebra San Miguel';
    $ingredient46->save();

    $ingredient47 = new Ingredients;
    $ingredient47->ingredientCategory = 'beerAndLiquor';
    $ingredient47->ingredientName = 'Jinro';
    $ingredient47->save();



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
