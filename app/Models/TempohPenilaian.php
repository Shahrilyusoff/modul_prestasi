<?php

// app/Models/TempohPenilaian.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempohPenilaian extends Model
{
    use HasFactory;

    protected $fillable = ['nama_tempoh', 'tarikh_mula', 'tarikh_tamat', 'jenis', 'aktif'];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
