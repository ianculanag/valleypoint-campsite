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
            $table->enum('serviceType', ['package', 'service', 'damage']);
            $table->string('serviceName');
            $table->double('price', 8, 2);
            $table->timestamps();
        });

        $service1 = new Services;
        $service1->serviceType = 'package';
        $service1->serviceName = 'Glamping Solo';
        $service1->price = '1350';
        $service1->save();

        $service2 = new Services;
        $service2->serviceType = 'package';
        $service2->serviceName = 'Glamping 2 pax';
        $service2->price = '1250';
        $service2->save();

        $service3 = new Services;
        $service3->serviceType = 'package';
        $service3->serviceName = 'Glamping 3 pax';
        $service3->price = '1000';
        $service3->save();

        $service4 = new Services;
        $service4->serviceType = 'package';
        $service4->serviceName = 'Glamping 4 pax';
        $service4->price = '850';
        $service4->save();

        $service5 = new Services;
        $service5->serviceType = 'package';
        $service5->serviceName = 'Backpacker';
        $service5->price = '750';
        $service5->save();

        $service6 = new Services;
        $service6->serviceType = 'service';
        $service6->serviceName = 'Airsoft';
        $service6->price = '500';
        $service6->save();

        $service7 = new Services;
        $service7->serviceType = 'service';
        $service7->serviceName = 'Archery';
        $service7->price = '500';
        $service7->save();

        $service8 = new Services;
        $service8->serviceType = 'damage';
        $service8->serviceName = 'Shoe box';
        $service8->price = '500';
        $service8->save();

        $service9 = new Services;
        $service9->serviceType = 'damage';
        $service9->serviceName = 'Pillow case';
        $service9->price = '250';
        $service9->save();

        $service10 = new Services;
        $service10->serviceType = 'damage';
        $service10->serviceName = 'Pillow';
        $service10->price = '500';
        $service10->save();

        $service11 = new Services;
        $service11->serviceType = 'damage';
        $service11->serviceName = 'Blanket';
        $service11->price = '1000';
        $service11->save();

        $service12 = new Services;
        $service12->serviceType = 'damage';
        $service12->serviceName = 'Bedsheet';
        $service12->price = '1000';
        $service12->save();

        $service13 = new Services;
        $service13->serviceType = 'damage';
        $service13->serviceName = 'Foam';
        $service13->price = '5000';
        $service13->save();

        $service14 = new Services;
        $service14->serviceType = 'damage';
        $service14->serviceName = 'Tent';
        $service14->price = '8000';
        $service14->save();
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
