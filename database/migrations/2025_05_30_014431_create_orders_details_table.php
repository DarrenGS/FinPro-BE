<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('order_details', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->uuid('order_id');
        $table->uuid('product_id');
        $table->integer('quantity');
        $table->bigInteger('price');
        $table->timestamps();

        $table->foreign('order_id')->references('id')->on('orders')->cascadeOnDelete();
        $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
