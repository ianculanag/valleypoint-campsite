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
    $ingredient5->ingredientName = 'Sukiyaki Beef';
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
    $ingredient25->ingredientCategory = 'produce';
    $ingredient25->ingredientName = 'Calamansi';
    $ingredient25->save();

    $ingredient26 = new Ingredients;
    $ingredient26->ingredientCategory = 'produce';
    $ingredient26->ingredientName = 'Onion';
    $ingredient26->save();

    $ingredient27 = new Ingredients;
    $ingredient27->ingredientCategory = 'groceryAndDry';
    $ingredient27->ingredientName = 'Sausage';
    $ingredient27->save();

    $ingredient28 = new Ingredients;
    $ingredient28->ingredientCategory = 'groceryAndDry';
    $ingredient28->ingredientName = 'Tocino';
    $ingredient28->save();

    $ingredient29 = new Ingredients;
    $ingredient29->ingredientCategory = 'groceryAndDry';
    $ingredient29->ingredientName = 'Bacon';
    $ingredient29->save();

    $ingredient30 = new Ingredients;
    $ingredient30->ingredientCategory = 'groceryAndDry';
    $ingredient30->ingredientName = 'Mushroom';
    $ingredient30->save();

    $ingredient31 = new Ingredients;
    $ingredient31->ingredientCategory = 'groceryAndDry';
    $ingredient31->ingredientName = 'String beans';
    $ingredient31->save();

    $ingredient32 = new Ingredients;
    $ingredient32->ingredientCategory = 'groceryAndDry';
    $ingredient32->ingredientName = 'Squash';
    $ingredient32->save();

    $ingredient33 = new Ingredients;
    $ingredient33->ingredientCategory = 'groceryAndDry';
    $ingredient33->ingredientName = 'Radish';
    $ingredient33->save();

    $ingredient34 = new Ingredients;
    $ingredient34->ingredientCategory = 'groceryAndDry';
    $ingredient34->ingredientName = 'Baguio Beans';
    $ingredient34->save();

    $ingredient35 = new Ingredients;
    $ingredient35->ingredientCategory = 'groceryAndDry';
    $ingredient35->ingredientName = 'Strawberry Syrup';
    $ingredient35->save();

    $ingredient36 = new Ingredients;
    $ingredient36->ingredientCategory = 'groceryAndDry';
    $ingredient36->ingredientName = 'Chocolate Syrup';
    $ingredient36->save();

    $ingredient37 = new Ingredients;
    $ingredient37->ingredientCategory = 'groceryAndDry';
    $ingredient37->ingredientName = 'Egg';
    $ingredient37->save();

    $ingredient38 = new Ingredients;
    $ingredient38->ingredientCategory = 'groceryAndDry';
    $ingredient38->ingredientName = 'Spam';
    $ingredient38->save();

    $ingredient39 = new Ingredients;
    $ingredient39->ingredientCategory = 'groceryAndDry';
    $ingredient39->ingredientName = 'Lumpiang Shanghai';
    $ingredient39->save();

    $ingredient40 = new Ingredients;
    $ingredient40->ingredientCategory = 'groceryAndDry';
    $ingredient40->ingredientName = 'Pork Sisig';
    $ingredient40->save();

    $ingredient41 = new Ingredients;
    $ingredient41->ingredientCategory = 'groceryAndDry';
    $ingredient41->ingredientName = 'Prawn Crackers';
    $ingredient41->save();

    $ingredient42 = new Ingredients;
    $ingredient42->ingredientCategory = 'groceryAndDry';
    $ingredient42->ingredientName = 'Nachos Chips';
    $ingredient42->save();

    $ingredient43 = new Ingredients;
    $ingredient43->ingredientCategory = 'groceryAndDry';
    $ingredient43->ingredientName = 'Bread';
    $ingredient43->save();

    $ingredient44 = new Ingredients;
    $ingredient44->ingredientCategory = 'groceryAndDry';
    $ingredient44->ingredientName = 'Ham';
    $ingredient44->save();

    $ingredient45 = new Ingredients;
    $ingredient45->ingredientCategory = 'groceryAndDry';
    $ingredient45->ingredientName = 'Pasta';
    $ingredient45->save();

    $ingredient46 = new Ingredients;
    $ingredient46->ingredientCategory = 'groceryAndDry';
    $ingredient46->ingredientName = 'Kikiam';
    $ingredient46->save();

    $ingredient47 = new Ingredients;
    $ingredient47->ingredientCategory = 'groceryAndDry';
    $ingredient47->ingredientName = 'Tea Bag';
    $ingredient47->save();

    $ingredient48 = new Ingredients;
    $ingredient48->ingredientCategory = 'groceryAndDry';
    $ingredient48->ingredientName = 'Coke Products';
    $ingredient48->save();

    $ingredient49 = new Ingredients;
    $ingredient49->ingredientCategory = 'groceryAndDry';
    $ingredient49->ingredientName = 'Butter';
    $ingredient49->save();

    $ingredient50 = new Ingredients;
    $ingredient50->ingredientCategory = 'groceryAndDry';
    $ingredient50->ingredientName = 'Fries';
    $ingredient50->save();

    $ingredient51 = new Ingredients;
    $ingredient51->ingredientCategory = 'groceryAndDry';
    $ingredient51->ingredientName = 'Cheese';
    $ingredient51->save();

    $ingredient52 = new Ingredients;
    $ingredient52->ingredientCategory = 'groceryAndDry';
    $ingredient52->ingredientName = 'Bihon Pasta';
    $ingredient52->save();

    $ingredient53 = new Ingredients;
    $ingredient53->ingredientCategory = 'groceryAndDry';
    $ingredient53->ingredientName = 'Canton Pasta';
    $ingredient53->save();

    $ingredient54 = new Ingredients;
    $ingredient54->ingredientCategory = 'groceryAndDry';
    $ingredient54->ingredientName = 'Banana Blossom';
    $ingredient54->save();

    $ingredient55 = new Ingredients;
    $ingredient55->ingredientCategory = 'groceryAndDry';
    $ingredient55->ingredientName = 'Peanut Butter';
    $ingredient55->save();

    $ingredient56 = new Ingredients;
    $ingredient56->ingredientCategory = 'groceryAndDry';
    $ingredient56->ingredientName = 'Sinigang Mix';
    $ingredient56->save();

    $ingredient73 = new Ingredients;
    $ingredient73->ingredientCategory = 'groceryAndDry';
    $ingredient73->ingredientName = 'Iced Tea';
    $ingredient73->save();

    $ingredient74 = new Ingredients;
    $ingredient74->ingredientCategory = 'groceryAndDry';
    $ingredient74->ingredientName = 'Coffee';
    $ingredient74->save();

    $ingredient75 = new Ingredients;
    $ingredient75->ingredientCategory = 'groceryAndDry';
    $ingredient75->ingredientName = 'Milk';
    $ingredient75->save();

    $ingredient57 = new Ingredients;
    $ingredient57->ingredientCategory = 'beerAndLiquor';
    $ingredient57->ingredientName = 'San Mig Light';
    $ingredient57->save();

    $ingredient58 = new Ingredients;
    $ingredient58->ingredientCategory = 'beerAndLiquor';
    $ingredient58->ingredientName = 'San Mig Apple';
    $ingredient58->save();

    $ingredient59 = new Ingredients;
    $ingredient59->ingredientCategory = 'beerAndLiquor';
    $ingredient59->ingredientName = 'Red Horse';
    $ingredient59->save();

    $ingredient60 = new Ingredients;
    $ingredient60->ingredientCategory = 'beerAndLiquor';
    $ingredient60->ingredientName = 'Pale Pilsen';
    $ingredient60->save();
    
    $ingredient61 = new Ingredients;
    $ingredient61->ingredientCategory = 'beerAndLiquor';
    $ingredient61->ingredientName = 'Brew Kettle';
    $ingredient61->save();

    $ingredient62 = new Ingredients;
    $ingredient62->ingredientCategory = 'beerAndLiquor';
    $ingredient62->ingredientName = 'Smirnoff Mule';
    $ingredient62->save();

    $ingredient63 = new Ingredients;
    $ingredient63->ingredientCategory = 'beerAndLiquor';
    $ingredient63->ingredientName = 'Heineken';
    $ingredient63->save();
    
    $ingredient64 = new Ingredients;
    $ingredient64->ingredientCategory = 'beerAndLiquor';
    $ingredient64->ingredientName = 'Ginebra San Miguel';
    $ingredient64->save();

    $ingredient65 = new Ingredients;
    $ingredient65->ingredientCategory = 'beerAndLiquor';
    $ingredient65->ingredientName = 'Jinro';
    $ingredient65->save();

    $ingredient66 = new Ingredients;
    $ingredient66->ingredientCategory = 'beerAndLiquor';
    $ingredient66->ingredientName = 'Fundador Lights';
    $ingredient66->save();

    $ingredient67 = new Ingredients;
    $ingredient67->ingredientCategory = 'beerAndLiquor';
    $ingredient67->ingredientName = 'Mojito Gold';
    $ingredient67->save();

    $ingredient68 = new Ingredients;
    $ingredient68->ingredientCategory = 'beerAndLiquor';
    $ingredient68->ingredientName = 'Mojito Silver';
    $ingredient68->save();

    $ingredient69 = new Ingredients;
    $ingredient69->ingredientCategory = 'beerAndLiquor';
    $ingredient69->ingredientName = 'Johnnie Walker (Double Black)';
    $ingredient69->save();

    $ingredient70 = new Ingredients;
    $ingredient70->ingredientCategory = 'beerAndLiquor';
    $ingredient70->ingredientName = 'Johnnie Walker (Black Label)';
    $ingredient70->save();

    $ingredient71 = new Ingredients;
    $ingredient71->ingredientCategory = 'beerAndLiquor';
    $ingredient71->ingredientName = 'Bacardi Gold';
    $ingredient71->save();

    $ingredient72 = new Ingredients;
    $ingredient72->ingredientCategory = 'beerAndLiquor';
    $ingredient72->ingredientName = 'Bacardi Silver';
    $ingredient72->save();





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
