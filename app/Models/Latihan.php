<?php

// app/Models/Latihan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Latihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'penilaian_id', 'nama_latihan', 'sijil', 
        'tarikh_mula', 'tarikh_tamat', 'tempat',
        'diperlukan', 'sebab_diperlukan'
    ];

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }
}
