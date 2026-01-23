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
        Schema::create('parking_histories', function (Blueprint $table) {
            $table->id();

            // Relasi ke Lokasi Parkir (Jika lokasi dihapus, history ikut hilang - cascade)
            $table->foreignId('parking_location_id')
                  ->constrained('parking_locations')
                  ->onDelete('cascade');

            // Relasi ke User (Petugas) yang melakukan aksi
            // Tidak pakai cascade delete supaya jika user dihapus, log tetap ada
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('restrict');

            $table->integer('previous_available'); // Snapshot jumlah sebelum update
            $table->integer('new_available');      // Snapshot jumlah selepas update

            // Jenis aksi untuk memudahkan filtering laporan nanti
            $table->enum('action', ['increment', 'decrement', 'set_full', 'set_open', 'reset']);

            // Keterangan tambahan (pilihan) - berguna jika ada nota manual dari petugas
            $table->text('notes')->nullable();

            // Created_at akan menjadi 'timestamp' kejadian
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parking_histories');
    }
};
