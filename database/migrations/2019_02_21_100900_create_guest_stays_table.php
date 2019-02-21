<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestStaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_stays', function (Blueprint $table) {
            $table->integer('guestID')->unsigned();
            $table->integer('accommodationID')->unsigned();
            $table->dateTime('checkinDatetime');
            $table->dateTime('checkoutDatetime');
            $table->foreign('guestID')->references('id')->on('Staff');
            $table->foreign('accommodationID')->references('id')->on('Units');
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
        Schema::dropIfExists('guest_stays');
    }
}
