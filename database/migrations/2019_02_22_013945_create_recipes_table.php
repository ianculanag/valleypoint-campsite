<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Recipes;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->integer('productID')->unsigned();
            $table->integer('ingredientID')->unsigned();
            $table->double('quantity', 8, 2);
            //$table->string('productRecipe');
            //$table->foreign('productID')->references('id')->on('Products');
            //$table->foreign('ingredientID')->references('id')->on('Ingredients');
            $table->timestamps();
        });

        $recipe1 = new Recipes;
        $recipe1->productID = '1';
        $recipe1->ingredientID = '29';
        $recipe1->quantity = '1';
        $recipe1->save();

        $recipe2 = new Recipes;
        $recipe2->productID = '1';
        $recipe2->ingredientID = '19';
        $recipe2->quantity = '1';
        $recipe2->save();

        $recipe3 = new Recipes;
        $recipe3->productID = '2';
        $recipe3->ingredientID = '7';
        $recipe3->quantity = '1';
        $recipe3->save();

        $recipe4 = new Recipes;
        $recipe4->productID = '2';
        $recipe4->ingredientID = '19';
        $recipe4->quantity = '1';
        $recipe4->save();

        $recipe5 = new Recipes;
        $recipe5->productID = '3';
        $recipe5->ingredientID = '6';
        $recipe5->quantity = '1';
        $recipe5->save();

        $recipe6 = new Recipes;
        $recipe6->productID = '3';
        $recipe6->ingredientID = '19';
        $recipe6->quantity = '1';
        $recipe6->save();

        $recipe7 = new Recipes;
        $recipe7->productID = '4';
        $recipe7->ingredientID = '31';
        $recipe7->quantity = '1';
        $recipe7->save();

        $recipe8 = new Recipes;
        $recipe8->productID = '4';
        $recipe8->ingredientID = '4';
        $recipe8->quantity = '120';
        $recipe8->save();

        $recipe9 = new Recipes;
        $recipe9->productID = '5';
        $recipe9->ingredientID = '20';
        $recipe9->quantity = '200';
        $recipe9->save();

        $recipe10 = new Recipes;
        $recipe10->productID = '5';
        $recipe10->ingredientID = '4';
        $recipe10->quantity = '120';
        $recipe10->save();

        $recipe11 = new Recipes;
        $recipe11->productID = '6';
        $recipe11->ingredientID = '28';
        $recipe11->quantity = '150';
        $recipe11->save();

        $recipe12 = new Recipes;
        $recipe12->productID = '7';
        $recipe12->ingredientID = '30';
        $recipe12->quantity = '1';
        $recipe12->save();

        $recipe13 = new Recipes;
        $recipe13->productID = '8';
        $recipe13->ingredientID = '3';
        $recipe13->quantity = '120';
        $recipe13->save();

        $recipe14 = new Recipes;
        $recipe14->productID = '10';
        $recipe14->ingredientID = '26';
        $recipe14->quantity = '1';
        $recipe14->save();

        $recipe15 = new Recipes;
        $recipe15->productID = '10';
        $recipe15->ingredientID = '32';
        $recipe15->quantity = '1';
        $recipe15->save();

        $recipe16 = new Recipes;
        $recipe16->productID = '11';
        $recipe16->ingredientID = '7';
        $recipe16->quantity = '1';
        $recipe16->save();

        $recipe17 = new Recipes;
        $recipe17->productID = '11';
        $recipe17->ingredientID = '32';
        $recipe17->quantity = '1';
        $recipe17->save();

        $recipe18 = new Recipes;
        $recipe18->productID = '12';
        $recipe18->ingredientID = '32';
        $recipe18->quantity = '1';
        $recipe18->save();

        $recipe19 = new Recipes;
        $recipe19->productID = '12';
        $recipe19->ingredientID = '33';
        $recipe19->quantity = '1';
        $recipe19->save();

        $recipe20 = new Recipes;
        $recipe20->productID = '13';
        $recipe20->ingredientID = '5';
        $recipe20->quantity = '120';
        $recipe20->save();

        $recipe21 = new Recipes;
        $recipe21->productID = '13';
        $recipe21->ingredientID = '26';
        $recipe21->quantity = '1';
        $recipe21->save();

        $recipe22 = new Recipes;
        $recipe22->productID = '14';
        $recipe22->ingredientID = '1';
        $recipe22->quantity = '120';
        $recipe22->save();

        $recipe23 = new Recipes;
        $recipe23->productID = '14';
        $recipe23->ingredientID = '26';
        $recipe23->quantity = '1';
        $recipe23->save();

        $recipe24 = new Recipes;
        $recipe24->productID = '18';
        $recipe24->ingredientID = '8';
        $recipe24->quantity = '1';
        $recipe24->save();

        $recipe25 = new Recipes;
        $recipe25->productID = '18';
        $recipe25->ingredientID = '26';
        $recipe25->quantity = '1';
        $recipe25->save();

        $recipe26 = new Recipes;
        $recipe26->productID = '19';
        $recipe26->ingredientID = '1';
        $recipe26->quantity = '120';
        $recipe26->save();

        $recipe27 = new Recipes;
        $recipe27->productID = '19';
        $recipe27->ingredientID = '26';
        $recipe27->quantity = '1';
        $recipe27->save();

        $recipe28 = new Recipes;
        $recipe28->productID = '20';
        $recipe28->ingredientID = '27';
        $recipe28->quantity = '1';
        $recipe28->save();

        $recipe29 = new Recipes;
        $recipe29->productID = '20';
        $recipe29->ingredientID = '26';
        $recipe29->quantity = '1';
        $recipe29->save();

        $recipe30 = new Recipes;
        $recipe30->productID = '21';
        $recipe30->ingredientID = '25';
        $recipe30->quantity = '1';
        $recipe30->save();

        $recipe31 = new Recipes;
        $recipe31->productID = '21';
        $recipe31->ingredientID = '26';
        $recipe31->quantity = '1';
        $recipe31->save();

        $recipe32 = new Recipes;
        $recipe32->productID = '22';
        $recipe32->ingredientID = '34';
        $recipe32->quantity = '1';
        $recipe32->save();

        $recipe33 = new Recipes;
        $recipe33->productID = '22';
        $recipe33->ingredientID = '35';
        $recipe33->quantity = '1';
        $recipe33->save();

        $recipe34 = new Recipes;
        $recipe34->productID = '23';
        $recipe34->ingredientID = '34';
        $recipe34->quantity = '1';
        $recipe34->save();

        $recipe35 = new Recipes;
        $recipe35->productID = '23';
        $recipe35->ingredientID = '35';
        $recipe35->quantity = '1';
        $recipe35->save();

        $recipe36 = new Recipes;
        $recipe36->productID = '24';
        $recipe36->ingredientID = '29';
        $recipe36->quantity = '1';
        $recipe36->save();

        $recipe37 = new Recipes;
        $recipe37->productID = '24';
        $recipe37->ingredientID = '35';
        $recipe37->quantity = '1';
        $recipe37->save();

        $recipe38 = new Recipes;
        $recipe38->productID = '25';
        $recipe38->ingredientID = '34';
        $recipe38->quantity = '1';
        $recipe38->save();

        $recipe39 = new Recipes;
        $recipe39->productID = '25';
        $recipe39->ingredientID = '21';
        $recipe39->quantity = '1';
        $recipe39->save();

        $recipe40 = new Recipes;
        $recipe40->productID = '26';
        $recipe40->ingredientID = '34';
        $recipe40->quantity = '1';
        $recipe40->save();

        $recipe41 = new Recipes;
        $recipe41->productID = '26';
        $recipe41->ingredientID = '21';
        $recipe41->quantity = '1';
        $recipe41->save();

        $recipe42 = new Recipes;
        $recipe42->productID = '27';
        $recipe42->ingredientID = '34';
        $recipe42->quantity = '1';
        $recipe42->save();

        $recipe43 = new Recipes;
        $recipe43->productID = '27';
        $recipe43->ingredientID = '21';
        $recipe43->quantity = '1';
        $recipe43->save();

        $recipe44 = new Recipes;
        $recipe44->productID = '28';
        $recipe44->ingredientID = '26';
        $recipe44->quantity = '1';
        $recipe44->save();

        $recipe45 = new Recipes;
        $recipe45->productID = '29';
        $recipe45->ingredientID = '28';
        $recipe45->quantity = '1';
        $recipe45->save();

        $recipe46 = new Recipes;
        $recipe46->productID = '31';
        $recipe46->ingredientID = '1';
        $recipe46->quantity = '120';
        $recipe46->save();

        $recipe47 = new Recipes;
        $recipe47->productID = '32';
        $recipe47->ingredientID = '1';
        $recipe47->quantity = '120';
        $recipe47->save();

        $recipe48 = new Recipes;
        $recipe48->productID = '34';
        $recipe48->ingredientID = '26';
        $recipe48->quantity = '120';
        $recipe48->save();

        $recipe49 = new Recipes;
        $recipe49->productID = '35';
        $recipe49->ingredientID = '10';
        $recipe49->quantity = '120';
        $recipe49->save();

        $recipe50 = new Recipes;
        $recipe50->productID = '36';
        $recipe50->ingredientID = '10';
        $recipe50->quantity = '120';
        $recipe50->save();
        
        $recipe51 = new Recipes;
        $recipe51->productID = '36';
        $recipe51->ingredientID = '13';
        $recipe51->quantity = '1';
        $recipe51->save();

        $recipe52 = new Recipes;
        $recipe52->productID = '36';
        $recipe52->ingredientID = '14';
        $recipe52->quantity = '1';
        $recipe52->save();

        $recipe53 = new Recipes;
        $recipe53->productID = '36';
        $recipe53->ingredientID = '15';
        $recipe53->quantity = '1';
        $recipe53->save();

        $recipe54 = new Recipes;
        $recipe54->productID = '36';
        $recipe54->ingredientID = '16';
        $recipe54->quantity = '1';
        $recipe54->save();

        $recipe55 = new Recipes;
        $recipe55->productID = '37';
        $recipe55->ingredientID = '10';
        $recipe55->quantity = '120';
        $recipe55->save();

        $recipe56 = new Recipes;
        $recipe56->productID = '38';
        $recipe56->ingredientID = '1';
        $recipe56->quantity = '120';
        $recipe56->save();

        $recipe57 = new Recipes;
        $recipe57->productID = '39';
        $recipe57->ingredientID = '14';
        $recipe57->quantity = '120';
        $recipe57->save();

        $recipe58 = new Recipes;
        $recipe58->productID = '40';
        $recipe58->ingredientID = '2';
        $recipe58->quantity = '120';
        $recipe58->save();

        $recipe59 = new Recipes;
        $recipe59->productID = '40';
        $recipe59->ingredientID = '1';
        $recipe59->quantity = '120';
        $recipe59->save();

        $recipe60 = new Recipes;
        $recipe60->productID = '40';
        $recipe60->ingredientID = '21';
        $recipe60->quantity = '120';
        $recipe60->save();

        $recipe61 = new Recipes;
        $recipe61->productID = '40';
        $recipe61->ingredientID = '26';
        $recipe61->quantity = '1';
        $recipe61->save();

        $recipe62 = new Recipes;
        $recipe62->productID = '41';
        $recipe62->ingredientID = '10';
        $recipe62->quantity = '120';
        $recipe62->save();

        $recipe63 = new Recipes;
        $recipe63->productID = '41';
        $recipe63->ingredientID = '21';
        $recipe63->quantity = '120';
        $recipe63->save();

        $recipe64 = new Recipes;
        $recipe64->productID = '41';
        $recipe64->ingredientID = '26';
        $recipe64->quantity = '1';
        $recipe64->save();

        $recipe65 = new Recipes;
        $recipe65->productID = '42';
        $recipe65->ingredientID = '29';
        $recipe65->quantity = '120';
        $recipe65->save();

        $recipe66 = new Recipes;
        $recipe66->productID = '42';
        $recipe66->ingredientID = '26';
        $recipe66->quantity = '1';
        $recipe66->save();

        $recipe67 = new Recipes;
        $recipe67->productID = '43';
        $recipe67->ingredientID = '1';
        $recipe67->quantity = '120';
        $recipe67->save();

        $recipe68 = new Recipes;
        $recipe68->productID = '44';
        $recipe68->ingredientID = '1';
        $recipe68->quantity = '120';
        $recipe68->save();

        $recipe69 = new Recipes;
        $recipe69->productID = '45';
        $recipe69->ingredientID = '1';
        $recipe69->quantity = '120';
        $recipe69->save();

        $recipe70 = new Recipes;
        $recipe70->productID = '45';
        $recipe70->ingredientID = '20';
        $recipe70->quantity = '120';
        $recipe70->save();

        $recipe71 = new Recipes;
        $recipe71->productID = '46';
        $recipe71->ingredientID = '1';
        $recipe71->quantity = '120';
        $recipe71->save();

        $recipe72 = new Recipes;
        $recipe72->productID = '46';
        $recipe72->ingredientID = '11';
        $recipe72->quantity = '120';
        $recipe72->save();

        $recipe73 = new Recipes;
        $recipe73->productID = '46';
        $recipe73->ingredientID = '12';
        $recipe73->quantity = '120';
        $recipe73->save();

        $recipe74 = new Recipes;
        $recipe74->productID = '46';
        $recipe74->ingredientID = '13';
        $recipe74->quantity = '120';
        $recipe74->save();

        $recipe75 = new Recipes;
        $recipe75->productID = '47';
        $recipe75->ingredientID = '2';
        $recipe75->quantity = '120';
        $recipe75->save();

        $recipe76 = new Recipes;
        $recipe76->productID = '52';
        $recipe76->ingredientID = '37';
        $recipe76->quantity = '300';
        $recipe76->save();

        $recipe77 = new Recipes;
        $recipe77->productID = '53';
        $recipe77->ingredientID = '37';
        $recipe77->quantity = '300';
        $recipe77->save();

        $recipe78 = new Recipes;
        $recipe78->productID = '54';
        $recipe78->ingredientID = '37';
        $recipe78->quantity = '300';
        $recipe78->save();

        $recipe79 = new Recipes;
        $recipe79->productID = '55';
        $recipe79->ingredientID = '37';
        $recipe79->quantity = '300';
        $recipe79->save();

        $recipe80 = new Recipes;
        $recipe80->productID = '57';
        $recipe80->ingredientID = '37';
        $recipe80->quantity = '1';
        $recipe80->save();

        $recipe81 = new Recipes;
        $recipe81->productID = '58';
        $recipe81->ingredientID = '22';
        $recipe81->quantity = '1';
        $recipe81->save();

        $recipe82 = new Recipes;
        $recipe82->productID = '59';
        $recipe82->ingredientID = '23';
        $recipe82->quantity = '1';
        $recipe82->save();

        $recipe83 = new Recipes;
        $recipe83->productID = '60';
        $recipe83->ingredientID = '24';
        $recipe83->quantity = '1';
        $recipe83->save();

        $recipe84 = new Recipes;
        $recipe84->productID = '63';
        $recipe84->ingredientID = '38';
        $recipe84->quantity = '1';
        $recipe84->save();

        $recipe85 = new Recipes;
        $recipe85->productID = '64';
        $recipe85->ingredientID = '39';
        $recipe85->quantity = '1';
        $recipe85->save();

        $recipe86 = new Recipes;
        $recipe86->productID = '65';
        $recipe86->ingredientID = '40';
        $recipe86->quantity = '1';
        $recipe86->save();

        $recipe87 = new Recipes;
        $recipe87->productID = '66';
        $recipe87->ingredientID = '41';
        $recipe87->quantity = '1';
        $recipe87->save();

        $recipe88 = new Recipes;
        $recipe88->productID = '67';
        $recipe88->ingredientID = '42';
        $recipe88->quantity = '1';
        $recipe88->save();

        $recipe89 = new Recipes;
        $recipe89->productID = '68';
        $recipe89->ingredientID = '43';
        $recipe89->quantity = '1';
        $recipe89->save();

        $recipe90 = new Recipes;
        $recipe90->productID = '69';
        $recipe90->ingredientID = '44';
        $recipe90->quantity = '1';
        $recipe90->save();

        $recipe91 = new Recipes;
        $recipe91->productID = '70';
        $recipe91->ingredientID = '45';
        $recipe91->quantity = '1';
        $recipe91->save();

        $recipe92 = new Recipes;
        $recipe92->productID = '71';
        $recipe92->ingredientID = '46';
        $recipe92->quantity = '1';
        $recipe92->save();
        





        
    





        

        

  


        

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
