<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoidTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('void_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('accommodationID')->unsigned()->nullable(); 
            $table->integer('reservationID')->unsigned()->nullable();
            $table->integer('userID')->unsigned(); 
            $table->longText('remarks');
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
        Schema::dropIfExists('void_transactions');
    }
}
