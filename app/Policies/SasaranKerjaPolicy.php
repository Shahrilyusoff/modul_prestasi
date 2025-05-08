<?php

// app/Policies/SasaranKerjaPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\SasaranKerja;
use Illuminate\Auth\Access\HandlesAuthorization;

class SasaranKerjaPolicy
{
    use HandlesAuthorization;

    public function view(User $user, SasaranKerja $sasaranKerja)
    {
        $penilaian = $sasaranKerja->penilaian;
        
        if ($user->role === 'superadmin' || $user->role === 'admin') {
            return true;
        }
        
        if ($user->role === 'pyd') {
            return $penilaian->pyd_id === $user->id;
        }
        
        if ($user->role === 'ppp') {
            return $penilaian->ppp_id === $user->id;
        }
        
        if ($user->role === 'ppk') {
            return $penilaian->ppk_id === $user->id;
        }
        
        return false;
    }

    public function create(User $user, SasaranKerja $sasaranKerja)
    {
        $penilaian = $sasaranKerja->penilaian;
        
        if ($user->role === 'superadmin' || $user->role === 'admin') {
            return true;
        }
        
        if ($user->role === 'pyd') {
            return $penilaian->pyd_id === $user->id;
        }
        
        if ($user->role === 'ppp') {
            return $penilaian->ppp_id === $user->id;
        }
        
        return false;
    }

    public function update(User $user, SasaranKerja $sasaranKerja)
    {
        $penilaian = $sasaranKerja->penilaian;
        
        if ($user->role === 'superadmin' || $user->role === 'admin') {
            return true;
        }
        
        if ($user->role === 'pyd') {
            return $penilaian->pyd_id === $user->id;
        }
        
        if ($user->role === 'ppp') {
            return $penilaian->ppp_id === $user->id;
        }
        
        return false;
    }

    public function delete(User $user, SasaranKerja $sasaranKerja)
    {
        $penilaian = $sasaranKerja->penilaian;
        
        if ($user->role === 'superadmin' || $user->role === 'admin') {
            return true;
        }
        
        if ($user->role === 'pyd') {
            return $penilaian->pyd_id === $user->id;
        }
        
        return false;
    }

    public function modify(User $user, SasaranKerja $sasaranKerja)
    {
        $penilaian = $sasaranKerja->penilaian;
        
        if ($user->role === 'superadmin' || $user->role === 'admin') {
            return true;
        }
        
        if ($user->role === 'pyd') {
            return $penilaian->pyd_id === $user->id;
        }
        
        if ($user->role === 'ppp') {
            return $penilaian->ppp_id === $user->id;
        }
        
        return false;
    }
}
