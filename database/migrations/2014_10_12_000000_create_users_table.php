<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use App\User;

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
            //$table->softDeletes();
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
        $user = new User;
        $user->username = 'lodging';
        $user->password = Hash::make('lodging');
        $user->name = 'JP Aquino';
        $user->role = 'lodging';
        $user->contactNumber = '09178504634';
        $user->email = 'jpaquino@valleypoint.com';
        $user->save();

        $user = new User;
        $user->username = 'admin';
        $user->password = Hash::make('admin');
        $user->name = 'Jhaypee';
        $user->role = 'admin';
        $user->contactNumber = '09177777634';
        $user->email = 'jhaypee@valleypoint.com';
        $user->save();

        $user = new User;
        $user->username = 'cashier';
        $user->password = Hash::make('cashier');
        $user->name = 'Jay';
        $user->role = 'cashier';
        $user->contactNumber = '09112347634';
        $user->email = 'cashier@valleypoint.com';
        $user->save();

        $user = new User;
        $user->username = 'ervszz';
        $user->password = Hash::make('Fernandez13');
        $user->name = 'Ervin';
        $user->role = 'cashier';
        $user->contactNumber = '09112347634';
        $user->email = 'ervin@valleypoint.com';
        $user->save();
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
