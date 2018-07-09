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
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->string('code')->nullable();
            $table->string('avatar')->default('default.png');
            $table->integer('active')->default(0);
            $table->integer('role')->default('0');
            $table->decimal('lat', 10,8)->nullable();
            $table->decimal('long', 10,8)->nullable();
            $table->string('device_id',500)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $user = new \App\User();
        $user->name ='اوامر الشبكه';
        $user->email ='aait@info.com';
        $user->password =bcrypt(123456);
        $user->phone ='123456789';
        $user->role ='1';
        $user->device_id ='1111111111';
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
