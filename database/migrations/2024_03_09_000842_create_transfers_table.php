<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('origin_warehouse_id');
            $table->unsignedBigInteger('destination_warehouse_id');
            $table->string('reason')->nullable();
            $table->integer('quantity');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('origin_warehouse_id')->references('id')->on('warehouses');
            $table->foreign('destination_warehouse_id')->references('id')->on('warehouses');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
