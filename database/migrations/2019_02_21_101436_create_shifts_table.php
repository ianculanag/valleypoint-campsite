<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Shifts;
use Carbon\Carbon;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cashierName');
            $table->datetime('shiftStart');
            $table->datetime('shiftEnd');
            $table->double('cashStart', 8, 2);
            $table->double('cashEnd', 8, 2);
            $table->integer('userID')->unsigned();
            //$table->foreign('userID')->references('id')->on('User');
            $table->timestamps();
        });

        $shift = new Shifts();
        $shift->ShiftStart=Carbon::now()->format('Y-m-d h:i:s');
        $shift->shiftEnd="2019-07-20 11:35:23";
        $shift->cashStart="0";
        $shift->cashEnd="500";
        $shift->cashierName="Joshua";
        $shift->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
