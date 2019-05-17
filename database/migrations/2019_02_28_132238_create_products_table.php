<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Products;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('productCategory',['breakfast','appetizer','noodles','bread','ricebowl', 'groupmeal', 'soup', 'beverage']);
            $table->string('productName');
            $table->double('price', 8, 2);
            //$table->foreign('productID')->references('id')->on('Products');
            $table->timestamps();
        });

            $product1 = new Products;
            $product1->productCategory = 'appetizer';
            $product1->productName = 'Sizzling Sisig';
            $product1->price = '159.00';
            $product1->save();

            $product2 = new Products;
            $product2->productCategory = 'appetizer';
            $product2->productName = 'Sizzling Tuna';
            $product2->price = '159.00';
            $product2->save();

            $product3 = new Products;
            $product3->productCategory = 'appetizer';
            $product3->productName = 'Sizzling Tofu';
            $product3->price = '159.00';
            $product3->save();

            $product4 = new Products;
            $product4->productCategory = 'appetizer';
            $product4->productName = 'Nachos';
            $product4->price = '149.00';
            $product4->save();

            $product5 = new Products;
            $product5->productCategory = 'appetizer';
            $product5->productName = 'Dynamite';
            $product5->price = '159.00';
            $product5->save();

            $product6 = new Products;
            $product6->productCategory = 'appetizer';
            $product6->productName = 'Lumpiang Shanghai';
            $product6->price = '159.00';
            $product6->save();

            $product7 = new Products;
            $product7->productCategory = 'appetizer';
            $product7->productName = 'Besuto';
            $product7->price = '50.00';
            $product7->save();

            $product8 = new Products;
            $product8->productCategory = 'appetizer';
            $product8->productName = 'Wings';
            $product8->price = '199.00';
            $product8->save();

            $product9 = new Products;
            $product9->productCategory = 'bread';
            $product9->productName = 'Special Beef Burger';
            $product9->price = '159.00';
            $product9->save();

            $product10 = new Products;
            $product10->productCategory = 'bread';
            $product10->productName = 'Egg Sandwich w/ Fries';
            $product10->price = '120.00';
            $product10->save();

            $product11 = new Products;
            $product11->productCategory = 'bread';
            $product11->productName = 'Tuna Sandwich w/ Fries';
            $product11->price = '120.00';
            $product11->save();

            $product12 = new Products;
            $product12->productCategory = 'bread';
            $product12->productName = 'Ham & Cheese Sandwich w/ Fries';
            $product12->price = '120.00';
            $product12->save();
            
            $product13 = new Products;
            $product13->productCategory = 'breakfast';
            $product13->productName = 'Tapsilog';
            $product13->price = '99.00';
            $product13->save();

            $product14 = new Products;
            $product14->productCategory = 'breakfast';
            $product14->productName = 'Tosilog';
            $product14->price = '99.00';
            $product14->save();

            $product15 = new Products;
            $product15->productCategory = 'breakfast';
            $product15->productName = 'Lumpiasilog';
            $product15->price = '99.00';
            $product15->save();

            $product16 = new Products;
            $product16->productCategory = 'breakfast';
            $product16->productName = 'Hotsilog';
            $product16->price = '99.00';
            $product16->save();

            $product17 = new Products;
            $product17->productCategory = 'breakfast';
            $product17->productName = 'Cornsilog';
            $product17->price = '99.00';
            $product17->save();

            $product18 = new Products;
            $product18->productCategory = 'breakfast';
            $product18->productName = 'Bangsilog';
            $product18->price = '99.00';
            $product18->save();

            $product19 = new Products;
            $product19->productCategory = 'breakfast';
            $product19->productName = 'Porksilog';
            $product19->price = '99.00';
            $product19->save();

            $product20 = new Products;
            $product20->productCategory = 'breakfast';
            $product20->productName = 'Spamsilog';
            $product20->price = '99.00';
            $product20->save();

            $product21 = new Products;
            $product21->productCategory = 'breakfast';
            $product21->productName = 'Longsilog';
            $product21->price = '99.00';
            $product21->save();

            $product22 = new Products;
            $product22->productCategory = 'noodles';
            $product22->productName = 'Carbonara';
            $product22->price = '129.00';
            $product22->save();

            $product23 = new Products;
            $product23->productCategory = 'noodles';
            $product23->productName = 'Pesto';
            $product23->price = '129.00';
            $product23->save();

            $product24 = new Products;
            $product24->productCategory = 'noodles';
            $product24->productName = 'Marinara';
            $product24->price = '129.00';
            $product24->save();

            $product25 = new Products;
            $product25->productCategory = 'noodles';
            $product25->productName = 'Bihon';
            $product25->price = '119.00';
            $product25->save();

            $product26 = new Products;
            $product26->productCategory = 'noodles';
            $product26->productName = 'Canton';
            $product26->price = '119.00';
            $product26->save();

            $product27 = new Products;
            $product27->productCategory = 'noodles';
            $product27->productName = 'Bihon & Canton';
            $product27->price = '119.00';
            $product27->save();

            $product28 = new Products;
            $product28->productCategory = 'ricebowl';
            $product28->productName = 'Special Fried Rice';
            $product28->price = '99.00';
            $product28->save();

            $product29 = new Products;
            $product29->productCategory = 'ricebowl';
            $product29->productName = 'Lumpia Fried Rice';
            $product29->price = '129.00';
            $product29->save();

            $product30 = new Products;
            $product30->productCategory = 'ricebowl';
            $product30->productName = 'Siomai Fried Rice';
            $product30->price = '129.00';
            $product30->save();

            $product31 = new Products;
            $product31->productCategory = 'ricebowl';
            $product31->productName = 'Porkchop Fried Rice';
            $product31->price = '149.00';
            $product31->save();

            $product32 = new Products;
            $product32->productCategory = 'ricebowl';
            $product32->productName = 'Chicken Fried Rice';
            $product32->price = '149.00';
            $product32->save();

            $product33 = new Products;
            $product33->productCategory = 'ricebowl';
            $product33->productName = 'Fried Rice Silog Meal';
            $product33->price = '149.00';
            $product33->save();
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
