<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helps', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('customer_id')->unsigned();
            $table->string('name');
            $table->string('age',50);
            $table->string('sex',50);
            $table->text('address');
            $table->string('village_town');
            $table->string('district');
            $table->integer('pincode');
            $table->string('mobile');
            $table->string('email')->nullable();
            $table->text('blood_donation');
            $table->text('relief');
            $table->text('medical_assistance');
            $table->text('message');
            $table->boolean('status')->default(0);
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('helps');
    }
}
