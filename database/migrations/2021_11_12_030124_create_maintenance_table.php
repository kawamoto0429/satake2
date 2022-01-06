<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price_1pc');
            $table->integer('price_10pcs');
            $table->integer('price_30pcs');
            $table->string('jan');
            $table->integer('maker_id')->unsigned();
            $table->string('maker_name')->nullable();
            $table->integer('category_id')->unsigned();
            $table->string('category_name')->nullable();
            $table->integer('genre_id')->unsigned();
            $table->string('genre_name')->nullable();
            $table->integer('lot');
            $table->boolean('tomorrow_flg')->default(0);
            $table->boolean('nodisplay_flg')->default(0);
            $table->boolean('new_flg')->default(0);
            $table->string('imgpath')->nullable();
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
        Schema::dropIfExists('maintenances');
    }
}
