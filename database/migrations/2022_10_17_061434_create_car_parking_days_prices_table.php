<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_parking_days_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_parking_id');
            $table->foreign('car_parking_id')->references('id')->on('car_parkings');
            $table->string('days'); 
            $table->string('timing');
            $table->string('price');           
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
        Schema::dropIfExists('car_parking_days_prices');
    }
};
