<?php

// app/Providers/AuthServiceProvider.php

namespace App\Providers;

use App\Models\Penilaian;
use App\Models\SasaranKerja;
use App\Policies\PenilaianPolicy;
use App\Policies\SasaranKerjaPolicy;
use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Penilaian::class => PenilaianPolicy::class,
        SasaranKerja::class => SasaranKerjaPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function ($user) {
            return in_array($user->role, ['superadmin', 'admin']);
        });
    }
}
