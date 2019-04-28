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
            $table->enum('serviceType', ['package', 'service', 'damage', 'extra']);
            $table->string('serviceName');
            $table->double('price', 8, 2);
            $table->double('leanPrice', 8, 2);
            $table->double('peakPrice', 8, 2);
            $table->timestamps();
            //$table->softDeletes();
        });

        $service1 = new Services;
        $service1->serviceType = 'package';
        $service1->serviceName = 'Glamping Solo';
        $service1->price = '1350.00';
        $service1->leanPrice = '1350.00';
        $service1->peakPrice = '1350.00';
        $service1->save();

        $service2 = new Services;
        $service2->serviceType = 'package';
        $service2->serviceName = 'Glamping 2 pax';
        $service2->price = '1250.00';
        $service2->leanPrice = '1250.00';
        $service2->peakPrice = '1250.00';
        $service2->save();

        $service3 = new Services;
        $service3->serviceType = 'package';
        $service3->serviceName = 'Glamping 3 pax';
        $service3->price = '1000.00';
        $service3->leanPrice = '1000.00';
        $service3->peakPrice = '1000.00';
        $service3->save();

        $service4 = new Services;
        $service4->serviceType = 'package';
        $service4->serviceName = 'Glamping 4 pax';
        $service4->price = '850.00';
        $service4->leanPrice = '850.00';
        $service4->peakPrice = '850.00';
        $service4->save();

        $service5 = new Services;
        $service5->serviceType = 'package';
        $service5->serviceName = 'Backpacker';
        $service5->price = '750.00';
        $service5->leanPrice = '750.00';
        $service5->peakPrice = '750.00';
        $service5->save();

        $service6 = new Services;
        $service6->serviceType = 'service';
        $service6->serviceName = 'Airsoft';
        $service6->price = '500.00';
        $service6->leanPrice = '500.00';
        $service6->peakPrice = '500.00';
        $service6->save();

        $service7 = new Services;
        $service7->serviceType = 'service';
        $service7->serviceName = 'Archery';
        $service7->price = '500.00';
        $service7->leanPrice = '500.00';
        $service7->peakPrice = '500.00';
        $service7->save();

        $service8 = new Services;
        $service8->serviceType = 'damage';
        $service8->serviceName = 'Shoe box';
        $service8->price = '500.00';
        $service8->leanPrice = '500.00';
        $service8->peakPrice = '500.00';
        $service8->save();

        $service9 = new Services;
        $service9->serviceType = 'damage';
        $service9->serviceName = 'Pillow case';
        $service9->price = '250.00';
        $service9->leanPrice = '250.00';
        $service9->peakPrice = '250.00';
        $service9->save();

        $service10 = new Services;
        $service10->serviceType = 'damage';
        $service10->serviceName = 'Pillow';
        $service10->price = '500.00';
        $service10->leanPrice = '500.00';
        $service10->peakPrice = '500.00';
        $service10->save();

        $service11 = new Services;
        $service11->serviceType = 'damage';
        $service11->serviceName = 'Blanket';
        $service11->price = '1000.00';
        $service11->leanPrice = '1000.00';
        $service11->peakPrice = '1000.00';
        $service11->save();

        $service12 = new Services;
        $service12->serviceType = 'damage';
        $service12->serviceName = 'Bedsheet';
        $service12->price = '1000.00';
        $service12->leanPrice = '1000.00';
        $service12->peakPrice = '1000.00';
        $service12->save();

        $service13 = new Services;
        $service13->serviceType = 'damage';
        $service13->serviceName = 'Foam';
        $service13->price = '5000.00';
        $service13->leanPrice = '5000.00';
        $service13->peakPrice = '5000.00';
        $service13->save();

        $service14 = new Services;
        $service14->serviceType = 'damage';
        $service14->serviceName = 'Tent';
        $service14->price = '8000.00';
        $service14->leanPrice = '8000.00';
        $service14->peakPrice = '8000.00';
        $service14->save();

        $service15 = new Services;
        $service15->serviceType = 'extra';
        $service15->serviceName = 'Pillow';
        $service15->price = '100.00';
        $service15->leanPrice = '100.00';
        $service15->peakPrice = '100.00';
        $service15->save();

        $service16 = new Services;
        $service16->serviceType = 'extra';
        $service16->serviceName = 'Bedsheet';
        $service16->price = '200.00';
        $service16->leanPrice = '200.00';
        $service16->peakPrice = '200.00';
        $service16->save();

        $service17 = new Services;
        $service17->serviceType = 'extra';
        $service17->serviceName = 'Blanket';
        $service17->price = '150.00';
        $service17->leanPrice = '150.00';
        $service17->peakPrice = '150.00';
        $service17->save();
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
