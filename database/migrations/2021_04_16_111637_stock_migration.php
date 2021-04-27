<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StockMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('sl');
            $table->string('stockid');
            $table->string('category');
            $table->string('description');
            $table->integer('quantity');
            $table->float('amount');
            $table->string('unit');
            $table->string('client');
            $table->date('stockdate');
            $table->date('stockuntil');
            $table->date('discharge_date')->nullable();
            $table->string('status')->default('Stocked');
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
        Schema::dropIfExists('stocks');
    }
}
