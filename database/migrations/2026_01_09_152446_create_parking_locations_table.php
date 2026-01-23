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
        // ... dalam function up()
Schema::create('parking_locations', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('address');
    $table->string('region');
    $table->decimal('latitude', 10, 8);
    $table->decimal('longitude', 11, 8);
    $table->integer('total_slots');
    $table->integer('available_slots');
    $table->integer('price_per_hour')->default(0); // <--- INI WAJIB ADA
    // Pastikan enum ini support 'open', 'full', 'closed'
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
