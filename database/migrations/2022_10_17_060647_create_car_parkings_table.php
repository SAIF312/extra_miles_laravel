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
        Schema::create('car_parkings', function (Blueprint $table) {
            $table->id();
            $table->string('unique_group_id');
            $table->string('name'); 
            $table->string('description');    
            $table->double('latitude');
            $table->double('longitude');       
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
        Schema::dropIfExists('car_parkings');
    }
};
