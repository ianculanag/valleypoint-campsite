<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Foods;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('foodCategory',['breakfast','appetizers','noodles','bread','rice bowls', 'group meals', 'soup']);
            $table->string('foodName');
            $table->double('price', 8, 2);
            //$table->foreign('productID')->references('id')->on('Products');
            $table->timestamps();
        });

            $food1 = new Foods;
            $food1->foodCategory = 'appetizers';
            $food1->foodName = 'Sizzling Sisig';
            $food1->price = '159.00';
            $food1->save();

            $food2 = new Foods;
            $food2->foodCategory = 'appetizers';
            $food2->foodName = 'Sizzling Tuna';
            $food2->price = '159.00';
            $food2->save();

            $food3 = new Foods;
            $food3->foodCategory = 'appetizers';
            $food3->foodName = 'Sizzling Tofu';
            $food3->price = '159.00';
            $food3->save();

            $food4 = new Foods;
            $food4->foodCategory = 'appetizers';
            $food4->foodName = 'Nachos';
            $food4->price = '149.00';
            $food4->save();

            $food5 = new Foods;
            $food5->foodCategory = 'appetizers';
            $food5->foodName = 'Dynamite';
            $food5->price = '159.00';
            $food5->save();

            $food6 = new Foods;
            $food6->foodCategory = 'appetizers';
            $food6->foodName = 'Lumpiang Shanghai';
            $food6->price = '159.00';
            $food6->save();

            $food7 = new Foods;
            $food7->foodCategory = 'appetizers';
            $food7->foodName = 'Besuto';
            $food7->price = '50.00';
            $food7->save();

            $food8 = new Foods;
            $food8->foodCategory = 'appetizers';
            $food8->foodName = 'Wings';
            $food8->price = '199.00';
            $food8->save();

            $food9 = new Foods;
            $food9->foodCategory = 'bread';
            $food9->foodName = 'Special Beef Burger';
            $food9->price = '159.00';
            $food9->save();

            $food10 = new Foods;
            $food10->foodCategory = 'bread';
            $food10->foodName = 'Egg Sandwich w/ Fries';
            $food10->price = '120.00';
            $food10->save();

            $food11 = new Foods;
            $food11->foodCategory = 'bread';
            $food11->foodName = 'Tuna Sandwich w/ Fries';
            $food11->price = '120.00';
            $food11->save();

            $food12 = new Foods;
            $food12->foodCategory = 'bread';
            $food12->foodName = 'Ham & Cheese Sandwich w/ Fries';
            $food12->price = '120.00';
            $food12->save();
            
            $food13 = new Foods;
            $food13->foodCategory = 'breakfast';
            $food13->foodName = 'Tapsilog';
            $food13->price = '99.00';
            $food13->save();

            $food14 = new Foods;
            $food14->foodCategory = 'breakfast';
            $food14->foodName = 'Tosilog';
            $food14->price = '99.00';
            $food14->save();

            $food15 = new Foods;
            $food15->foodCategory = 'breakfast';
            $food15->foodName = 'Lumpiasilog';
            $food15->price = '99.00';
            $food15->save();

            $food16 = new Foods;
            $food16->foodCategory = 'breakfast';
            $food16->foodName = 'Hotsilog';
            $food16->price = '99.00';
            $food16->save();

            $food17 = new Foods;
            $food17->foodCategory = 'breakfast';
            $food17->foodName = 'Cornsilog';
            $food17->price = '99.00';
            $food17->save();

            $food18 = new Foods;
            $food18->foodCategory = 'breakfast';
            $food18->foodName = 'Bangsilog';
            $food18->price = '99.00';
            $food18->save();

            $food19 = new Foods;
            $food19->foodCategory = 'breakfast';
            $food19->foodName = 'Porksilog';
            $food19->price = '99.00';
            $food19->save();

            $food20 = new Foods;
            $food20->foodCategory = 'breakfast';
            $food20->foodName = 'Spamsilog';
            $food20->price = '99.00';
            $food20->save();

            $food21 = new Foods;
            $food21->foodCategory = 'breakfast';
            $food21->foodName = 'Longsilog';
            $food21->price = '99.00';
            $food21->save();

            $food22 = new Foods;
            $food22->foodCategory = 'noodles';
            $food22->foodName = 'Carbonara';
            $food22->price = '129.00';
            $food22->save();

            $food23 = new Foods;
            $food23->foodCategory = 'noodles';
            $food23->foodName = 'Pesto';
            $food23->price = '129.00';
            $food23->save();

            $food24 = new Foods;
            $food24->foodCategory = 'noodles';
            $food24->foodName = 'Marinara';
            $food24->price = '129.00';
            $food24->save();

            $food25 = new Foods;
            $food25->foodCategory = 'noodles';
            $food25->foodName = 'Bihon';
            $food25->price = '119.00';
            $food25->save();

            $food26 = new Foods;
            $food26->foodCategory = 'noodles';
            $food26->foodName = 'Canton';
            $food26->price = '119.00';
            $food26->save();

            $food27 = new Foods;
            $food27->foodCategory = 'noodles';
            $food27->foodName = 'Bihon & Canton';
            $food27->price = '119.00';
            $food27->save();

            $food28 = new Foods;
            $food28->foodCategory = 'rice bowls';
            $food28->foodName = 'Special Fried Rice';
            $food28->price = '99.00';
            $food28->save();

            $food29 = new Foods;
            $food29->foodCategory = 'rice bowls';
            $food29->foodName = 'Lumpia Fried Rice';
            $food29->price = '129.00';
            $food29->save();

            $food30 = new Foods;
            $food30->foodCategory = 'rice bowls';
            $food30->foodName = 'Siomai Fried Rice';
            $food30->price = '129.00';
            $food30->save();

            $food31 = new Foods;
            $food31->foodCategory = 'rice bowls';
            $food31->foodName = 'Porkchop Fried Rice';
            $food31->price = '149.00';
            $food31->save();

            $food32 = new Foods;
            $food32->foodCategory = 'rice bowls';
            $food32->foodName = 'Chicken Fried Rice';
            $food32->price = '149.00';
            $food32->save();

            $food33 = new Foods;
            $food33->foodCategory = 'rice bowls';
            $food33->foodName = 'Fried Rice Silog Meal';
            $food33->price = '149.00';
            $food33->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
