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
        $recipe1->ingredientID = '40';
        $recipe1->quantity = '1';
        $recipe1->save();

        $recipe2 = new Recipes;
        $recipe2->productID = '1';
        $recipe2->ingredientID = '19';
        $recipe2->quantity = '1';
        $recipe2->save();

        $recipe3 = new Recipes;
        $recipe3->productID = '1';
        $recipe3->ingredientID = '25';
        $recipe3->quantity = '1';
        $recipe3->save();

        $recipe4 = new Recipes;
        $recipe4->productID = '1';
        $recipe4->ingredientID = '26';
        $recipe4->quantity = '1';
        $recipe4->save();

        $recipe5 = new Recipes;
        $recipe5->productID = '1';
        $recipe5->ingredientID = '49';
        $recipe5->quantity = '1';
        $recipe5->save();

        $recipe6 = new Recipes;
        $recipe6->productID = '2';
        $recipe6->ingredientID = '7';
        $recipe6->quantity = '2';
        $recipe6->save();

        $recipe7 = new Recipes;
        $recipe7->productID = '2';
        $recipe7->ingredientID = '19';
        $recipe7->quantity = '1';
        $recipe7->save();

        $recipe8= new Recipes;
        $recipe8->productID = '3';
        $recipe8->ingredientID = '6';
        $recipe8->quantity = '1';
        $recipe8->save();

        $recipe9 = new Recipes;
        $recipe9->productID = '3';
        $recipe9->ingredientID = '19';
        $recipe9->quantity = '1';
        $recipe9->save();

        $recipe10 = new Recipes;
        $recipe10->productID = '4';
        $recipe10->ingredientID = '26';
        $recipe10->quantity = '1';
        $recipe10->save();

        $recipe11 = new Recipes;
        $recipe11->productID = '4';
        $recipe11->ingredientID = '12';
        $recipe11->quantity = '1';
        $recipe11->save();

        $recipe12 = new Recipes;
        $recipe12->productID = '4';
        $recipe12->ingredientID = '18';
        $recipe12->quantity = '1';
        $recipe12->save();

        $recipe13 = new Recipes;
        $recipe13->productID = '4';
        $recipe13->ingredientID = '17';
        $recipe13->quantity = '1';
        $recipe13->save();

        $recipe14 = new Recipes;
        $recipe14->productID = '4';
        $recipe14->ingredientID = '1';
        $recipe14->quantity = '100';
        $recipe14->save();

        $recipe15 = new Recipes;
        $recipe15->productID = '4';
        $recipe15->ingredientID = '42';
        $recipe15->quantity = '1';
        $recipe15->save();

        $recipe16 = new Recipes;
        $recipe16->productID = '5';
        $recipe16->ingredientID = '20';
        $recipe16->quantity = '1';
        $recipe16->save();

        $recipe17 = new Recipes;
        $recipe17->productID = '5';
        $recipe17->ingredientID = '1';
        $recipe17->quantity = '100';
        $recipe17->save();

        $recipe18 = new Recipes;
        $recipe18->productID = '5';
        $recipe18->ingredientID = '51';
        $recipe18->quantity = '100';
        $recipe18->save();

        $recipe19 = new Recipes;
        $recipe19->productID = '6';
        $recipe19->ingredientID = '39';
        $recipe19->quantity = '100';
        $recipe19->save();

        $recipe20 = new Recipes;
        $recipe20->productID = '7';
        $recipe20->ingredientID = '41';
        $recipe20->quantity = '1';
        $recipe20->save();

        $recipe21 = new Recipes;
        $recipe21->productID = '8';
        $recipe21->ingredientID = '3';
        $recipe21->quantity = '120';
        $recipe21->save();

        $recipe22 = new Recipes;
        $recipe22->productID = '9';
        $recipe22->ingredientID = '37';
        $recipe22->quantity = '1';
        $recipe22->save();

        $recipe23 = new Recipes;
        $recipe23->productID = '9';
        $recipe23->ingredientID = '49';
        $recipe23->quantity = '1';
        $recipe23->save();

        $recipe24 = new Recipes;
        $recipe24->productID = '9';
        $recipe24->ingredientID = '43';
        $recipe24->quantity = '4';
        $recipe24->save();

        $recipe25 = new Recipes;
        $recipe25->productID = '10';
        $recipe25->ingredientID = '7';
        $recipe25->quantity = '1';
        $recipe25->save();

        $recipe26 = new Recipes;
        $recipe26->productID = '10';
        $recipe26->ingredientID = '37';
        $recipe26->quantity = '2';
        $recipe26->save();

        $recipe27 = new Recipes;
        $recipe27->productID = '10';
        $recipe27->ingredientID = '49';
        $recipe27->quantity = '1';
        $recipe27->save();

        $recipe28 = new Recipes;
        $recipe28->productID = '10';
        $recipe28->ingredientID = '43';
        $recipe28->quantity = '4';
        $recipe28->save();

        $recipe29 = new Recipes;
        $recipe29->productID = '10';
        $recipe29->ingredientID = '50';
        $recipe29->quantity = '50';
        $recipe29->save();

        $recipe30 = new Recipes;
        $recipe30->productID = '11';
        $recipe30->ingredientID = '44';
        $recipe30->quantity = '1';
        $recipe30->save();

        $recipe31 = new Recipes;
        $recipe31->productID = '11';
        $recipe31->ingredientID = '41';
        $recipe31->quantity = '1';
        $recipe31->save();

        $recipe32 = new Recipes;
        $recipe32->productID = '11';
        $recipe32->ingredientID = '43';
        $recipe32->quantity = '4';
        $recipe32->save();

        $recipe33 = new Recipes;
        $recipe33->productID = '11';
        $recipe33->ingredientID = '37';
        $recipe33->quantity = '1';
        $recipe33->save();

        $recipe34 = new Recipes;
        $recipe34->productID = '11';
        $recipe34->ingredientID = '50';
        $recipe34->quantity = '1';
        $recipe34->save();

        $recipe35 = new Recipes;
        $recipe35->productID = '12';
        $recipe35->ingredientID = '5';
        $recipe35->quantity = '1';
        $recipe35->save();

        $recipe36 = new Recipes;
        $recipe36->productID = '12';
        $recipe36->ingredientID = '37';
        $recipe36->quantity = '1';
        $recipe36->save();

        $recipe37 = new Recipes;
        $recipe37->productID = '12';
        $recipe37->ingredientID = '25';
        $recipe37->quantity = '4';
        $recipe37->save();

        $recipe38 = new Recipes;
        $recipe38->productID = '13';
        $recipe38->ingredientID = '28';
        $recipe38->quantity = '1';
        $recipe38->save();

        $recipe39 = new Recipes;
        $recipe39->productID = '13';
        $recipe39->ingredientID = '37';
        $recipe39->quantity = '1';
        $recipe39->save();


        $recipe40 = new Recipes;
        $recipe40->productID = '14';
        $recipe40->ingredientID = '8';
        $recipe40->quantity = '1';
        $recipe40->save();

        $recipe41 = new Recipes;
        $recipe41->productID = '14';
        $recipe41->ingredientID = '37';
        $recipe41->quantity = '1';
        $recipe41->save();

        $recipe42 = new Recipes;
        $recipe42->productID = '15';
        $recipe42->ingredientID = '1';
        $recipe42->quantity = '1';
        $recipe42->save();

        $recipe43 = new Recipes;
        $recipe43->productID = '15';
        $recipe43->ingredientID = '37';
        $recipe43->quantity = '1';
        $recipe43->save();

        $recipe44 = new Recipes;
        $recipe44->productID = '16';
        $recipe44->ingredientID = '38';
        $recipe44->quantity = '1';
        $recipe44->save();

        $recipe45 = new Recipes;
        $recipe45->productID = '16';
        $recipe45->ingredientID = '37';
        $recipe45->quantity = '1';
        $recipe45->save();

        $recipe46 = new Recipes;
        $recipe46->productID = '17';
        $recipe46->ingredientID = '27';
        $recipe46->quantity = '1';
        $recipe46->save();

        $recipe47 = new Recipes;
        $recipe47->productID = '17';
        $recipe47->ingredientID = '37';
        $recipe47->quantity = '1';
        $recipe47->save();

        $recipe48 = new Recipes;
        $recipe48->productID = '18';
        $recipe48->ingredientID = '45';
        $recipe48->quantity = '1';
        $recipe48->save();

        $recipe49 = new Recipes;
        $recipe49->productID = '18';
        $recipe49->ingredientID = '49';
        $recipe49->quantity = '1';
        $recipe49->save();

        $recipe50 = new Recipes;
        $recipe50->productID = '18';
        $recipe50->ingredientID = '29';
        $recipe50->quantity = '1';
        $recipe50->save();

        
        $recipe51 = new Recipes;
        $recipe51->productID = '18';
        $recipe51->ingredientID = '44';
        $recipe51->quantity = '1';
        $recipe51->save();

        
        $recipe52 = new Recipes;
        $recipe52->productID = '18';
        $recipe52->ingredientID = '43';
        $recipe52->quantity = '1';
        $recipe52->save();

        
        $recipe53 = new Recipes;
        $recipe53->productID = '19';
        $recipe53->ingredientID = '52';
        $recipe53->quantity = '1';
        $recipe53->save();

        $recipe54 = new Recipes;
        $recipe54->productID = '19';
        $recipe54->ingredientID = '21';
        $recipe54->quantity = '1';
        $recipe54->save();

        $recipe55 = new Recipes;
        $recipe55->productID = '19';
        $recipe55->ingredientID = '46';
        $recipe55->quantity = '1';
        $recipe55->save();

        $recipe56 = new Recipes;
        $recipe56->productID = '20';
        $recipe56->ingredientID = '53';
        $recipe56->quantity = '1';
        $recipe56->save();

        $recipe57 = new Recipes;
        $recipe57->productID = '20';
        $recipe57->ingredientID = '21';
        $recipe57->quantity = '1';
        $recipe57->save();

        $recipe58 = new Recipes;
        $recipe58->productID = '20';
        $recipe58->ingredientID = '46';
        $recipe58->quantity = '1';
        $recipe58->save();

        $recipe59 = new Recipes;
        $recipe59->productID = '21';
        $recipe59->ingredientID = '52';
        $recipe59->quantity = '1';
        $recipe59->save();

        $recipe60 = new Recipes;
        $recipe60->productID = '21';
        $recipe60->ingredientID = '53';
        $recipe60->quantity = '1';
        $recipe60->save();

        $recipe61 = new Recipes;
        $recipe61->productID = '21';
        $recipe61->ingredientID = '21';
        $recipe61->quantity = '1';
        $recipe61->save();

        $recipe62 = new Recipes;
        $recipe62->productID = '21';
        $recipe62->ingredientID = '46';
        $recipe62->quantity = '1';
        $recipe62->save();

        $recipe63 = new Recipes;
        $recipe63->productID = '22';
        $recipe63->ingredientID = '44';
        $recipe63->quantity = '1';
        $recipe63->save();

        $recipe64 = new Recipes;
        $recipe64->productID = '22';
        $recipe64->ingredientID = '21';
        $recipe64->quantity = '1';
        $recipe64->save();

        $recipe65 = new Recipes;
        $recipe65->productID = '22';
        $recipe65->ingredientID = '37';
        $recipe65->quantity = '1';
        $recipe65->save();

        $recipe66 = new Recipes;
        $recipe66->productID = '23';
        $recipe66->ingredientID = '39';
        $recipe66->quantity = '8';
        $recipe66->save();

        $recipe67 = new Recipes;
        $recipe67->productID = '23';
        $recipe67->ingredientID = '44';
        $recipe67->quantity = '1';
        $recipe67->save();

        $recipe68 = new Recipes;
        $recipe68->productID = '23';
        $recipe68->ingredientID = '37';
        $recipe68->quantity = '1';
        $recipe68->save();

        $recipe69 = new Recipes;
        $recipe69->productID = '23';
        $recipe69->ingredientID = '21';
        $recipe69->quantity = '1';
        $recipe69->save();

        $recipe70 = new Recipes;
        $recipe70->productID = '24';
        $recipe70->ingredientID = '1';
        $recipe70->quantity = '1';
        $recipe70->save();

        $recipe71 = new Recipes;
        $recipe71->productID = '24';
        $recipe71->ingredientID = '44';
        $recipe71->quantity = '1';
        $recipe71->save();

        $recipe72 = new Recipes;
        $recipe72->productID = '24';
        $recipe72->ingredientID = '21';
        $recipe72->quantity = '1';
        $recipe72->save();

        $recipe73 = new Recipes;
        $recipe73->productID = '24';
        $recipe73->ingredientID = '37';
        $recipe73->quantity = '1';
        $recipe73->save();

        $recipe74 = new Recipes;
        $recipe74->productID = '25';
        $recipe74->ingredientID = '44';
        $recipe74->quantity = '1';
        $recipe74->save();

        $recipe75 = new Recipes;
        $recipe75->productID = '25';
        $recipe75->ingredientID = '21';
        $recipe75->quantity = '1';
        $recipe75->save();

        $recipe76 = new Recipes;
        $recipe76->productID = '25';
        $recipe76->ingredientID = '37';
        $recipe76->quantity = '1';
        $recipe76->save();
        
        $recipe77 = new Recipes;
        $recipe77->productID = '25';
        $recipe77->ingredientID = '2';
        $recipe77->quantity = '120';
        $recipe77->save();

        $recipe78 = new Recipes;
        $recipe78->productID = '26';
        $recipe78->ingredientID = '11';
        $recipe78->quantity = '1';
        $recipe78->save();

        $recipe79 = new Recipes;
        $recipe79->productID = '26';
        $recipe79->ingredientID = '10';
        $recipe79->quantity = '120';
        $recipe79->save();

        $recipe80 = new Recipes;
        $recipe80->productID = '26';
        $recipe80->ingredientID = '26';
        $recipe80->quantity = '1';
        $recipe80->save();

        $recipe81 = new Recipes;
        $recipe81->productID = '27';
        $recipe81->ingredientID = '10';
        $recipe81->quantity = '120';
        $recipe81->save();

        $recipe82 = new Recipes;
        $recipe82->productID = '27';
        $recipe82->ingredientID = '13';
        $recipe82->quantity = '1';
        $recipe82->save();

        $recipe83 = new Recipes;
        $recipe83->productID = '27';
        $recipe83->ingredientID = '54';
        $recipe83->quantity = '1';
        $recipe83->save();

        $recipe84 = new Recipes;
        $recipe84->productID = '27';
        $recipe84->ingredientID = '14';
        $recipe84->quantity = '1';
        $recipe84->save();

        $recipe85 = new Recipes;
        $recipe85->productID = '27';
        $recipe85->ingredientID = '26';
        $recipe85->quantity = '1';
        $recipe85->save();

        $recipe86 = new Recipes;
        $recipe86->productID = '28';
        $recipe86->ingredientID = '10';
        $recipe86->quantity = '120';
        $recipe86->save();

        $recipe87 = new Recipes;
        $recipe87->productID = '28';
        $recipe87->ingredientID = '34';
        $recipe87->quantity = '1';
        $recipe87->save();

        $recipe88 = new Recipes;
        $recipe88->productID = '28';
        $recipe88->ingredientID = '15';
        $recipe88->quantity = '1';
        $recipe88->save();

        $recipe89 = new Recipes;
        $recipe89->productID = '28';
        $recipe89->ingredientID = '18';
        $recipe89->quantity = '1';
        $recipe89->save();

        $recipe90 = new Recipes;
        $recipe90->productID = '28';
        $recipe90->ingredientID = '14';
        $recipe90->quantity = '1';
        $recipe90->save();

        $recipe91 = new Recipes;
        $recipe91->productID = '28';
        $recipe91->ingredientID = '32';
        $recipe91->quantity = '1';
        $recipe91->save();

        $recipe92 = new Recipes;
        $recipe92->productID = '28';
        $recipe92->ingredientID = '26';
        $recipe92->quantity = '1';
        $recipe92->save();

        $recipe93 = new Recipes;
        $recipe93->productID = '29';
        $recipe93->ingredientID = '10';
        $recipe93->quantity = '1';
        $recipe93->save();

        $recipe94 = new Recipes;
        $recipe94->productID = '30';
        $recipe94->ingredientID = '10';
        $recipe94->quantity = '120';
        $recipe94->save();

        $recipe95 = new Recipes;
        $recipe95->productID = '30';
        $recipe95->ingredientID = '31';
        $recipe95->quantity = '1';
        $recipe95->save();

        $recipe96 = new Recipes;
        $recipe96->productID = '30';
        $recipe96->ingredientID = '20';
        $recipe96->quantity = '1';
        $recipe96->save();

        $recipe97 = new Recipes;
        $recipe97->productID = '31';
        $recipe97->ingredientID = '31';
        $recipe97->quantity = '1';
        $recipe97->save();

        $recipe98 = new Recipes;
        $recipe98->productID = '31';
        $recipe98->ingredientID = '10';
        $recipe98->quantity = '120';
        $recipe98->save();

        $recipe99 = new Recipes;
        $recipe99->productID = '32';
        $recipe99->ingredientID = '2';
        $recipe99->quantity = '120';
        $recipe99->save();

        $recipe100 = new Recipes;
        $recipe100->productID = '32';
        $recipe100->ingredientID = '1';
        $recipe100->quantity = '120';
        $recipe100->save();

        $recipe101 = new Recipes;
        $recipe101->productID = '32';
        $recipe101->ingredientID = '21';
        $recipe101->quantity = '1';
        $recipe101->save();

        $recipe102 = new Recipes;
        $recipe102->productID = '32';
        $recipe102->ingredientID = '37';
        $recipe102->quantity = '1';
        $recipe102->save();

        $recipe103 = new Recipes;
        $recipe103->productID = '33';
        $recipe103->ingredientID = '10';
        $recipe103->quantity = '120';
        $recipe103->save();

        $recipe104 = new Recipes;
        $recipe104->productID = '34';
        $recipe104->ingredientID = '40';
        $recipe104->quantity = '120';
        $recipe104->save();

        $recipe105 = new Recipes;
        $recipe105->productID = '34';
        $recipe105->ingredientID = '49';
        $recipe105->quantity = '1';
        $recipe105->save();

        $recipe106 = new Recipes;
        $recipe106->productID = '34';
        $recipe106->ingredientID = '19';
        $recipe106->quantity = '1';
        $recipe106->save();

        $recipe107 = new Recipes;
        $recipe107->productID = '34';
        $recipe107->ingredientID = '25';
        $recipe107->quantity = '1';
        $recipe107->save();

        $recipe108 = new Recipes;
        $recipe108->productID = '34';
        $recipe108->ingredientID = '26';
        $recipe108->quantity = '1';
        $recipe108->save();

        $recipe109 = new Recipes;
        $recipe109->productID = '35';
        $recipe109->ingredientID = '31';
        $recipe109->quantity = '1';
        $recipe109->save();

        $recipe110 = new Recipes;
        $recipe110->productID = '35';
        $recipe110->ingredientID = '10';
        $recipe110->quantity = '120';
        $recipe110->save();

        $recipe111 = new Recipes;
        $recipe111->productID = '36';
        $recipe111->ingredientID = '31';
        $recipe111->quantity = '1';
        $recipe111->save();

        $recipe112 = new Recipes;
        $recipe112->productID = '36';
        $recipe112->ingredientID = '10';
        $recipe112->quantity = '120';
        $recipe112->save();

        $recipe113 = new Recipes;
        $recipe113->productID = '36';
        $recipe113->ingredientID = '20';
        $recipe113->quantity = '1';
        $recipe113->save();

        $recipe114 = new Recipes;
        $recipe114->productID = '37';
        $recipe114->ingredientID = '10';
        $recipe114->quantity = '120';
        $recipe114->save();

        $recipe115 = new Recipes;
        $recipe115->productID = '37';
        $recipe115->ingredientID = '31';
        $recipe115->quantity = '1';
        $recipe115->save();

        $recipe116 = new Recipes;
        $recipe116->productID = '37';
        $recipe116->ingredientID = '15';
        $recipe116->quantity = '1';
        $recipe116->save();

        $recipe117 = new Recipes;
        $recipe117->productID = '37';
        $recipe117->ingredientID = '14';
        $recipe117->quantity = '1';
        $recipe117->save();

        $recipe118 = new Recipes;
        $recipe118->productID = '37';
        $recipe118->ingredientID = '18';
        $recipe118->quantity = '1';
        $recipe118->save();

        $recipe119 = new Recipes;
        $recipe119->productID = '37';
        $recipe119->ingredientID = '33';
        $recipe119->quantity = '1';
        $recipe119->save();

        $recipe120 = new Recipes;
        $recipe120->productID = '37';
        $recipe120->ingredientID = '26';
        $recipe120->quantity = '1';
        $recipe120->save();

        $recipe121 = new Recipes;
        $recipe121->productID = '37';
        $recipe121->ingredientID = '56';
        $recipe121->quantity = '1';
        $recipe121->save();

        $recipe122 = new Recipes;
        $recipe122->productID = '38';
        $recipe122->ingredientID = '10';
        $recipe122->quantity = '120';
        $recipe122->save();

        $recipe123 = new Recipes;
        $recipe123->productID = '38';
        $recipe123->ingredientID = '12';
        $recipe123->quantity = '1';
        $recipe123->save();

        $recipe124 = new Recipes;
        $recipe124->productID = '38';
        $recipe124->ingredientID = '34';
        $recipe124->quantity = '1';
        $recipe124->save();

        $recipe125 = new Recipes;
        $recipe125->productID = '38';
        $recipe125->ingredientID = '11';
        $recipe125->quantity = '1';
        $recipe125->save();

        $recipe126 = new Recipes;
        $recipe126->productID = '38';
        $recipe126->ingredientID = '26';
        $recipe126->quantity = '1';
        $recipe126->save();

        $recipe127 = new Recipes;
        $recipe127->productID = '41';
        $recipe127->ingredientID = '57';
        $recipe127->quantity = '1';
        $recipe127->save();

        $recipe128 = new Recipes;
        $recipe128->productID = '42';
        $recipe128->ingredientID = '57';
        $recipe128->quantity = '1';
        $recipe128->save();

        $recipe129 = new Recipes;
        $recipe129->productID = '43';
        $recipe129->ingredientID = '48';
        $recipe129->quantity = '1';
        $recipe129->save();

        $recipe130 = new Recipes;
        $recipe130->productID = '44';
        $recipe130->ingredientID = '48';
        $recipe130->quantity = '1';
        $recipe130->save();

        $recipe131 = new Recipes;
        $recipe131->productID = '45';
        $recipe131->ingredientID = '48';
        $recipe131->quantity = '1';
        $recipe131->save();

        $recipe132 = new Recipes;
        $recipe132->productID = '46';
        $recipe132->ingredientID = '48';
        $recipe132->quantity = '1';
        $recipe132->save();

        $recipe133 = new Recipes;
        $recipe133->productID = '47';
        $recipe133->ingredientID = '58';
        $recipe133->quantity = '1';
        $recipe133->save();

        $recipe134= new Recipes;
        $recipe134->productID = '48';
        $recipe134->ingredientID = '47';
        $recipe134->quantity = '1';
        $recipe134->save();

        $recipe135 = new Recipes;
        $recipe135->productID = '49';
        $recipe135->ingredientID = '22';
        $recipe135->quantity = '1';
        $recipe135->save();

        $recipe136 = new Recipes;
        $recipe136->productID = '49';
        $recipe136->ingredientID = '59';
        $recipe136->quantity = '1';
        $recipe136->save();

        $recipe137 = new Recipes;
        $recipe137->productID = '49';
        $recipe137->ingredientID = '35';
        $recipe137->quantity = '1';
        $recipe137->save();

        $recipe138 = new Recipes;
        $recipe138->productID = '50';
        $recipe138->ingredientID = '23';
        $recipe138->quantity = '1';
        $recipe138->save();

        $recipe139 = new Recipes;
        $recipe139->productID = '50';
        $recipe139->ingredientID = '59';
        $recipe139->quantity = '1';
        $recipe139->save();

        $recipe140 = new Recipes;
        $recipe140->productID = '50';
        $recipe140->ingredientID = '36';
        $recipe140->quantity = '1';
        $recipe140->save();

        $recipe141 = new Recipes;
        $recipe141->productID = '51';
        $recipe141->ingredientID = '59';
        $recipe141->quantity = '1';
        $recipe141->save();

        $recipe142 = new Recipes;
        $recipe142->productID = '51';
        $recipe142->ingredientID = '36';
        $recipe142->quantity = '1';
        $recipe142->save();

        $recipe143 = new Recipes;
        $recipe143->productID = '51';
        $recipe143->ingredientID = '24';
        $recipe143->quantity = '1';
        $recipe143->save();

        $recipe144 = new Recipes;
        $recipe144->productID = '54';
        $recipe144->ingredientID = '60';
        $recipe144->quantity = '1';
        $recipe144->save();

        $recipe145 = new Recipes;
        $recipe145->productID = '55';
        $recipe145->ingredientID = '61';
        $recipe145->quantity = '1';
        $recipe145->save();

        $recipe146 = new Recipes;
        $recipe146->productID = '56';
        $recipe146->ingredientID = '62';
        $recipe146->quantity = '1';
        $recipe146->save();

        $recipe147= new Recipes;
        $recipe147->productID = '57';
        $recipe147->ingredientID = '63';
        $recipe147->quantity = '1';
        $recipe147->save();

        $recipe148 = new Recipes;
        $recipe148->productID = '58';
        $recipe148->ingredientID = '64';
        $recipe148->quantity = '1';
        $recipe148->save();

        $recipe149 = new Recipes;
        $recipe149->productID = '59';
        $recipe149->ingredientID = '65';
        $recipe149->quantity = '1';
        $recipe149->save();

        $recipe150 = new Recipes;
        $recipe150->productID = '60';
        $recipe150->ingredientID = '66';
        $recipe150->quantity = '1';
        $recipe150->save();

        $recipe151 = new Recipes;
        $recipe151->productID = '61';
        $recipe151->ingredientID = '67';
        $recipe151->quantity = '1';
        $recipe151->save();

        $recipe152 = new Recipes;
        $recipe152->productID = '62';
        $recipe152->ingredientID = '68';
        $recipe152->quantity = '1';
        $recipe152->save();

        $recipe153 = new Recipes;
        $recipe153->productID = '63';
        $recipe153->ingredientID = '69';
        $recipe153->quantity = '1';
        $recipe153->save();

        $recipe154 = new Recipes;
        $recipe154->productID = '64';
        $recipe154->ingredientID = '70';
        $recipe154->quantity = '1';
        $recipe154->save();

        $recipe155 = new Recipes;
        $recipe155->productID = '65';
        $recipe155->ingredientID = '71';
        $recipe155->quantity = '1';
        $recipe155->save();

        $recipe156 = new Recipes;
        $recipe156->productID = '66';
        $recipe156->ingredientID = '72';
        $recipe156->quantity = '1';
        $recipe156->save();

        $recipe157 = new Recipes;
        $recipe157->productID = '67';
        $recipe157->ingredientID = '73';
        $recipe157->quantity = '1';
        $recipe157->save();

        $recipe158 = new Recipes;
        $recipe158->productID = '68';
        $recipe158->ingredientID = '74';
        $recipe158->quantity = '1';
        $recipe158->save();

        $recipe159 = new Recipes;
        $recipe159->productID = '69';
        $recipe159->ingredientID = '75';
        $recipe159->quantity = '1';
        $recipe159->save();
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
