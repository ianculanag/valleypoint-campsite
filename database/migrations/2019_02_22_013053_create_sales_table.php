<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('paymentDatetime');
            $table->double('amount', 8, 2);
            $table->enum('paymentCategory', ['lodging', 'restobar']);
            $table->integer('orderID')->unsigned()->nullable();
            $table->integer('accommodationID')->unsigned()->nullable();                    
            $table->integer('serviceID')->unsigned()->nullable();
            //$table->foreign('orderID')->references('id')->on('Orders');
            //$table->foreign('accommodationID')->references('id')->on('Accommodation');   
            //$table->foreign('serviceID')->references('id')->on('Services');    
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
        Schema::dropIfExists('sales');
    }
}
