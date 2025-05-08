<?php

// app/Http/Middleware/SetLocale.php

namespace App\Http\Middleware;

use Closure;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        app()->setLocale('ms');
        return $next($request);
    }
}
