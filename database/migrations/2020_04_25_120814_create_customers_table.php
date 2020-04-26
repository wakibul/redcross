<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->BigIncrements('id');
            $table->string('name');
            $table->string('mobile',20)->unique();
            $table->string('email')->nullable();
            $table->string('gender',10);
            $table->string('password');
            $table->integer('otp')->nullable();
            $table->integer('otp_verified')->nullable();
            $table->boolean('status')->default(0);
            $table->boolean('is_member')->default(0);
            $table->string('device_id')->nullable();
            $table->string('fcm_token')->nullable();
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::drop('customers');
    }
}
