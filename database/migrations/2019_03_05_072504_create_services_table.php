<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Services;

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

        $service1 = new Services;
        $service1->serviceName = 'Glamping Solo';
        $service1->price = '1350';
        $service1->save();

        $service2 = new Services;
        $service2->serviceName = 'Glamping 2 pax';
        $service2->price = '1250';
        $service2->save();

        $service3 = new Services;
        $service3->serviceName = 'Glamping 3 pax';
        $service3->price = '1000';
        $service3->save();

        $service4 = new Services;
        $service4->serviceName = 'Glamping 4 pax';
        $service4->price = '850';
        $service4->save();

        $service5 = new Services;
        $service5->serviceName = 'Backpacker';
        $service5->price = '750';
        $service5->save();

        $service7 = new Services;
        $service7->serviceName = 'Airsoft';
        $service7->price = '750';
        $service7->save();
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
