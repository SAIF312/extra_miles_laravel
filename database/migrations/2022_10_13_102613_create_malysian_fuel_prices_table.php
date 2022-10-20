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
        Schema::create('malysian_fuel_prices', function (Blueprint $table) {
            $table->id();
            $table->string('unique_group_id');
            $table->string('type');           
            $table->string('title');
            $table->float('price');
            $table->string('currency');
            $table->float('change_in_price')->nullable();
            
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
        Schema::dropIfExists('malysian_fuel_prices');
    }
};
