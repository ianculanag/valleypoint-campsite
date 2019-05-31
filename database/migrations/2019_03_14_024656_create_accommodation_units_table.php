<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_units', function (Blueprint $table) {
            $table->integer('accommodationID')->unsigned();
            $table->integer('unitID')->unsigned();         
            $table->primary(['accommodationID', 'unitID']);
            $table->integer('numberOfPax');
            //$table->integer('numberOfGroups')->nullable();
            $table->integer('numberOfBunks')->nullable();
            //$table->integer('groupID')->nullable();
            $table->dateTime('checkinDatetime');
            $table->dateTime('checkoutDatetime');
            $table->integer('serviceID')->default(5);
            $table->enum('status', ['ongoing','finished', 'void']);
            //$table->foreign('accommodationID')->references('id')->on('Accommodations');
            //$table->foreign('unitID')->references('id')->on('Units');            
            //$table->foreign('serviceID')->references('id')->on('Services');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accommodation_units');
    }
}
