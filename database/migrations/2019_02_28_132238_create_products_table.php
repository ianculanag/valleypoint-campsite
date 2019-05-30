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
            $table->enum('productCategory',['appetizer','bread','breakfast','groupMeal','noodles','riceBowl', 'soup', 'specialRiceMeal','extra', 'beverage', 'liquor']);
            $table->string('productName');
            $table->double('price', 8, 2);
            $table->double('guestPrice', 8, 2);
            //$table->foreign('productID')->references('id')->on('Products');
            $table->timestamps();
        });

            $product1 = new Products;
            $product1->productCategory = 'appetizer';
            $product1->productName = 'Sizzling Pork Sisig';
            $product1->price = '220.00';
            $product1->guestPrice = '170.00';
            $product1->save();

            $product2 = new Products;
            $product2->productCategory = 'appetizer';
            $product2->productName = 'Sizzling Tuna';
            $product2->price = '220.00';
            $product2->guestPrice = '170.00';
            $product2->save();

            $product3 = new Products;
            $product3->productCategory = 'appetizer';
            $product3->productName = 'Sizzling Tofu';
            $product3->price = '220.00';
            $product3->guestPrice = '170.00';
            $product3->save();

            $product4 = new Products;
            $product4->productCategory = 'appetizer';
            $product4->productName = 'Nachos';
            $product4->price = '150.00';
            $product4->guestPrice = '150.00';
            $product4->save();

            $product5 = new Products;
            $product5->productCategory = 'appetizer';
            $product5->productName = 'Dynamite';
            $product5->price = '220.00';
            $product5->guestPrice = '170.00';
            $product5->save();

            $product6 = new Products;
            $product6->productCategory = 'appetizer';
            $product6->productName = 'Lumpiang Shanghai';
            $product6->price = '220.00';
            $product6->guestPrice = '170.00';
            $product6->save();

            $product7 = new Products;
            $product7->productCategory = 'appetizer';
            $product7->productName = 'Besuto';
            $product7->price = '50.00';
            $product7->guestPrice = '50.00';
            $product7->save();

            $product8 = new Products;
            $product8->productCategory = 'appetizer';
            $product8->productName = 'Wings';
            $product8->price = '260.00';
            $product8->guestPrice = '210.00';
            $product8->save();

            $product10 = new Products;
            $product10->productCategory = 'bread';
            $product10->productName = 'Egg Sandwich w/ Fries';
            $product10->price = '120.00';
            $product10->guestPrice = '120.00';
            $product10->save();

            $product11 = new Products;
            $product11->productCategory = 'bread';
            $product11->productName = 'Tuna Sandwich w/ Fries';
            $product11->price = '120.00';
            $product11->guestPrice = '120.00';
            $product11->save();

            $product12 = new Products;
            $product12->productCategory = 'bread';
            $product12->productName = 'Ham & Cheese Sandwich w/ Fries';
            $product12->price = '120.00';
            $product12->guestPrice = '120.00';
            $product12->save();
            
            $product13 = new Products;
            $product13->productCategory = 'breakfast';
            $product13->productName = 'Tapsilog';
            $product13->price = '175.00';
            $product13->guestPrice = '175.00';
            $product13->save();

            $product14 = new Products;
            $product14->productCategory = 'breakfast';
            $product14->productName = 'Tosilog';
            $product14->price = '175.00';
            $product14->guestPrice = '175.00';
            $product14->save();

            $product18 = new Products;
            $product18->productCategory = 'breakfast';
            $product18->productName = 'Bangsilog';
            $product18->price = '175.00';
            $product18->guestPrice = '175.00';
            $product18->save();

            $product19 = new Products;
            $product19->productCategory = 'breakfast';
            $product19->productName = 'Porksilog';
            $product19->price = '175.00';
            $product19->guestPrice = '175.00';
            $product19->save();

            $product20 = new Products;
            $product20->productCategory = 'breakfast';
            $product20->productName = 'Spamsilog';
            $product20->price = '175.00';
            $product20->guestPrice = '175.00';
            $product20->save();

            $product21 = new Products;
            $product21->productCategory = 'breakfast';
            $product21->productName = 'Longsilog';
            $product21->price = '175.00';
            $product21->guestPrice = '175.00';
            $product21->save();

            $product22 = new Products;
            $product22->productCategory = 'noodles';
            $product22->productName = 'Carbonara';
            $product22->price = '180.00';
            $product22->guestPrice = '140.00';
            $product22->save();

            $product25 = new Products;
            $product25->productCategory = 'noodles';
            $product25->productName = 'Bihon';
            $product25->price = '210.00';
            $product25->guestPrice = '160.00';
            $product25->save();

            $product26 = new Products;
            $product26->productCategory = 'noodles';
            $product26->productName = 'Canton';
            $product26->price = '210.00';
            $product26->guestPrice = '160.00';
            $product26->save();

            $product27 = new Products;
            $product27->productCategory = 'noodles';
            $product27->productName = 'Bihon & Canton';
            $product27->price = '210.00';
            $product27->guestPrice = '160.00';
            $product27->save();

            $product28 = new Products;
            $product28->productCategory = 'riceBowl';
            $product28->productName = 'Special Fried Rice';
            $product28->price = '130.00';
            $product28->guestPrice = '110.00';
            $product28->save();

            $product29 = new Products;
            $product29->productCategory = 'riceBowl';
            $product29->productName = 'Lumpia Fried Rice';
            $product29->price = '180.00';
            $product29->guestPrice = '140.00';
            $product29->save();

            $product31 = new Products;
            $product31->productCategory = 'riceBowl';
            $product31->productName = 'Porkchop Fried Rice';
            $product31->price = '200.00';
            $product31->guestPrice = '160.00';
            $product31->save();

            $product32 = new Products;
            $product32->productCategory = 'riceBowl';
            $product32->productName = 'Chicken Fried Rice';
            $product32->price = '200.00';
            $product32->guestPrice = '200.00';
            $product32->save();

            $product34 = new Products;
            $product34->productCategory = 'groupMeal';
            $product34->productName = 'Creamy Adobo';
            $product34->price = '375.00';
            $product34->guestPrice = '375.00';
            $product34->save();

            $product35 = new Products;
            $product35->productCategory = 'groupMeal';
            $product35->productName = 'Crispy Kare-Kare';
            $product35->price = '375.00';
            $product35->guestPrice = '375.00';
            $product35->save();

            $product36 = new Products;
            $product36->productCategory = 'groupMeal';
            $product36->productName = 'Pinakbet w/ Lechon Kawali';
            $product36->price = '375.00';
            $product36->guestPrice = '375.00';
            $product36->save();

            $product37 = new Products;
            $product37->productCategory = 'groupMeal';
            $product37->productName = 'Lechon Kawali';
            $product37->price = '375.00';
            $product37->guestPrice = '375.00';
            $product37->save();

            $product38 = new Products;
            $product38->productCategory = 'groupMeal';
            $product38->productName = 'Bicol Express Liempo';
            $product38->price = '375.00';
            $product38->guestPrice = '375.00';
            $product38->save();

            $product39 = new Products;
            $product39->productCategory = 'groupMeal';
            $product39->productName = 'Pork Binagoongan';
            $product39->price = '375.00';
            $product39->guestPrice = '375.00';
            $product39->save();

            $product40 = new Products;
            $product40->productCategory = 'specialRiceMeal';
            $product40->productName = 'Valleypoint Rice';
            $product40->price = '250.00';
            $product40->guestPrice = '250.00';
            $product40->save();

            $product41 = new Products;
            $product41->productCategory = 'specialRiceMeal';
            $product41->productName = 'Lechon Kawali Rice';
            $product41->price = '250.00';
            $product41->guestPrice = '250.00';
            $product41->save();

            $product42 = new Products;
            $product42->productCategory = 'specialRiceMeal';
            $product42->productName = 'Sizzling Sisig Rice';
            $product42->price = '250.00';
            $product42->guestPrice = '250.00';
            $product42->save();

            $product43 = new Products;
            $product43->productCategory = 'specialRiceMeal';
            $product43->productName = 'Binagoongan Rice';
            $product43->price = '250.00';
            $product43->guestPrice = '250.00';
            $product43->save();

            $product44 = new Products;
            $product44->productCategory = 'specialRiceMeal';
            $product44->productName = 'Bicol Express Rice';
            $product44->price = '250.00';
            $product44->guestPrice = '250.00';
            $product44->save();

            $product45 = new Products;
            $product45->productCategory = 'soup';
            $product45->productName = 'Sinigang na Baboy';
            $product45->price = '375.00';
            $product45->guestPrice = '375.00';
            $product45->save();

            $product46 = new Products;
            $product46->productCategory = 'soup';
            $product46->productName = 'Nilagang Baboy';
            $product46->price = '375.00';
            $product46->guestPrice = '375.00';
            $product46->save();

            // $product47 = new Products;
            // $product47->productCategory = 'soup';
            // $product47->productName = 'Pinikpikan';
            // $product47->price = '375.00';
            // $product47->guestPrice = '375.00';
            // $product47->save();

            $product48 = new Products;
            $product48->productCategory = 'extra';
            $product48->productName = 'Plain Rice';
            $product48->price = '20.00';
            $product48->guestPrice = '20.00';
            $product48->save();

            $product49 = new Products;
            $product49->productCategory = 'extra';
            $product49->productName = 'Garlic Rice';
            $product49->price = '30.00';
            $product49->guestPrice = '30.00';
            $product49->save();


            $product50 = new Products;
            $product50->productCategory = 'beverage';
            $product50->productName = 'Iced Tea (Glass)';
            $product50->price = '35.00';
            $product50->guestPrice = '35.00';
            $product50->save();

            $product51 = new Products;
            $product51->productCategory = 'beverage';
            $product51->productName = 'Iced Tea (Pitcher)';
            $product51->price = '80.00';
            $product51->guestPrice = '80.00';
            $product51->save();

            $product52 = new Products;
            $product52->productCategory = 'beverage';
            $product52->productName = 'Coke';
            $product52->price = '60.00';
            $product52->guestPrice = '60.00';
            $product52->save();

            $product53 = new Products;
            $product53->productCategory = 'beverage';
            $product53->productName = 'Royal';
            $product53->price = '60.00';
            $product53->guestPrice = '60.00';
            $product53->save();

            $product54 = new Products;
            $product54->productCategory = 'beverage';
            $product54->productName = 'Sprite';
            $product54->price = '60.00';
            $product54->guestPrice = '60.00';
            $product54->save();

            $product55 = new Products;
            $product55->productCategory = 'beverage';
            $product55->productName = 'Coke Zero';
            $product55->price = '60.00';
            $product55->guestPrice = '60.00';
            $product55->save();

            $product56 = new Products;
            $product56->productCategory = 'beverage';
            $product56->productName = 'Bottomless Coffee';
            $product56->price = '100.00';
            $product56->guestPrice = '100.00';
            $product56->save();

            $product57 = new Products;
            $product57->productCategory = 'beverage';
            $product57->productName = 'Hot Tea';
            $product57->price = '75.00';
            $product57->guestPrice = '75.00';
            $product57->save();

            $product58 = new Products;
            $product58->productCategory = 'beverage';
            $product58->productName = 'Strawberry Shake';
            $product58->price = '110.00';
            $product58->guestPrice = '110.00';
            $product58->save();

            $product59 = new Products;
            $product59->productCategory = 'beverage';
            $product59->productName = 'Banana Shake';
            $product59->price = '110.00';
            $product59->guestPrice = '110.00';
            $product59->save();

            $product60 = new Products;
            $product60->productCategory = 'beverage';
            $product60->productName = 'Mango Shake';
            $product60->price = '110.00';
            $product60->guestPrice = '110.00';
            $product60->save();

            $product61 = new Products;
            $product61->productCategory = 'liquor';
            $product61->productName = 'Beer (Per Bucket)';
            $product61->price = '350.00';
            $product61->guestPrice = '350.00';
            $product61->save();

            $product62 = new Products;
            $product62->productCategory = 'liquor';
            $product62->productName = 'Special Beer (Per Bucket)';
            $product62->price = '400.00';
            $product62->guestPrice = '400.00';
            $product62->save();

            $product63 = new Products;
            $product63->productCategory = 'liquor';
            $product63->productName = 'San Mig Light';
            $product63->price = '70.00';
            $product63->guestPrice = '70.00';
            $product63->save();

            $product64 = new Products;
            $product64->productCategory = 'liquor';
            $product64->productName = 'San Mig Apple';
            $product64->price = '70.00';
            $product64->guestPrice = '70.00';
            $product64->save();

            $product65 = new Products;
            $product65->productCategory = 'liquor';
            $product65->productName = 'Red Horse';
            $product65->price = '70.00';
            $product65->guestPrice = '70.00';
            $product65->save();

            $product66 = new Products;
            $product66->productCategory = 'liquor';
            $product66->productName = 'Pale Pilsen';
            $product66->price = '70.00';
            $product66->guestPrice = '70.00';
            $product66->save();

            $product67 = new Products;
            $product67->productCategory = 'liquor';
            $product67->productName = 'Brew Kettle';
            $product67->price = '75.00';
            $product67->guestPrice = '75.00';
            $product67->save();

            $product68 = new Products;
            $product68->productCategory = 'liquor';
            $product68->productName = 'Smirnoff Mule';
            $product68->price = '75.00';
            $product68->guestPrice = '75.00';
            $product68->save();

            $product69 = new Products;
            $product69->productCategory = 'liquor';
            $product69->productName = 'Heineken';
            $product69->price = '75.00';
            $product69->guestPrice = '75.00';
            $product69->save();

            $product70 = new Products;
            $product70->productCategory = 'liquor';
            $product70->productName = 'Ginebra San Miguel';
            $product70->price = '180.00';
            $product70->guestPrice = '180.00';
            $product70->save();

            $product71 = new Products;
            $product71->productCategory = 'liquor';
            $product71->productName = 'Jinro';
            $product71->price = '250.00';
            $product71->guestPrice = '250.00';
            $product71->save();

            $product72 = new Products;
            $product72->productCategory = 'liquor';
            $product72->productName = 'Fundador Lights';
            $product72->price = '850.00';
            $product72->guestPrice = '850.00';
            $product72->save();

            $product73 = new Products;
            $product73->productCategory = 'liquor';
            $product73->productName = 'Mojito Gold';
            $product73->price = '850.00';
            $product73->guestPrice = '850.00';
            $product73->save();

            $product74 = new Products;
            $product74->productCategory = 'liquor';
            $product74->productName = 'Mojito Silver';
            $product74->price = '600.00';
            $product74->guestPrice = '600.00';
            $product74->save();

            $product75 = new Products;
            $product75->productCategory = 'liquor';
            $product75->productName = 'Johnnie Walker (Double Black)';
            $product75->price = '3500.00';
            $product75->guestPrice = '3500.00';
            $product75->save();

            $product76 = new Products;
            $product76->productCategory = 'liquor';
            $product76->productName = 'Johnnie Walker (Black Label)';
            $product76->price = '2200.00';
            $product76->guestPrice = '2200.00';
            $product76->save();

            $product77 = new Products;
            $product77->productCategory = 'liquor';
            $product77->productName = 'Bacardi Gold';
            $product77->price = '1000.00';
            $product77->guestPrice = '1000.00';
            $product77->save();

            $product78 = new Products;
            $product78->productCategory = 'liquor';
            $product78->productName = 'Bacardi Silver';
            $product78->price = '800.00';
            $product78->guestPrice = '800.00';
            $product78->save();
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
