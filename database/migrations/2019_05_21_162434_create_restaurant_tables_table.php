<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\RestaurantTable;

class CreateRestaurantTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurant_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tableNumber');
            $table->enum('status', ['occupied','available']);
            $table->timestamps();
        });

        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 1';
        $tables->status = 'available';
        $tables->save();

        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 2';
        $tables->status = 'available';
        $tables->save();

        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 3';
        $tables->status = 'available';
        $tables->save();

        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 4';
        $tables->status = 'available';
        $tables->save();
        
        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 5';
        $tables->status = 'available';
        $tables->save();
        
        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 6';
        $tables->status = 'available';
        $tables->save();
        
        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 7';
        $tables->status = 'available';
        $tables->save();
        
        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 8';
        $tables->status = 'available';
        $tables->save();

        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 9';
        $tables->status = 'available';
        $tables->save();

        
        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 10';
        $tables->status = 'available';
        $tables->save();

        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 11';
        $tables->status = 'available';
        $tables->save();

        $tables = new RestaurantTable;
        $tables->tableNumber = 'Table 12';
        $tables->status = 'available';
        $tables->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurant_tables');
    }
}
