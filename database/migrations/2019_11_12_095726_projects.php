<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('projectName');
            $table->string('streetName');
            $table->string('city');
            $table->string('projectType');
            $table->string('configurations');
            $table->string('basePrice');
            $table->string('towers');
            $table->string('floors');
            $table->string('units');
            $table->string('area');
            $table->string('openArea');
            $table->longText('phases', 8000);
            $table->string('floorPlanHeads', 2000);
            $table->string('floorPlanImages', 2000);
            $table->string('floorPrices', 2000);
            $table->longText('localityInfo', 8000);
            $table->string('amenities');
            $table->string('lifestyle', 600);
            $table->string('services', 600);
            $table->string('security', 600);
            $table->string('others', 600);
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
        Schema::dropIfExists('projects');
    }
}
