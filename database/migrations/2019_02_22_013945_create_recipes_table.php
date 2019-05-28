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
        $recipe12->ingredientID = '17';
        $recipe12->quantity = '1';
        $recipe12->save();

        $recipe13 = new Recipes;
        $recipe13->productID = '4';
        $recipe13->ingredientID = '1';
        $recipe13->quantity = '100';
        $recipe13->save();

        $recipe14 = new Recipes;
        $recipe14->productID = '4';
        $recipe14->ingredientID = '42';
        $recipe14->quantity = '1';
        $recipe14->save();

        $recipe15 = new Recipes;
        $recipe15->productID = '5';
        $recipe15->ingredientID = '20';
        $recipe15->quantity = '1';
        $recipe15->save();

        $recipe16 = new Recipes;
        $recipe16->productID = '5';
        $recipe16->ingredientID = '1';
        $recipe16->quantity = '100';
        $recipe16->save();

        $recipe17 = new Recipes;
        $recipe17->productID = '6';
        $recipe17->ingredientID = '39';
        $recipe17->quantity = '100';
        $recipe17->save();

        $recipe18 = new Recipes;
        $recipe18->productID = '7';
        $recipe18->ingredientID = '30';
        $recipe18->quantity = '1';
        $recipe18->save();

        $recipe19 = new Recipes;
        $recipe19->productID = '8';
        $recipe19->ingredientID = '3';
        $recipe19->quantity = '120';
        $recipe19->save();

        $recipe20 = new Recipes;
        $recipe20->productID = '10';
        $recipe20->ingredientID = '37';
        $recipe20->quantity = '2';
        $recipe20->save();

        $recipe21 = new Recipes;
        $recipe21->productID = '10';
        $recipe21->ingredientID = '49';
        $recipe21->quantity = '1';
        $recipe21->save();

        $recipe22 = new Recipes;
        $recipe22->productID = '10';
        $recipe22->ingredientID = '43';
        $recipe22->quantity = '4';
        $recipe22->save();

        $recipe23 = new Recipes;
        $recipe23->productID = '10';
        $recipe23->ingredientID = '50';
        $recipe23->quantity = '50';
        $recipe23->save();

        $recipe24 = new Recipes;
        $recipe24->productID = '11';
        $recipe24->ingredientID = '7';
        $recipe24->quantity = '1';
        $recipe24->save();

        $recipe25 = new Recipes;
        $recipe25->productID = '11';
        $recipe25->ingredientID = '26';
        $recipe25->quantity = '1';
        $recipe25->save();

        $recipe26 = new Recipes;
        $recipe26->productID = '11';
        $recipe26->ingredientID = '43';
        $recipe26->quantity = '4';
        $recipe26->save();

        $recipe27 = new Recipes;
        $recipe27->productID = '11';
        $recipe27->ingredientID = '50';
        $recipe27->quantity = '1';
        $recipe27->save();

        $recipe28 = new Recipes;
        $recipe28->productID = '12';
        $recipe28->ingredientID = '44';
        $recipe28->quantity = '1';
        $recipe28->save();

        $recipe29 = new Recipes;
        $recipe29->productID = '12';
        $recipe29->ingredientID = '51';
        $recipe29->quantity = '1';
        $recipe29->save();

        $recipe30 = new Recipes;
        $recipe30->productID = '12';
        $recipe30->ingredientID = '43';
        $recipe30->quantity = '4';
        $recipe30->save();

        $recipe31 = new Recipes;
        $recipe31->productID = '13';
        $recipe31->ingredientID = '5';
        $recipe31->quantity = '120';
        $recipe31->save();

        $recipe32 = new Recipes;
        $recipe32->productID = '13';
        $recipe32->ingredientID = '5';
        $recipe32->quantity = '1';
        $recipe32->save();

        $recipe33 = new Recipes;
        $recipe33->productID = '13';
        $recipe33->ingredientID = '37';
        $recipe33->quantity = '1';
        $recipe33->save();

        $recipe34 = new Recipes;
        $recipe34->productID = '14';
        $recipe34->ingredientID = '28';
        $recipe34->quantity = '120';
        $recipe34->save();

        $recipe35 = new Recipes;
        $recipe35->productID = '14';
        $recipe35->ingredientID = '37';
        $recipe35->quantity = '1';
        $recipe35->save();

        $recipe36 = new Recipes;
        $recipe36->productID = '18';
        $recipe36->ingredientID = '8';
        $recipe36->quantity = '1';
        $recipe36->save();

        $recipe37 = new Recipes;
        $recipe37->productID = '18';
        $recipe37->ingredientID = '37';
        $recipe37->quantity = '1';
        $recipe37->save();

        $recipe38 = new Recipes;
        $recipe38->productID = '19';
        $recipe38->ingredientID = '1';
        $recipe38->quantity = '120';
        $recipe38->save();

        $recipe39 = new Recipes;
        $recipe39->productID = '19';
        $recipe39->ingredientID = '37';
        $recipe39->quantity = '1';
        $recipe39->save();

        $recipe40 = new Recipes;
        $recipe40->productID = '20';
        $recipe40->ingredientID = '38';
        $recipe40->quantity = '1';
        $recipe40->save();

        $recipe41 = new Recipes;
        $recipe41->productID = '20';
        $recipe41->ingredientID = '37';
        $recipe41->quantity = '1';
        $recipe41->save();

        $recipe42 = new Recipes;
        $recipe42->productID = '21';
        $recipe42->ingredientID = '27';
        $recipe42->quantity = '1';
        $recipe42->save();

        $recipe42 = new Recipes;
        $recipe42->productID = '21';
        $recipe42->ingredientID = '37';
        $recipe42->quantity = '1';
        $recipe42->save();

        $recipe43 = new Recipes;
        $recipe43->productID = '22';
        $recipe43->ingredientID = '45';
        $recipe43->quantity = '100';
        $recipe43->save();

        $recipe44 = new Recipes;
        $recipe44->productID = '22';
        $recipe44->ingredientID = '49';
        $recipe44->quantity = '1';
        $recipe44->save();

        $recipe45 = new Recipes;
        $recipe45->productID = '22';
        $recipe45->ingredientID = '29';
        $recipe45->quantity = '1';
        $recipe45->save();

        $recipe46 = new Recipes;
        $recipe46->productID = '22';
        $recipe46->ingredientID = '44';
        $recipe46->quantity = '1';
        $recipe46->save();

        $recipe47 = new Recipes;
        $recipe47->productID = '22';
        $recipe47->ingredientID = '30';
        $recipe47->quantity = '1';
        $recipe47->save();

        $recipe48 = new Recipes;
        $recipe48->productID = '22';
        $recipe48->ingredientID = '43';
        $recipe48->quantity = '1';
        $recipe48->save();

        $recipe49 = new Recipes;
        $recipe49->productID = '25';
        $recipe49->ingredientID = '52';
        $recipe49->quantity = '115';
        $recipe49->save();

        $recipe50 = new Recipes;
        $recipe50->productID = '25';
        $recipe50->ingredientID = '21';
        $recipe50->quantity = '1';
        $recipe50->save();

        $recipe51 = new Recipes;
        $recipe51->productID = '25';
        $recipe51->ingredientID = '46';
        $recipe51->quantity = '1';
        $recipe51->save();

        $recipe52 = new Recipes;
        $recipe52->productID = '26';
        $recipe52->ingredientID = '53';
        $recipe52->quantity = '1';
        $recipe52->save();

        $recipe53 = new Recipes;
        $recipe53->productID = '26';
        $recipe53->ingredientID = '21';
        $recipe53->quantity = '1';
        $recipe53->save();

        $recipe54 = new Recipes;
        $recipe54->productID = '27';
        $recipe54->ingredientID = '52';
        $recipe54->quantity = '1';
        $recipe54->save();

        $recipe55 = new Recipes;
        $recipe55->productID = '27';
        $recipe55->ingredientID = '53';
        $recipe55->quantity = '1';
        $recipe55->save();

        $recipe56 = new Recipes;
        $recipe56->productID = '27';
        $recipe56->ingredientID = '21';
        $recipe56->quantity = '1';
        $recipe56->save();

        $recipe57 = new Recipes;
        $recipe57->productID = '27';
        $recipe57->ingredientID = '46';
        $recipe57->quantity = '1';
        $recipe57->save();

        $recipe58 = new Recipes;
        $recipe58->productID = '28';
        $recipe58->ingredientID = '44';
        $recipe58->quantity = '1';
        $recipe58->save();

        $recipe59 = new Recipes;
        $recipe59->productID = '28';
        $recipe59->ingredientID = '21';
        $recipe59->quantity = '1';
        $recipe59->save();

        $recipe60 = new Recipes;
        $recipe60->productID = '28';
        $recipe60->ingredientID = '37';
        $recipe60->quantity = '1';
        $recipe60->save();

        $recipe61 = new Recipes;
        $recipe61->productID = '29';
        $recipe61->ingredientID = '44';
        $recipe61->quantity = '1';
        $recipe61->save();

        $recipe62 = new Recipes;
        $recipe62->productID = '29';
        $recipe62->ingredientID = '21';
        $recipe62->quantity = '1';
        $recipe62->save();

        $recipe63 = new Recipes;
        $recipe63->productID = '29';
        $recipe63->ingredientID = '37';
        $recipe63->quantity = '1';
        $recipe63->save();

        $recipe64 = new Recipes;
        $recipe64->productID = '29';
        $recipe64->ingredientID = '39';
        $recipe64->quantity = '8';
        $recipe64->save();

        $recipe65 = new Recipes;
        $recipe65->productID = '31';
        $recipe65->ingredientID = '44';
        $recipe65->quantity = '1';
        $recipe65->save(); 

        $recipe66 = new Recipes;
        $recipe66->productID = '31';
        $recipe66->ingredientID = '21';
        $recipe66->quantity = '1';
        $recipe66->save();

        $recipe67 = new Recipes;
        $recipe67->productID = '31';
        $recipe67->ingredientID = '37';
        $recipe67->quantity = '1';
        $recipe67->save();

        $recipe68 = new Recipes;
        $recipe68->productID = '31';
        $recipe68->ingredientID = '1';
        $recipe68->quantity = '120';
        $recipe68->save();

        $recipe69 = new Recipes;
        $recipe69->productID = '32';
        $recipe69->ingredientID = '44';
        $recipe69->quantity = '1';
        $recipe69->save();

        $recipe70 = new Recipes;
        $recipe70->productID = '32';
        $recipe70->ingredientID = '21';
        $recipe70->quantity = '1';
        $recipe70->save();

        $recipe71 = new Recipes;
        $recipe71->productID = '32';
        $recipe71->ingredientID = '37';
        $recipe71->quantity = '1';
        $recipe71->save();

        $recipe72 = new Recipes;
        $recipe72->productID = '32';
        $recipe72->ingredientID = '2';
        $recipe72->quantity = '120';
        $recipe72->save();

        $recipe73 = new Recipes;
        $recipe73->productID = '34';
        $recipe73->ingredientID = '11';
        $recipe73->quantity = '100';
        $recipe73->save();

        $recipe74 = new Recipes;
        $recipe74->productID = '34';
        $recipe74->ingredientID = '10';
        $recipe74->quantity = '250';
        $recipe74->save();

        $recipe75 = new Recipes;
        $recipe75->productID = '34';
        $recipe75->ingredientID = '26';
        $recipe75->quantity = '1';
        $recipe75->save();

        $recipe76 = new Recipes;
        $recipe76->productID = '35';
        $recipe76->ingredientID = '10';
        $recipe76->quantity = '250';
        $recipe76->save();

        $recipe77 = new Recipes;
        $recipe77->productID = '35';
        $recipe77->ingredientID = '31';
        $recipe77->quantity = '';
        $recipe77->save();

        $recipe78 = new Recipes;
        $recipe78->productID = '35';
        $recipe78->ingredientID = '14';
        $recipe78->quantity = '';
        $recipe78->save();

        $recipe79 = new Recipes;
        $recipe79->productID = '35';
        $recipe79->ingredientID = '54';
        $recipe79->quantity = '1';
        $recipe79->save();

        $recipe80 = new Recipes;
        $recipe80->productID = '35';
        $recipe80->ingredientID = '55';
        $recipe80->quantity = '1';
        $recipe80->save();

        $recipe81 = new Recipes;
        $recipe81->productID = '36';
        $recipe81->ingredientID = '10';
        $recipe81->quantity = '250';
        $recipe81->save();
        
        $recipe82 = new Recipes;
        $recipe82->productID = '36';
        $recipe82->ingredientID = '31';
        $recipe82->quantity = '';
        $recipe82->save();

        $recipe83 = new Recipes;
        $recipe83->productID = '36';
        $recipe83->ingredientID = '15';
        $recipe83->quantity = '1';
        $recipe83->save();

        $recipe84 = new Recipes;
        $recipe84->productID = '36';
        $recipe84->ingredientID = '18';
        $recipe84->quantity = '3';
        $recipe84->save();

        $recipe85 = new Recipes;
        $recipe85->productID = '36';
        $recipe85->ingredientID = '16';
        $recipe85->quantity = '1';
        $recipe85->save();

        $recipe86 = new Recipes;
        $recipe86->productID = '36';
        $recipe86->ingredientID = '14';
        $recipe86->quantity = '1';
        $recipe86->save();

        $recipe87 = new Recipes;
        $recipe87->productID = '36';
        $recipe87->ingredientID = '32';
        $recipe87->quantity = '1';
        $recipe87->save();

        $recipe88 = new Recipes;
        $recipe88->productID = '37';
        $recipe88->ingredientID = '10';
        $recipe88->quantity = '350';
        $recipe88->save();

        $recipe89 = new Recipes;
        $recipe89->productID = '38';
        $recipe89->ingredientID = '31';
        $recipe89->quantity = '1';
        $recipe89->save();

        $recipe90 = new Recipes;
        $recipe90->productID = '38';
        $recipe90->ingredientID = '19';
        $recipe90->quantity = '1';
        $recipe90->save();

        $recipe91 = new Recipes;
        $recipe91->productID = '39';
        $recipe91->ingredientID = '10';
        $recipe91->quantity = '250';
        $recipe91->save();

        $recipe92 = new Recipes;
        $recipe92->productID = '39';
        $recipe92->ingredientID = '31';
        $recipe92->quantity = '1';
        $recipe92->save();

        $recipe93 = new Recipes;
        $recipe93->productID = '40';
        $recipe93->ingredientID = '2';
        $recipe93->quantity = '250';
        $recipe93->save();

        $recipe94 = new Recipes;
        $recipe94->productID = '40';
        $recipe94->ingredientID = '1';
        $recipe94->quantity = '250';
        $recipe94->save();

        $recipe95 = new Recipes;
        $recipe95->productID = '40';
        $recipe95->ingredientID = '21';
        $recipe95->quantity = '1';
        $recipe95->save();

        $recipe96 = new Recipes;
        $recipe96->productID = '40';
        $recipe96->ingredientID = '37';
        $recipe96->quantity = '1';
        $recipe96->save();

        $recipe97 = new Recipes;
        $recipe97->productID = '41';
        $recipe97->ingredientID = '10';
        $recipe97->quantity = '150';
        $recipe97->save();

        $recipe98 = new Recipes;
        $recipe98->productID = '42';
        $recipe98->ingredientID = '40';
        $recipe98->quantity = '250';
        $recipe98->save();

        $recipe99 = new Recipes;
        $recipe99->productID = '42';
        $recipe99->ingredientID = '37';
        $recipe99->quantity = '1';
        $recipe99->save();

        $recipe100 = new Recipes;
        $recipe100->productID = '43';
        $recipe100->ingredientID = '31';
        $recipe100->quantity = '1';
        $recipe100->save();

        $recipe101 = new Recipes;
        $recipe101->productID = '43';
        $recipe101->ingredientID = '10';
        $recipe101->quantity = '150';
        $recipe101->save();

        $recipe102 = new Recipes;
        $recipe102->productID = '44';
        $recipe102->ingredientID = '31';
        $recipe102->quantity = '1';
        $recipe102->save();

        $recipe103 = new Recipes;
        $recipe103->productID = '44';
        $recipe103->ingredientID = '10';
        $recipe103->quantity = '150';
        $recipe103->save();

        $recipe104 = new Recipes;
        $recipe104->productID = '44';
        $recipe104->ingredientID = '19';
        $recipe104->quantity = '1';
        $recipe104->save();

        $recipe105 = new Recipes;
        $recipe105->productID = '45';
        $recipe105->ingredientID = '10';
        $recipe105->quantity = '250';
        $recipe105->save();

        $recipe106 = new Recipes;
        $recipe106->productID = '45';
        $recipe106->ingredientID = '31';
        $recipe106->quantity = '1';
        $recipe106->save();

        $recipe107 = new Recipes;
        $recipe107->productID = '45';
        $recipe107->ingredientID = '15';
        $recipe107->quantity = '1';
        $recipe107->save();

        $recipe108 = new Recipes;
        $recipe108->productID = '45';
        $recipe108->ingredientID = '14';
        $recipe108->quantity = '1';
        $recipe108->save();

        $recipe109 = new Recipes;
        $recipe109->productID = '45';
        $recipe109->ingredientID = '18';
        $recipe109->quantity = '3';
        $recipe109->save();

        $recipe110 = new Recipes;
        $recipe110->productID = '45';
        $recipe110->ingredientID = '33';
        $recipe110->quantity = '1';
        $recipe110->save();

        $recipe111 = new Recipes;
        $recipe111->productID = '45';
        $recipe111->ingredientID = '26';
        $recipe111->quantity = '1';
        $recipe111->save();

        $recipe112 = new Recipes;
        $recipe112->productID = '45';
        $recipe112->ingredientID = '56';
        $recipe112->quantity = '1';
        $recipe112->save();

        $recipe113 = new Recipes;
        $recipe113->productID = '46';
        $recipe113->ingredientID = '10';
        $recipe113->quantity = '250';
        $recipe113->save();

        $recipe114 = new Recipes;
        $recipe114->productID = '46';
        $recipe114->ingredientID = '12';
        $recipe114->quantity = '1';
        $recipe114->save();

        $recipe115 = new Recipes;
        $recipe115->productID = '46';
        $recipe115->ingredientID = '12';
        $recipe115->quantity = '120';
        $recipe115->save();

        $recipe116 = new Recipes;
        $recipe116->productID = '46';
        $recipe116->ingredientID = '34';
        $recipe116->quantity = '1';
        $recipe116->save();

        $recipe117 = new Recipes;
        $recipe117->productID = '46';
        $recipe117->ingredientID = '11';
        $recipe117->quantity = '1';
        $recipe117->save();

        $recipe118 = new Recipes;
        $recipe118->productID = '46';
        $recipe118->ingredientID = '26';
        $recipe118->quantity = '1';
        $recipe118->save();

        $recipe119 = new Recipes;
        $recipe119->productID = '52';
        $recipe119->ingredientID = '48';
        $recipe119->quantity = '300';
        $recipe119->save();

        $recipe120 = new Recipes;
        $recipe120->productID = '53';
        $recipe120->ingredientID = '48';
        $recipe120->quantity = '300';
        $recipe120->save();

        $recipe121 = new Recipes;
        $recipe121->productID = '54';
        $recipe121->ingredientID = '48';
        $recipe121->quantity = '300';
        $recipe121->save();

        $recipe122 = new Recipes;
        $recipe122->productID = '55';
        $recipe122->ingredientID = '48';
        $recipe122->quantity = '300';
        $recipe122->save();

        $recipe123 = new Recipes;
        $recipe123->productID = '57';
        $recipe123->ingredientID = '47';
        $recipe123->quantity = '1';
        $recipe123->save();

        $recipe124 = new Recipes;
        $recipe124->productID = '58';
        $recipe124->ingredientID = '22';
        $recipe124->quantity = '5';
        $recipe124->save();

        $recipe125 = new Recipes;
        $recipe125->productID = '58';
        $recipe125->ingredientID = '35';
        $recipe125->quantity = '1';
        $recipe125->save();

        $recipe126 = new Recipes;
        $recipe126->productID = '59';
        $recipe126->ingredientID = '23';
        $recipe126->quantity = '1';
        $recipe126->save();

        $recipe127 = new Recipes;
        $recipe127->productID = '59';
        $recipe127->ingredientID = '36';
        $recipe127->quantity = '1';
        $recipe127->save();

        $recipe128 = new Recipes;
        $recipe128->productID = '60';
        $recipe128->ingredientID = '24';
        $recipe128->quantity = '1';
        $recipe128->save();

        $recipe129 = new Recipes;
        $recipe129->productID = '60';
        $recipe129->ingredientID = '36';
        $recipe129->quantity = '1';
        $recipe129->save();

        $recipe130 = new Recipes;
        $recipe130->productID = '63';
        $recipe130->ingredientID = '57';
        $recipe130->quantity = '1';
        $recipe130->save();

        $recipe131 = new Recipes;
        $recipe131->productID = '64';
        $recipe131->ingredientID = '58';
        $recipe131->quantity = '1';
        $recipe131->save();

        $recipe132 = new Recipes;
        $recipe132->productID = '65';
        $recipe132->ingredientID = '59';
        $recipe132->quantity = '1';
        $recipe132->save();

        $recipe133 = new Recipes;
        $recipe133->productID = '66';
        $recipe133->ingredientID = '60';
        $recipe133->quantity = '1';
        $recipe133->save();

        $recipe134 = new Recipes;
        $recipe134->productID = '67';
        $recipe134->ingredientID = '61';
        $recipe134->quantity = '1';
        $recipe134->save();

        $recipe135 = new Recipes;
        $recipe135->productID = '68';
        $recipe135->ingredientID = '62';
        $recipe135->quantity = '1';
        $recipe135->save();

        $recipe136 = new Recipes;
        $recipe136->productID = '69';
        $recipe136->ingredientID = '63';
        $recipe136->quantity = '1';
        $recipe136->save();

        $recipe137 = new Recipes;
        $recipe137->productID = '70';
        $recipe137->ingredientID = '64';
        $recipe137->quantity = '1';
        $recipe137->save();

        $recipe138 = new Recipes;
        $recipe138->productID = '71';
        $recipe138->ingredientID = '65';
        $recipe138->quantity = '1';
        $recipe138->save();

        $recipe139 = new Recipes;
        $recipe139->productID = '72';
        $recipe139->ingredientID = '66';
        $recipe139->quantity = '1';
        $recipe139->save();

        $recipe140 = new Recipes;
        $recipe140->productID = '73';
        $recipe140->ingredientID = '67';
        $recipe140->quantity = '1';
        $recipe140->save();

        $recipe141 = new Recipes;
        $recipe141->productID = '74';
        $recipe141->ingredientID = '68';
        $recipe141->quantity = '1';
        $recipe141->save();

        $recipe142 = new Recipes;
        $recipe142->productID = '75';
        $recipe142->ingredientID = '69';
        $recipe142->quantity = '1';
        $recipe142->save();

        $recipe143 = new Recipes;
        $recipe143->productID = '76';
        $recipe143->ingredientID = '70';
        $recipe143->quantity = '1';
        $recipe143->save();

        $recipe144 = new Recipes;
        $recipe144->productID = '77';
        $recipe144->ingredientID = '71';
        $recipe144->quantity = '1';
        $recipe144->save();

        $recipe145 = new Recipes;
        $recipe145->productID = '78';
        $recipe145->ingredientID = '72';
        $recipe145->quantity = '1';
        $recipe145->save();     
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
