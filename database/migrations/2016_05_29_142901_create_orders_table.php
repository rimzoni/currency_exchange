<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('exchanged_currency');
            $table->decimal('exchanged_rate',15,6);
            $table->decimal('surcharge_percentage',3,2);
            $table->decimal('purchased_amount',20,6);
            $table->decimal('paid_amount',20,6);
            $table->decimal('surcharge_amount',20,6);
            $table->decimal('total_amount',20,6);
            $table->decimal('discount_percentage',3,2);
            $table->decimal('discount_amount',20,6);
            $table->integer('status');
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
        Schema::drop('orders');
    }
}
