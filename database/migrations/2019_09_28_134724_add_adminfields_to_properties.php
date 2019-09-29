<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdminfieldsToProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function ( $table) {
            $table->string('ownerdetails')->nullable();
            $table->string('intmembers')->nullable();      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function ( $table) {
            $table->dropColumn('ownerdetails');
            $table->dropColumn('intmembers');
        });
    }
}
