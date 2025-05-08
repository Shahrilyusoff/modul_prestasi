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
        Schema::create('latihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penilaian_id')->constrained();
            $table->string('nama_latihan');
            $table->string('sijil')->nullable();
            $table->date('tarikh_mula');
            $table->date('tarikh_tamat');
            $table->string('tempat');
            $table->boolean('diperlukan')->default(false);
            $table->string('sebab_diperlukan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihans');
    }
};
