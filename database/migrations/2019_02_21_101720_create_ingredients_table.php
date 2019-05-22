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
            $table->enum('ingredientCategory',['meatAndPoultry', 'produce', 'groceryAndDry']);
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
