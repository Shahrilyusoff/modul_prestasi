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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tempoh_penilaian_id')->constrained();
            $table->foreignId('pyd_id')->constrained('users');
            $table->foreignId('ppp_id')->constrained('users');
            $table->foreignId('ppk_id')->nullable()->constrained('users');
            $table->json('bahagian_iii')->nullable(); // Work output evaluation
            $table->json('bahagian_iv')->nullable(); // Knowledge & skills
            $table->json('bahagian_v')->nullable(); // Personal qualities
            $table->integer('bahagian_vi_ppp')->nullable(); // External contributions (PPP)
            $table->integer('bahagian_vi_ppk')->nullable(); // External contributions (PPK)
            $table->integer('markah_keseluruhan_ppp')->nullable();
            $table->integer('markah_keseluruhan_ppk')->nullable();
            $table->integer('markah_purata')->nullable();
            $table->text('ulasan_ppp')->nullable();
            $table->text('ulasan_ppk')->nullable();
            $table->date('tempoh_penilaian_ppp')->nullable();
            $table->date('tempoh_penilaian_ppk')->nullable();
            $table->enum('status', ['draf', 'penilaian_ppp', 'penilaian_ppk', 'selesai'])->default('draf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
