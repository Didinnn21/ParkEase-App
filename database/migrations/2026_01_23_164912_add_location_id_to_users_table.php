<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // User boleh ada lokasi (Petugas), boleh tiada (Admin/User biasa) -> nullable()
            $table->foreignId('parking_location_id')
                  ->nullable()
                  ->after('role') // Letak selepas kolom role
                  ->constrained('parking_locations')
                  ->onDelete('set null'); // Jika lokasi hapus, user jangan terhapus, cuma set null
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['parking_location_id']);
            $table->dropColumn('parking_location_id');
        });
    }
};
