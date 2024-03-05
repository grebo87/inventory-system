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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('warehouse_id');
            $table->unsignedBigInteger('currency_id');
            $table->unsignedBigInteger('measurement_unit_id');
            
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('description')->nullable();
            
            
            $table->decimal('unit_price',10,2)->nullable()->default(0);
            $table->integer('initial_stock')->nullable()->default(0);
            $table->date('date_expiration')->nullable();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('warehouse_id')->references('id')->on('warehouses');
            $table->foreign('currency_id')->references('id')->on('currencies');
            $table->foreign('measurement_unit_id')->references('id')->on('measurement_units');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
