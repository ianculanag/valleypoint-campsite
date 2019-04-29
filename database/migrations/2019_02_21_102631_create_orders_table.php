<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orderNumber');
            $table->enum('paymentStatus',['pending','paid']);
            $table->dateTime('orderDatetime');
            $table->integer('productID')->unsigned();
            $table->integer('shiftID')->unsigned();
           // $table->foreign('productID')->references('id')->on('Products');
            //$table->foreign('shiftID')->references('id')->on('Shifts');
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
        Schema::dropIfExists('orders');
    }
}
