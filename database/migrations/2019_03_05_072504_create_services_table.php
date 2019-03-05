<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('serviceName');
            $table->double('price', 8, 2);
            $table->timestamps();
        });

        // Insert the services
        DB::table('services')->insert(
            array(
                'serviceName' => 'Glamping Solo',
                'price' => '1350',
            ),
            array(
                'serviceName' => 'Glamping 2 pax',
                'price' => '2500',
            ),
            array(
                'serviceName' => 'Glamping 3 pax',
                'price' => '3000',
            ),
            array(
                'serviceName' => 'Glamping 4 pax',
                'price' => '3400',
            ),
            array(
                'serviceName' => 'Transient',
                'price' => '750',
            ),
            array(
                'serviceName' => 'Backpacker',
                'price' => '750',
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
