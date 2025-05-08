<?php

// app/Models/TempohPenilaian.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempohPenilaian extends Model
{
    use HasFactory;

    protected $fillable = ['nama_tempoh', 'jenis', 'aktif'];

    protected $casts = [
        'tarikh_mula' => 'date',
        'tarikh_tamat' => 'date',
    ];
    

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
