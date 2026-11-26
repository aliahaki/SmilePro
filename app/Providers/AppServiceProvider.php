<?php

namespace App\Providers;

use App\Services\HomePaginaService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Registreert de Service voor de homepagina.
        $this->app->singleton(
            HomePaginaService::class,
            fn() => new HomePaginaService()
        );
    }

    public function boot(): void
    {
        //
    }
}
