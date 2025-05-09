<?php

// database/migrations/[timestamp]_fix_tempoh_penilaian_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixTempohPenilaianTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('tempoh_penilaians');
        Schema::dropIfExists('tempoh_penilaian');

        Schema::create('tempoh_penilaian', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tempoh');
            $table->date('tarikh_mula');
            $table->date('tarikh_tamat');
            $table->enum('jenis', ['sasaran_awal', 'pertengahan', 'akhir']);
            $table->boolean('aktif')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tempoh_penilaian');
    }
}
