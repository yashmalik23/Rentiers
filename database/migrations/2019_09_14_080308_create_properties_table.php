<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('postedBy', array("Owner","Builder","Broker"));
            $table->enum('listedFor', array("Rent", "Sell","Paying Guest"));
            $table->enum('propertyType',array("Residential","Commercial"));
            $table->string('propertySecondType');
            $table->string('propertyThirdType')->nullable();
            $table->string('multipleUnits')->nullable();
            $table->string('houseNo');
            $table->string('streetName');
            $table->string('nearByArea')->nullable();
            $table->string('locality');
            $table->string('city', 100);
            $table->enum('configuration',array("1BHK","2BHK","3BHK","4BHK","5BHK","More than 5BHK"))->nullable();
            $table->string('area'); // super+carpet unit sq. ft.
            $table->integer('bathRooms')->default(0);
            $table->integer('balconies')->default(0);
            $table->integer('rooms')->nullable(); //puja+servant+study
            $table->integer('furnishing')->nullable(); // full+semi+un
            $table->string('parking'); // covered + uncovered;
            $table->string('ageOfProperty');
            $table->string('floor')->nullable();
            $table->string('totalFloors')->nullable();
            $table->string('availableFrom')->nullable();
            $table->string('availability')->nulllable();
            $table->string('contract');
            $table->string('expectedPrice');
            $table->string('includeTaxes',20);
            $table->string('otherCharges');
            $table->string('closeTo');
            $table->string('ameneties');
            $table->string('tenant');
            $table->integer('inUse');
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
        Schema::dropIfExists('properties');
    }
}
