<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('status')->nullable();
            $table->longText('description');
            $table->json('images')->nullable();
            $table->json('collections')->nullable();
            $table->json('tags')->nullable();
            $table->string('price');
            $table->string('compare_price')->nullable();
            $table->string('quantity')->nullable();

            $table->string('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('products');
    }
}
