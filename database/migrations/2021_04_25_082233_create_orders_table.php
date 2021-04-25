<?php

use Illuminate\Support\Facades\Schema;
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
            $table->bigIncrements('id');
            $table->string('order_code');
            $table->integer('customer_id');
            $table->string('province_id');
            $table->string('district_id');
            $table->string('ward_id');
            $table->string('address');
            $table->integer('payment_methods');
            $table->integer('status');
            $table->integer('ship_id');
            $table->double('ship_fee');
            $table->double('total_money');
            $table->string('discount');
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
        Schema::dropIfExists('orders');
    }
}
