<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('accommodations', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('accommodationType',['transient','backpacker','glamping']);
            $table->double('price', 8, 2);
            $table->enum('paymentStatus',['pending','paid']);
            $table->integer('userID')->unsigned();
            $table->integer('unitID')->unsigned();
            $table->foreign('userID')->references('id')->on('User');
            $table->foreign('unitID')->references('id')->on('Units');
            $table->timestamps();
        });*/

        Schema::create('accommodations', function (Blueprint $table) {
            $table->increments('id');                  
            $table->integer('numberOfPax')->default(1);
            $table->integer('numberOfUnits')->default(1);
            //$table->dateTime('checkinDatetime');
            //$table->dateTime('checkoutDatetime');
            //$table->integer('serviceID')->unsigned();  
            $table->integer('userID')->unsigned();
            //$table->foreign('serviceID')->references('id')->on('Services');
            //$table->foreign('userID')->references('id')->on('User');
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
        Schema::dropIfExists('accommodations');
    }
}
