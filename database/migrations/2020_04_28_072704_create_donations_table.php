<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('customer_id')->unsigned();
            $table->string('name');
            $table->string('age',50);
            $table->string('sex',50);
            $table->text('address');
            $table->string('village_town');
            $table->string('district',100);
            $table->integer('pincode');
            $table->string('mobile',20);
            $table->string('email')->nullable();
            $table->BigInteger('country_id')->unsigned();
            $table->BigInteger('state_id')->unsigned();
            $table->float('donation_amount',10,2);
            $table->text('donation_purpose');
            $table->string('pan_no');
            $table->boolean('status')->default(0);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donations');
    }
}
