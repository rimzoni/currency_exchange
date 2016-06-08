<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangedRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanged_rates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('source');
            $table->string('symbol');
            $table->decimal('rate',20,6);
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
        Schema::drop('exchanged_rates');
    }
}
