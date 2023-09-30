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
            $table->json('name');
            $table->json('description');
            $table->foreignId('category_id')->constrained('categories')->onUpdate('cascade')->OnDelete('cascade');
            $table->string('image')->default('default.png');
            $table->double('purchase_price', 8, 2);
            $table->double('sale_price', 8, 2);
            $table->integer('stock');
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
