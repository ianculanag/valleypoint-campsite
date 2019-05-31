<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->increments('id');         
            $table->integer('serviceID')->unsigned();              
            $table->integer('quantity');
            $table->double('totalPrice', 8, 2);
            $table->double('balance', 8, 2);
            $table->enum('remarks', ['unpaid', 'partial', 'full', 'canceled', 'corrective', 'void']);
            $table->integer('accommodationID')->unsigned()->nullable(); 
            $table->integer('reservationID')->unsigned()->nullable(); 
            $table->integer('unitID')->unsigned()->nullable();
            //$table->foreign('serviceID')->references('id')->on('Service');
            //$table->foreign('accommodationID')->references('id')->on('Accommodations');
            //$table->foreign('reservationID')->references('id')->on('Reservations');
            //$table->foreign('unitID')->references('id')->on('Units');
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
        Schema::dropIfExists('charges');
    }
}
