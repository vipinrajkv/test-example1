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
        Schema::create('country', function (Blueprint $table) {
            $table->increments('country_id');
            $table->string('country_name', 100);
            $table->timestamps();
        });

        Schema::create('state', function (Blueprint $table) {
            $table->increments('state_id');
            $table->integer('country_id');
            $table->string('state_name', 100);
            $table->timestamps();
        });

        Schema::create('city', function (Blueprint $table) {
            $table->increments('city_id');
            $table->integer('state_id');
            $table->string('city_name', 100);
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
        Schema::dropIfExists('country');
        Schema::dropIfExists('state');
        Schema::dropIfExists('city');
    }
};
