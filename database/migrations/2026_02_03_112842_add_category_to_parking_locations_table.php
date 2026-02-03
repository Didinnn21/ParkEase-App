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
        Schema::table('parking_locations', function (Blueprint $table) {
            // Menambahkan kolom kategori setelah alamat
            // Kita beri default 'umum' supaya data lama otomatis terisi
            $table->string('category')->default('umum')->after('address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('parking_locations', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn('category');
        });
    }
};
