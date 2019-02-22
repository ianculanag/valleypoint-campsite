<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('capacity');
            $table->enum('status',['available','reserved','occupied']);
            $table->timestamps();
        });

        DB::table('units')->insert(
            array(
                'unitNumber' => '01',
                'unitType' => 'room',
                'capacity' => '10',
                'status' => 'available'
            )
        );
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
