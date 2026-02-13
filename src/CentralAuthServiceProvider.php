<?php

namespace Kiani\CentralAuth;

use Illuminate\Support\ServiceProvider;
use Kiani\CentralAuth\Middleware\EnsureCentralRole;

class CentralAuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/central-auth.php', 'central-auth');
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/central-auth.php' => config_path('central-auth.php'),
        ], 'central-auth-config');

        $this->app['router']->aliasMiddleware('central.role', EnsureCentralRole::class);
    }
}
