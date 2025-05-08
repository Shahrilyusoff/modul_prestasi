<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'jawatan', 'gred', 'jabatan', 'no_kp', 'jenis', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function penilaianSebagaiPYD()
    {
        return $this->hasMany(Penilaian::class, 'pyd_id');
    }

    public function penilaianSebagaiPPP()
    {
        return $this->hasMany(Penilaian::class, 'ppp_id');
    }

    public function penilaianSebagaiPPK()
    {
        return $this->hasMany(Penilaian::class, 'ppk_id');
    }
}