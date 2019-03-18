<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_units', function (Blueprint $table) {
            $table->integer('reservationID')->unsigned();
            $table->integer('unitID')->unsigned();         
            $table->primary(['reservationID', 'unitID']);
            $table->enum('status', ['reserved','checkedin', 'canceled']);
            $table->foreign('reservationID')->references('id')->on('Reservations');
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
        Schema::dropIfExists('reservation_units');
    }
}
