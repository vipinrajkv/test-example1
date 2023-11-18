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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category_name');
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
        });

        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id();
            $table->string('sub_category_name');
            $table->integer('category_id');
            $table->tinyInteger('status')->default('0');
            $table->timestamps();
        });

        if (Schema::hasTable("tbl_product")) {
            Schema::table('tbl_product', function (Blueprint $table) {
                $table->integer('category_id');
                $table->integer('sub_category_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('sub_categories');
    }
};
