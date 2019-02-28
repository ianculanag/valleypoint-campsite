<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->unique();            
            $table->string('name');
            //$table->string('firstName');
            $table->enum('role',['admin', 'general', 'lodging', 'cashier']);
            $table->string('contactNumber')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        /*DB::table('users')->insert(
            array(
                'username' => 'lodging1',
                'password' => 'lodging1',
                'lastName' => 'Aquino',
                'firstName' => 'Jhaypee',
                'role' => 'lodging',
                'contactNumber' => '09000000000',
                'email' => 'jhaypee@valleypoint.com'
            )
        );*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
