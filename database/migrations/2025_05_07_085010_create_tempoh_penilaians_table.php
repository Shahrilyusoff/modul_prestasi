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
        Schema::create('tempoh_penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tempoh');
            $table->date('tarikh_mula');
            $table->date('tarikh_tamat');
            $table->enum('jenis', ['sasaran_awal', 'pertengahan', 'akhir']);
            $table->boolean('aktif')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempoh_penilaians');
    }
};
