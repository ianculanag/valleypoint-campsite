<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('paymentDatetime');
            $table->double('amount', 8, 2);
            $table->double('changeDue', 8, 2);
            $table->enum('paymentStatus', ['partial', 'full', 'void']);
            $table->integer('chargeID')->unsigned()->nullable();
            $table->integer('orderID')->unsigned()->nullable();
            $table->string('referenceNumber')->nullable();
            //$table->foreign('chargeID')->references('id')->on('Charge');
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
        Schema::dropIfExists('payments');
    }
}
