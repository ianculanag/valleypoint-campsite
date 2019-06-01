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
            $table->integer('queueNumber')->nullable();
            $table->integer('tableNumber')->nullable();
            $table->double('totalBill', 8, 2);
            $table->double('discountAmount', 8, 2)->nullable();
            $table->enum('status',['ongoing','finished', 'cancelled']);
            $table->dateTime('orderDatetime');
            $table->integer('shiftID')->unsigned();
            //$table->string('referenceNumber')->nullable();
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
