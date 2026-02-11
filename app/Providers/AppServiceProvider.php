<?php

namespace App\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\ServiceProvider;
// Supprimer les références à MaintenanceMode

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        // SUPPRIMER le binding MaintenanceMode
        $this->app->singleton('files', function () {
            return new Filesystem();
        });
    }

    public function boot()
    {
        // Configuration moderne pour le mode maintenance
        // Removed binding for MaintenanceModeException as it is undefined
    }
}