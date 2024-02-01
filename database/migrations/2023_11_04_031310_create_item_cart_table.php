<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_cart', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('item_id');
                $table->unsignedBigInteger('cart_id');
                $table->integer('quantity');
                $table->timestamps();
                $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
                $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_product');
    }
}
