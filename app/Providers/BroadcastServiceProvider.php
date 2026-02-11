<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Broadcast::routes();

        // Si vous utilisez des canaux, décommentez la ligne suivante :
        // require base_path('routes/channels.php');
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
