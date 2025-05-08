<?php

// app/Models/SasaranKerja.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SasaranKerja extends Model
{
    use HasFactory;

    protected $fillable = [
        'penilaian_id', 'aktiviti', 'petunjuk_prestasi', 
        'bahagian', 'ditambah', 'digugurkan', 
        'ulasan_pyd', 'ulasan_ppp', 'disahkan'
    ];

    public function penilaian()
    {
        return $this->belongsTo(Penilaian::class);
    }
}
