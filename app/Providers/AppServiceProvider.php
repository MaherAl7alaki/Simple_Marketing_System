<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    private function routes(): void
    {
        $apiRouteFiles = [
            'auth.php',

        ];

        Route::prefix('api')
            ->middleware('api')
            ->group(function () use ($apiRouteFiles) {
                foreach ($apiRouteFiles as $routeFile) {
                    require base_path("routes/api/{$routeFile}");
                }
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->routes();
    }
}
