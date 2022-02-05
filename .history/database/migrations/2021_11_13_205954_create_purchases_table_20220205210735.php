<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_qty');
            $table->integer('maker_id')->unsigned()->nullable();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('maintenance_id')->unsigned()->nullable();
            $table->string('maker_name');
            $table->string('category_name');
            $table->string('maintenance_name');
            $table->date('arrived_at')->unsigned()->nullable();
            $table->string('week_name');
            $table->integer('price_change')->nullable();
            $table->integer('gain_price')->nullable();
            $table->intenger()->unsigned();
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
        Schema::dropIfExists('purchases');
    }
}
