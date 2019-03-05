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
            $table->string('unitNumber');
            $table->enum('unitType',['room','bed','tent']);
            $table->integer('partOf')->nullable();
            $table->integer('capacity')->default(1);
            $table->enum('status',['available','reserved','occupied']);
            $table->timestamps();
        });

        $unit1 = new Units;
        $unit1->unitNumber = 'Tent1';
        $unit1->unitType = 'tent';
        $unit1->capacity = '4';
        $unit1->status = 'available';
        $unit1->save();

        $unit2 = new Units;
        $unit2->unitNumber = 'Tent2';
        $unit2->unitType = 'tent';
        $unit2->capacity = '4';
        $unit2->status = 'available';
        $unit2->save();

        $unit3 = new Units;
        $unit3->unitNumber = 'Tent3';
        $unit3->unitType = 'tent';
        $unit3->capacity = '4';
        $unit3->status = 'available';
        $unit3->save();

        $unit4 = new Units;
        $unit4->unitNumber = 'Tent4';
        $unit4->unitType = 'tent';
        $unit4->capacity = '4';
        $unit4->status = 'available';
        $unit4->save();

        $unit5 = new Units;
        $unit5->unitNumber = 'Tent5';
        $unit5->unitType = 'tent';
        $unit5->capacity = '4';
        $unit5->status = 'available';
        $unit5->save();

        $unit6 = new Units;
        $unit6->unitNumber = 'Tent6';
        $unit6->unitType = 'tent';
        $unit6->capacity = '4';
        $unit6->status = 'available';
        $unit6->save();

        $unit7 = new Units;
        $unit7->unitNumber = 'Tent7';
        $unit7->unitType = 'tent';
        $unit7->capacity = '4';
        $unit7->status = 'available';
        $unit7->save();

        $unit8 = new Units;
        $unit8->unitNumber = 'Tent8';
        $unit8->unitType = 'tent';
        $unit8->capacity = '4';
        $unit8->status = 'available';
        $unit8->save();

        $unit9 = new Units;
        $unit9->unitNumber = 'Tent9';
        $unit9->unitType = 'tent';
        $unit9->capacity = '4';
        $unit9->status = 'available';
        $unit9->save();

        $unit10 = new Units;
        $unit10->unitNumber = 'Tent10';
        $unit10->unitType = 'tent';
        $unit10->capacity = '4';
        $unit10->status = 'available';
        $unit10->save();

        $unit11 = new Units;
        $unit11->unitNumber = 'Tent11';
        $unit11->unitType = 'tent';
        $unit11->capacity = '4';
        $unit11->status = 'available';
        $unit11->save();

        $unit12 = new Units;
        $unit12->unitNumber = 'Tent12';
        $unit12->unitType = 'tent';
        $unit12->capacity = '4';
        $unit12->status = 'available';
        $unit12->save();

        $unit13 = new Units;
        $unit13->unitNumber = 'Tent13';
        $unit13->unitType = 'tent';
        $unit13->capacity = '4';
        $unit13->status = 'available';
        $unit13->save();

        $unit14 = new Units;
        $unit14->unitNumber = 'Tent14';
        $unit14->unitType = 'tent';
        $unit14->capacity = '4';
        $unit14->status = 'available';
        $unit14->save();

        $unit15 = new Units;
        $unit15->unitNumber = 'Tent15';
        $unit15->unitType = 'tent';
        $unit15->capacity = '4';
        $unit15->status = 'available';
        $unit15->save();

        $unit16 = new Units;
        $unit16->unitNumber = 'Tent16';
        $unit16->unitType = 'tent';
        $unit16->capacity = '4';
        $unit16->status = 'available';
        $unit16->save();

        $unit17 = new Units;
        $unit17->unitNumber = 'Tent17';
        $unit17->unitType = 'tent';
        $unit17->capacity = '4';
        $unit17->status = 'available';
        $unit17->save();

        $unit18 = new Units;
        $unit18->unitNumber = 'Tent18';
        $unit18->unitType = 'tent';
        $unit18->capacity = '4';
        $unit18->status = 'available';
        $unit18->save();

        $unit19 = new Units;
        $unit19->unitNumber = 'Tent19';
        $unit19->unitType = 'tent';
        $unit19->capacity = '4';
        $unit19->status = 'available';
        $unit19->save();

        $unit20 = new Units;
        $unit20->unitNumber = 'Tent20';
        $unit20->unitType = 'tent';
        $unit20->capacity = '4';
        $unit20->status = 'available';
        $unit20->save();

        $unit21 = new Units;
        $unit21->unitNumber = 'Room1';
        $unit21->unitType = 'room';
        $unit21->capacity = '4';
        $unit21->status = 'available';
        $unit21->save();

        $unit22 = new Units;
        $unit22->unitNumber = 'Room2';
        $unit22->unitType = 'room';
        $unit22->capacity = '4';
        $unit22->status = 'available';
        $unit22->save();

        $unit23 = new Units;
        $unit23->unitNumber = 'Room3';
        $unit23->unitType = 'room';
        $unit23->capacity = '4';
        $unit23->status = 'available';
        $unit23->save();

        $unit24 = new Units;
        $unit24->unitNumber = 'Room4';
        $unit24->unitType = 'room';
        $unit24->capacity = '6';
        $unit24->status = 'available';
        $unit24->save();

        $unit25 = new Units;
        $unit25->unitNumber = 'Room5';
        $unit25->unitType = 'room';
        $unit25->capacity = '6';
        $unit25->status = 'available';
        $unit25->save();

        $unit26 = new Units;
        $unit26->unitNumber = 'Room6';
        $unit26->unitType = 'room';
        $unit26->capacity = '6';
        $unit26->status = 'available';
        $unit26->save();
        
        $unit27 = new Units;
        $unit27->unitNumber = 'Room7';
        $unit27->unitType = 'room';
        $unit27->capacity = '10';
        $unit27->status = 'available';
        $unit27->save();

        $unit28 = new Units;
        $unit28->unitNumber = 'Room8';
        $unit28->unitType = 'room';
        $unit28->capacity = '10';
        $unit28->status = 'available';
        $unit28->save();

        $unit29 = new Units;
        $unit29->unitNumber = 'Room9';
        $unit29->unitType = 'room';
        $unit29->capacity = '10';
        $unit29->status = 'available';
        $unit29->save();
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
