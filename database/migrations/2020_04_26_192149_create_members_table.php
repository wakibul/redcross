<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('customers_id')->unsigned();
            $table->string('name');
            $table->string('age',50);
            $table->string('sex',50);
            $table->text('address');
            $table->string('village_town');
            $table->string('district');
            $table->integer('pincode');
            $table->string('mobile');
            $table->string('email');
            $table->boolean('voluntary_service')->default(0);
            $table->BigInteger('member_package_id')->unsigned();
            $table->boolean('status')->default(0);
            $table->dateTime('approve_at')->nullable();
            $table->BigInteger('approve_by')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('member_package_id')->references('id')->on('member_packages')->onDelete('cascade');
            $table->foreign('customers_id')->references('id')->on('customers')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
