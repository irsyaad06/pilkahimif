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
        Schema::create('waktu_pemilihan', function (Blueprint $table) {
            $table->id();
            // Nama periode (opsional, misal "Pemilu Raya 2025")
            $table->string('name')->default('PILKAHIM IF 2025');
            
            // Waktu mulai dan selesai
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_berakhir');
            
            // Status aktif/tidak (opsional, untuk mematikan manual jika perlu)
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waktu_pemilihan');
    }
};