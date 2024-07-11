<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('customer_id')->nullable();
            $table->string('order_no');
            $table->json('product');
            $table->string('status')->default('unfulfilled');
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('total');
            $table->json('tags')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
