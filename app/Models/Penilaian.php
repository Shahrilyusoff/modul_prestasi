<?php

// app/Models/Penilaian.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $fillable = [
        'tempoh_penilaian_id', 'pyd_id', 'ppp_id', 'ppk_id', 
        'bahagian_iii', 'bahagian_iv', 'bahagian_v', 
        'bahagian_vi_ppp', 'bahagian_vi_ppk',
        'markah_keseluruhan_ppp', 'markah_keseluruhan_ppk', 'markah_purata',
        'ulasan_ppp', 'ulasan_ppk', 'tempoh_penilaian_ppp', 'tempoh_penilaian_ppk',
        'status'
    ];

    protected $casts = [
        'bahagian_iii' => 'array',
        'bahagian_iv' => 'array',
        'bahagian_v' => 'array',
    ];

    public function tempohPenilaian()
    {
        return $this->belongsTo(TempohPenilaian::class);
    }

    public function pyd()
    {
        return $this->belongsTo(User::class, 'pyd_id');
    }

    public function ppp()
    {
        return $this->belongsTo(User::class, 'ppp_id');
    }

    public function ppk()
    {
        return $this->belongsTo(User::class, 'ppk_id');
    }

    public function sasaranKerja()
    {
        return $this->hasMany(SasaranKerja::class);
    }

    public function kegiatanLuar()
    {
        return $this->hasMany(KegiatanLuar::class);
    }

    public function latihan()
    {
        return $this->hasMany(Latihan::class);
    }
}
