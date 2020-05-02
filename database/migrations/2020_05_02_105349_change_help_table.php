<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHelpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('helps', function (Blueprint $table) {
            //
            $table->boolean('blood_donation')->default(0)->nullable()->charset(null)->collation(null)->change();
            $table->string('blood_group',20)->nullable()->after('blood_donation');
            $table->boolean('relief')->default(0)->nullable()->charset(null)->collation(null)->change();
            $table->boolean('medical_assistance')->nullable()->charset(null)->collation(null)->default(0)->change();
            $table->boolean('other')->default(0)->nullable();
            $table->text('message')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('helps', function (Blueprint $table) {
            //
        });
    }
}
