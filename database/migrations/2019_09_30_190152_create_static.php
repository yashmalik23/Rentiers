<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staticvalues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recentproperties');
            $table->string('rentalproperties');
            $table->string('buyproperties');
            $table->integer('clientlogolength');
            $table->integer('mainprojectlength');
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
        Schema::dropIfExists('staticvalues');
    }
}
