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
            $table->integer('category_id')->unsigned();
            $table->integer('genre_id')->unsigned();
            $table->integer('lot');
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
