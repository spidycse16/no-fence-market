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
            $table->string('product_name');
            $table->longText('description');
            $table->string('sku');
            $table->foreignId('seller_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('catagory_id')->constrained('catagories')->onDelete('cascade');
            $table->foreignId('subcatagory_id')->constrained('subcatagories')->onDelete('cascade');
            $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');
            $table->decimal('regular_price',8,2);
            $table->decimal('discounted_price',8,2)->nullable();
            $table->decimal('tax_rate',5,2)->default(0.00);
            $table->integer('stock_quantity');
            $table->enum('stock_status',['In stock','Out of stock'])->default('In stock');
            $table->string('slug')->unique();
            $table->boolean('visibility')->default(false);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->enum('status',['Draft','Published']);
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
