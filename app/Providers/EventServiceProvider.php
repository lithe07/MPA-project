<?php

namespace App\Providers;

use Illuminate\Auth\Events\Login;
use App\Listeners\SavePendingPlaylistAfterLogin;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            SavePendingPlaylistAfterLogin::class,
        ],
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}