<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Units;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('unitType',['room','bed','tent','table']);
            $table->string('unitNumber');
            $table->integer('capacity')->default(1);
            $table->integer('partOf')->nullable();
            $table->timestamps();
            //$table->softDeletes();
        });

        $unit1 = new Units;
        $unit1->unitNumber = 'Tent1';
        $unit1->unitType = 'tent';
        $unit1->capacity = '4';
        $unit1->save();

        $unit2 = new Units;
        $unit2->unitNumber = 'Tent2';
        $unit2->unitType = 'tent';
        $unit2->capacity = '4';
        $unit2->save();

        $unit3 = new Units;
        $unit3->unitNumber = 'Tent3';
        $unit3->unitType = 'tent';
        $unit3->capacity = '4';
        $unit3->save();

        $unit4 = new Units;
        $unit4->unitNumber = 'Tent4';
        $unit4->unitType = 'tent';
        $unit4->capacity = '4';
        $unit4->save();

        $unit5 = new Units;
        $unit5->unitNumber = 'Tent5';
        $unit5->unitType = 'tent';
        $unit5->capacity = '4';
        $unit5->save();

        $unit6 = new Units;
        $unit6->unitNumber = 'Tent6';
        $unit6->unitType = 'tent';
        $unit6->capacity = '4';
        $unit6->save();

        $unit7 = new Units;
        $unit7->unitNumber = 'Tent7';
        $unit7->unitType = 'tent';
        $unit7->capacity = '4';
        $unit7->save();

        $unit8 = new Units;
        $unit8->unitNumber = 'Tent8';
        $unit8->unitType = 'tent';
        $unit8->capacity = '4';
        $unit8->save();

        $unit9 = new Units;
        $unit9->unitNumber = 'Tent9';
        $unit9->unitType = 'tent';
        $unit9->capacity = '4';
        $unit9->save();

        $unit10 = new Units;
        $unit10->unitNumber = 'Tent10';
        $unit10->unitType = 'tent';
        $unit10->capacity = '4';
        $unit10->save();

        $unit11 = new Units;
        $unit11->unitNumber = 'Tent11';
        $unit11->unitType = 'tent';
        $unit11->capacity = '4';
        $unit11->save();

        $unit12 = new Units;
        $unit12->unitNumber = 'Tent12';
        $unit12->unitType = 'tent';
        $unit12->capacity = '4';
        $unit12->save();

        $unit13 = new Units;
        $unit13->unitNumber = 'Tent13';
        $unit13->unitType = 'tent';
        $unit13->capacity = '4';
        $unit13->save();

        $unit14 = new Units;
        $unit14->unitNumber = 'Tent14';
        $unit14->unitType = 'tent';
        $unit14->capacity = '4';
        $unit14->save();

        $unit15 = new Units;
        $unit15->unitNumber = 'Tent15';
        $unit15->unitType = 'tent';
        $unit15->capacity = '4';
        $unit15->save();

        $unit16 = new Units;
        $unit16->unitNumber = 'Tent16';
        $unit16->unitType = 'tent';
        $unit16->capacity = '4';
        $unit16->save();

        $unit17 = new Units;
        $unit17->unitNumber = 'Tent17';
        $unit17->unitType = 'tent';
        $unit17->capacity = '4';
        $unit17->save();

        $unit18 = new Units;
        $unit18->unitNumber = 'Tent18';
        $unit18->unitType = 'tent';
        $unit18->capacity = '4';
        $unit18->save();

        $unit19 = new Units;
        $unit19->unitNumber = 'Tent19';
        $unit19->unitType = 'tent';
        $unit19->capacity = '4';
        $unit19->save();

        $unit20 = new Units;
        $unit20->unitNumber = 'Tent20';
        $unit20->unitType = 'tent';
        $unit20->capacity = '4';
        $unit20->save();

        $unit21 = new Units;
        $unit21->unitNumber = 'Room1';
        $unit21->unitType = 'room';
        $unit21->capacity = '4';
        $unit21->save();

        $unit22 = new Units;
        $unit22->unitNumber = 'Room2';
        $unit22->unitType = 'room';
        $unit22->capacity = '6';
        $unit22->save();

        $unit23 = new Units;
        $unit23->unitNumber = 'Room3';
        $unit23->unitType = 'room';
        $unit23->capacity = '10';
        $unit23->save();

        $unit24 = new Units;
        $unit24->unitNumber = 'Room4';
        $unit24->unitType = 'room';
        $unit24->capacity = '4';
        $unit24->save();

        $unit25 = new Units;
        $unit25->unitNumber = 'Room5';
        $unit25->unitType = 'room';
        $unit25->capacity = '5';
        $unit25->save();

        $unit26 = new Units;
        $unit26->unitNumber = 'Room6';
        $unit26->unitType = 'room';
        $unit26->capacity = '3';
        $unit26->save();
        
        $unit27 = new Units;
        $unit27->unitNumber = 'Room7';
        $unit27->unitType = 'room';
        $unit27->capacity = '10';
        $unit27->save();

        $unit28 = new Units;
        $unit28->unitNumber = 'Room8';
        $unit28->unitType = 'room';
        $unit28->capacity = '6';
        $unit28->save();

        $unit29 = new Units;
        $unit29->unitNumber = 'Room9';
        $unit29->unitType = 'room';
        $unit29->capacity = '3';
        $unit29->save();

        $unit31 = new Units;
        $unit31->unitNumber = 'Bed1';
        $unit31->unitType = 'bed';
        $unit31->capacity = '1';
        $unit31->partOf = '21';
        $unit31->save();

        $unit32 = new Units;
        $unit32->unitNumber = 'Bed2';
        $unit32->unitType = 'bed';
        $unit32->capacity = '1';
        $unit32->partOf = '21';
        $unit32->save();

        $unit33 = new Units;
        $unit33->unitNumber = 'Bed3';
        $unit33->unitType = 'bed';
        $unit33->capacity = '1';
        $unit33->partOf = '21';
        $unit33->save();

        $unit34 = new Units;
        $unit34->unitNumber = 'Bed4';
        $unit34->unitType = 'bed';
        $unit34->capacity = '1';
        $unit34->partOf = '21';
        $unit34->save();

        $unit35 = new Units;
        $unit35->unitNumber = 'Bed5';
        $unit35->unitType = 'bed';
        $unit35->capacity = '1';
        $unit35->partOf = '22';
        $unit35->save();

        $unit36 = new Units;
        $unit36->unitNumber = 'Bed6';
        $unit36->unitType = 'bed';
        $unit36->capacity = '1';
        $unit36->partOf = '22';
        $unit36->save();

        $unit37 = new Units;
        $unit37->unitNumber = 'Bed7';
        $unit37->unitType = 'bed';
        $unit37->capacity = '1';
        $unit37->partOf = '22';
        $unit37->save();

        $unit38 = new Units;
        $unit38->unitNumber = 'Bed8';
        $unit38->unitType = 'bed';
        $unit38->capacity = '1';
        $unit38->partOf = '22';
        $unit38->save();

        $unit39 = new Units;
        $unit39->unitNumber = 'Bed9';
        $unit39->unitType = 'bed';
        $unit39->capacity = '1';
        $unit39->partOf = '22';
        $unit39->save();

        $unit40 = new Units;
        $unit40->unitNumber = 'Bed10';
        $unit40->unitType = 'bed';
        $unit40->capacity = '1';
        $unit40->partOf = '22';
        $unit40->save();

        $unit41 = new Units;
        $unit41->unitNumber = 'Bed11';
        $unit41->unitType = 'bed';
        $unit41->capacity = '1';
        $unit41->partOf = '23';
        $unit41->save();
        
        $unit42 = new Units;
        $unit42->unitNumber = 'Bed12';
        $unit42->unitType = 'bed';
        $unit42->capacity = '1';
        $unit42->partOf = '23';
        $unit42->save();

        $unit43 = new Units;
        $unit43->unitNumber = 'Bed13';
        $unit43->unitType = 'bed';
        $unit43->capacity = '1';
        $unit43->partOf = '23';
        $unit43->save();

        $unit44 = new Units;
        $unit44->unitNumber = 'Bed14';
        $unit44->unitType = 'bed';
        $unit44->capacity = '1';
        $unit44->partOf = '23';
        $unit44->save();

        $unit45 = new Units;
        $unit45->unitNumber = 'Bed15';
        $unit45->unitType = 'bed';
        $unit45->capacity = '1';
        $unit45->partOf = '23';
        $unit45->save();

        $unit46 = new Units;
        $unit46->unitNumber = 'Bed16';
        $unit46->unitType = 'bed';
        $unit46->capacity = '1';
        $unit46->partOf = '23';
        $unit46->save();

        $unit47 = new Units;
        $unit47->unitNumber = 'Bed17';
        $unit47->unitType = 'bed';
        $unit47->capacity = '1';
        $unit47->partOf = '23';
        $unit47->save();

        $unit48 = new Units;
        $unit48->unitNumber = 'Bed18';
        $unit48->unitType = 'bed';
        $unit48->capacity = '1';
        $unit48->partOf = '23';
        $unit48->save();

        $unit49 = new Units;
        $unit49->unitNumber = 'Bed19';
        $unit49->unitType = 'bed';
        $unit49->capacity = '1';
        $unit49->partOf = '23';
        $unit49->save();

        $unit50 = new Units;
        $unit50->unitNumber = 'Bed20';
        $unit50->unitType = 'bed';
        $unit50->capacity = '1';
        $unit50->partOf = '23';
        $unit50->save();

        $unit51 = new Units;
        $unit51->unitNumber = 'Bed21';
        $unit51->unitType = 'bed';
        $unit51->capacity = '1';
        $unit51->partOf = '24';
        $unit51->save();

        $unit52 = new Units;
        $unit52->unitNumber = 'Bed22';
        $unit52->unitType = 'bed';
        $unit52->capacity = '1';
        $unit52->partOf = '24';
        $unit52->save();

        $unit53 = new Units;
        $unit53->unitNumber = 'Bed23';
        $unit53->unitType = 'bed';
        $unit53->capacity = '1';
        $unit53->partOf = '24';
        $unit53->save();

        $unit54 = new Units;
        $unit54->unitNumber = 'Bed24';
        $unit54->unitType = 'bed';
        $unit54->capacity = '1';
        $unit54->partOf = '24';
        $unit54->save();

        $unit55 = new Units;
        $unit55->unitNumber = 'Bed25';
        $unit55->unitType = 'bed';
        $unit55->capacity = '1';
        $unit55->partOf = '25';
        $unit55->save();

        $unit56 = new Units;
        $unit56->unitNumber = 'Bed26';
        $unit56->unitType = 'bed';
        $unit56->capacity = '1';
        $unit56->partOf = '25';
        $unit56->save();

        $unit57 = new Units;
        $unit57->unitNumber = 'Bed27';
        $unit57->unitType = 'bed';
        $unit57->capacity = '1';
        $unit57->partOf = '25';
        $unit57->save();

        $unit58 = new Units;
        $unit58->unitNumber = 'Bed28';
        $unit58->unitType = 'bed';
        $unit58->capacity = '1';
        $unit58->partOf = '25';
        $unit58->save();

        $unit59 = new Units;
        $unit59->unitNumber = 'Bed29';
        $unit59->unitType = 'bed';
        $unit59->capacity = '1';
        $unit59->partOf = '25';
        $unit59->save();

        $unit60 = new Units;
        $unit60->unitNumber = 'Bed30';
        $unit60->unitType = 'bed';
        $unit60->capacity = '1';
        $unit60->partOf = '26';
        $unit60->save();

        $unit61 = new Units;
        $unit61->unitNumber = 'Bed31';
        $unit61->unitType = 'bed';
        $unit61->capacity = '1';
        $unit61->partOf = '26';
        $unit61->save();    

        $unit62 = new Units;
        $unit62->unitNumber = 'Bed32';
        $unit62->unitType = 'bed';
        $unit62->capacity = '1';
        $unit62->partOf = '26';
        $unit62->save();    

        $unit63 = new Units;
        $unit63->unitNumber = 'Bed33';
        $unit63->unitType = 'bed';
        $unit63->capacity = '1';
        $unit63->partOf = '27';
        $unit63->save();   

        $unit64 = new Units;
        $unit64->unitNumber = 'Bed34';
        $unit64->unitType = 'bed';
        $unit64->capacity = '1';
        $unit64->partOf = '27';
        $unit64->save();   

        $unit65 = new Units;
        $unit65->unitNumber = 'Bed35';
        $unit65->unitType = 'bed';
        $unit65->capacity = '1';
        $unit65->partOf = '27';
        $unit65->save();   

        $unit66 = new Units;
        $unit66->unitNumber = 'Bed36';
        $unit66->unitType = 'bed';
        $unit66->capacity = '1';
        $unit66->partOf = '27';
        $unit66->save();   

        $unit67 = new Units;
        $unit67->unitNumber = 'Bed37';
        $unit67->unitType = 'bed';
        $unit67->capacity = '1';
        $unit67->partOf = '27';
        $unit67->save();   

        $unit68 = new Units;
        $unit68->unitNumber = 'Bed38';
        $unit68->unitType = 'bed';
        $unit68->capacity = '1';
        $unit68->partOf = '27';
        $unit68->save();   

        $unit69 = new Units;
        $unit69->unitNumber = 'Bed39';
        $unit69->unitType = 'bed';
        $unit69->capacity = '1';
        $unit69->partOf = '27';
        $unit69->save();   

        $unit70 = new Units;
        $unit70->unitNumber = 'Bed40';
        $unit70->unitType = 'bed';
        $unit70->capacity = '1';
        $unit70->partOf = '27';
        $unit70->save();   

        $unit71 = new Units;
        $unit71->unitNumber = 'Bed41';
        $unit71->unitType = 'bed';
        $unit71->capacity = '1';
        $unit71->partOf = '27';
        $unit71->save();   

        $unit72 = new Units;
        $unit72->unitNumber = 'Bed42';
        $unit72->unitType = 'bed';
        $unit72->capacity = '1';
        $unit72->partOf = '27';
        $unit72->save();   

        $unit73 = new Units;
        $unit73->unitNumber = 'Bed43';
        $unit73->unitType = 'bed';
        $unit73->capacity = '1';
        $unit73->partOf = '28';
        $unit73->save();   

        $unit74 = new Units;
        $unit74->unitNumber = 'Bed44';
        $unit74->unitType = 'bed';
        $unit74->capacity = '1';
        $unit74->partOf = '28';
        $unit74->save();   

        $unit75 = new Units;
        $unit75->unitNumber = 'Bed45';
        $unit75->unitType = 'bed';
        $unit75->capacity = '1';
        $unit75->partOf = '28';
        $unit75->save();   

        $unit76 = new Units;
        $unit76->unitNumber = 'Bed46';
        $unit76->unitType = 'bed';
        $unit76->capacity = '1';
        $unit76->partOf = '28';
        $unit76->save();   

        $unit77 = new Units;
        $unit77->unitNumber = 'Bed47';
        $unit77->unitType = 'bed';
        $unit77->capacity = '1';
        $unit77->partOf = '28';
        $unit77->save();   

        $unit78 = new Units;
        $unit78->unitNumber = 'Bed48';
        $unit78->unitType = 'bed';
        $unit78->capacity = '1';
        $unit78->partOf = '28';
        $unit78->save();   

        $unit79 = new Units;
        $unit79->unitNumber = 'Bed49';
        $unit79->unitType = 'bed';
        $unit79->capacity = '1';
        $unit79->partOf = '29';
        $unit79->save();    

        $unit80 = new Units;
        $unit80->unitNumber = 'Bed50';
        $unit80->unitType = 'bed';
        $unit80->capacity = '1';
        $unit80->partOf = '29';
        $unit80->save();   

        $unit81 = new Units;
        $unit81->unitNumber = 'Bed51';
        $unit81->unitType = 'bed';
        $unit81->capacity = '1';
        $unit81->partOf = '29';
        $unit81->save(); 
        
        $unit82 = new Units;
        $unit82->unitNumber = 'Table1';
        $unit82->unitType = 'table';
        $unit82->save();

        $unit83 = new Units;
        $unit83->unitNumber = 'Table2';
        $unit83->unitType = 'table';
        $unit83->save();

        $unit84 = new Units;
        $unit84->unitNumber = 'Table3';
        $unit84->unitType = 'table';
        $unit84->save();

        $unit85 = new Units;
        $unit85->unitNumber = 'Table4';
        $unit85->unitType = 'table';
        $unit85->save();

        $unit86 = new Units;
        $unit86->unitNumber = 'Table5';
        $unit86->unitType = 'table';
        $unit86->save();

        $unit87 = new Units;
        $unit87->unitNumber = 'Table6';
        $unit87->unitType = 'table';
        $unit87->save();

        $unit88 = new Units;
        $unit88->unitNumber = 'Table7';
        $unit88->unitType = 'table';
        $unit88->save();

        $unit89 = new Units;
        $unit89->unitNumber = 'Table8';
        $unit89->unitType = 'table';
        $unit89->save();

        $unit90 = new Units;
        $unit90->unitNumber = 'Table9';
        $unit90->unitType = 'table';
        $unit90->save();

        $unit91 = new Units;
        $unit91->unitNumber = 'Table10';
        $unit91->unitType = 'table';
        $unit91->save();

        $unit92 = new Units;
        $unit92->unitNumber = 'Table11';
        $unit92->unitType = 'table';
        $unit92->save();

        $unit93 = new Units;
        $unit93->unitNumber = 'Table12';
        $unit93->unitType = 'table';
        $unit93->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('units');
    }
}
