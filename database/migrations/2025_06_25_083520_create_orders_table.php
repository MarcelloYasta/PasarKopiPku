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
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->decimal('total_amount', 12, 2); // Total harga pesanan
        $table->string('status')->default('pending'); // pending, processing, shipped, completed, cancelled
        $table->text('shipping_address');
        $table->string('payment_method')->nullable();
        $table->string('payment_status')->default('unpaid'); // unpaid, paid, failed
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
