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
            $table->string('sku',25)->nullable();
            $table->string('name', 60);
            $table->text('description')->nullable();
            $table->enum('type',['simple', 'bundle', ])->default('simple');
            $table->enum('status',['publish', 'pending', 'draft' ])->default('publish');
            $table->enum('visibility',['visible', 'hide' ])->default('visible');
            $table->decimal('price',10,2);
            $table->decimal('price2',10,2);
            $table->enum('stock_status', ['in stock', 'out of stock', 'available to order'])->default('in stock');
            $table->tinyInteger('manage_stock')->default(1);
            $table->integer('stock_qty');
            $table->integer('low_stock');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->integer('platform_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
