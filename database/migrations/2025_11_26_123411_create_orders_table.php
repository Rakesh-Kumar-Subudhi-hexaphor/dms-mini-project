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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_no')->unique()->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('Product_id');
            $table->integer('unit')->default(0);
            $table->decimal('price', 10, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->string('permission')->nullable();
            $table->string('status')->default('0');
            $table->string('order_qty_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
