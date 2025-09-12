<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * De pad waar gebruikers naartoe worden geleid na inloggen.
     *
     * @var string
     */
    public const HOME = '/playlist/auto-save'; // 👈 aangepast vanaf '/dashboard'

    /**
     * Definieer je route bindings, patroonfilters, etc.
     */
    public function boot(): void
    {
        $this->routes(function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
}