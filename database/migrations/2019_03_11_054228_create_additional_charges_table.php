<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_charges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accommodationID')->unsigned();
            $table->integer('serviceID')->unsigned()->nullable();
            $table->integer('numberOfPax')->unsigned()->default(1);
            $table->integer('orderID')->unsigned()->nullable();
            $table->double('totalPrice', 8, 2);            
            $table->enum('paymentStatus',['pending','paid']); 
            $table->foreign('accommodationID')->references('id')->on('Accommodation');
            $table->foreign('serviceID')->references('id')->on('Services');
            $table->foreign('orderID')->references('id')->on('Orders');
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
        Schema::dropIfExists('additional_charges');
    }
}
