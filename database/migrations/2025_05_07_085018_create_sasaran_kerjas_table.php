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
        Schema::create('sasaran_kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penilaian_id')->constrained();
            $table->string('aktiviti');
            $table->string('petunjuk_prestasi');
            $table->enum('bahagian', ['awal', 'pertengahan', 'akhir']);
            $table->boolean('ditambah')->default(false);
            $table->boolean('digugurkan')->default(false);
            $table->text('ulasan_pyd')->nullable();
            $table->text('ulasan_ppp')->nullable();
            $table->boolean('disahkan')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sasaran_kerjas');
    }
};
