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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel categories (Harus ditaruh di atas sebelum kolom lain)
            $table->foreignId('category_id')->constrained()->cascadeOnDelete(); 
            
            $table->string('title');
            $table->string('slug')->unique(); // Untuk URL detail event
            $table->string('organizer');
            $table->date('event_date');
            $table->time('event_time');
            $table->string('location');
            $table->text('description');
            $table->integer('price');
            $table->integer('stock'); // Sisa tiket
            $table->string('poster_path')->nullable(); // Boleh kosong jika belum ada gambar
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};