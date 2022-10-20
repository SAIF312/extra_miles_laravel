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
        Schema::create('open_biddings', function (Blueprint $table) {
            $table->id();
            $table->string('unique_group_id');
            $table->string('grade');           
            $table->string('title');
            $table->integer('qouta');
            $table->float('qouta_price');
            $table->string('qouta_price_currency');
            $table->integer('recieved');
            $table->integer('successfull')->nullable();
            $table->integer('unsuccessful')->nullable();
            $table->integer('unused')->nullable();
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
        Schema::dropIfExists('open_biddings');
    }
};
