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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('accommodationType',['transient','backpacker','glamping']);
            $table->double('price', 8, 2);
            $table->enum('paymentStatus',['pending','paid']);
            $table->integer('staffID')->unsigned();
            $table->integer('unitID')->unsigned();
            $table->foreign('staffID')->references('id')->on('Staff');
            $table->foreign('unitID')->references('id')->on('Units');
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
