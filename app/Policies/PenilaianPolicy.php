<?php

// app/Policies/PenilaianPolicy.php

namespace App\Policies;

use App\Models\User;
use App\Models\Penilaian;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenilaianPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Penilaian $penilaian)
    {
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

    public function create(User $user)
    {
        return in_array($user->role, ['superadmin', 'admin']);
    }

    public function update(User $user, Penilaian $penilaian)
    {
        if ($user->role === 'superadmin' || $user->role === 'admin') {
            return true;
        }
        
        if ($user->role === 'pyd' && $penilaian->status === 'draf') {
            return $penilaian->pyd_id === $user->id;
        }
        
        if ($user->role === 'ppp' && $penilaian->status === 'penilaian_ppp') {
            return $penilaian->ppp_id === $user->id;
        }
        
        if ($user->role === 'ppk' && $penilaian->status === 'penilaian_ppk') {
            return $penilaian->ppk_id === $user->id;
        }
        
        return false;
    }

    public function delete(User $user, Penilaian $penilaian)
    {
        return in_array($user->role, ['superadmin', 'admin']);
    }

    public function pyd(User $user, Penilaian $penilaian)
    {
        return $user->role === 'pyd' && $penilaian->pyd_id === $user->id;
    }
}
