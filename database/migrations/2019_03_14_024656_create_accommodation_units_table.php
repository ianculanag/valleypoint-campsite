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
            $table->enum('status', ['ongoing','finished']);
            $table->foreign('accommodationID')->references('id')->on('Accommodations');
            $table->foreign('unitID')->references('id')->on('Units');
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
