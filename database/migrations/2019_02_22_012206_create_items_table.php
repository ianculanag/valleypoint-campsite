<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->integer('orderID')->unsigned();
            $table->integer('productID')->unsigned();
            $table->integer('shiftID')->unsigned();
            $table->integer('quantity');
            $table->double('totalPrice', 8, 2);
            $table->enum('paymentStatus',['pending','paid', 'cancelled']);
            //$table->foreign('orderID')->references('id')->on('Orders');
            //$table->foreign('productID')->references('id')->on('Products');
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
        Schema::dropIfExists('items');
    }
}
