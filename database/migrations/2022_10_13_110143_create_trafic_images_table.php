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
        Schema::create('trafic_images', function (Blueprint $table) {
            $table->id();
            $table->string('unique_group_id');
            $table->string('checkpoint_id'); 
            $table->string('checkpoint');           
            $table->string('title');
            $table->string('date');
            $table->string('image');
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
        Schema::dropIfExists('trafic_images');
    }
};
