<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->unsignedInteger('category_id');
            $table->foreign('category_id')
                ->references('id')
                ->on('medicine_categories')
                ->onDelete('cascade');

            $table->unsignedInteger('manufacturer_id');
            $table->foreign('manufacturer_id')
                ->references('id')
                ->on('medicine_manufacturers')
                ->onDelete('cascade');

            $table->string('image')->nullable();

            $table->text('description')->nullable();



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
        Schema::dropIfExists('medicines');
    }
}
