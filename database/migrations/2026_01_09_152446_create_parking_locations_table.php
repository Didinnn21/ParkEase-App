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
        Schema::create('parking_locations', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('address');
    $table->string('region'); // Untuk fitur "Pencarian berdasarkan kelompok wilayah" (SKPL 11.c.124)
    $table->decimal('latitude', 10, 8); // Wajib untuk Google Maps
    $table->decimal('longitude', 11, 8); // Wajib untuk Google Maps
    $table->integer('total_slots');
    $table->integer('available_slots');
    $table->integer('price_per_hour')->default(0); // Tambahan untuk detail
    $table->enum('status', ['open', 'full', 'closed'])->default('open');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_locations');
    }
};
