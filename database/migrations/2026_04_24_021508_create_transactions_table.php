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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique(); // ID unik untuk setiap pesanan tiket
            
            // Relasi ke tabel events
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->integer('qty'); // Jumlah tiket yang dibeli
            $table->integer('total_price');
            $table->string('payment_status')->default('pending'); // Status awal selalu pending
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};