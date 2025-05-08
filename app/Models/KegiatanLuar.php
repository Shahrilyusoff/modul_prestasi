<?php

// app/Models/KegiatanLuar.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanLuar extends Model
{
    use HasFactory;

    protected $fillable = [
        'penilaian_id', 'kegiatan', 'peringkat', 'jawatan_pencapaian'
    ];

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }
}
