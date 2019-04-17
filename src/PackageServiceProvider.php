<?php

namespace Robconvery\LaravelJournal;

use Illuminate\Support\ServiceProvider;
use Robconvery\LaravelJournal\Controllers\JournalController;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__ . '/Views' => resource_path('vendor/laravel-journal'),
            dirname(__DIR__) . '/database/factories' => base_path('database/factories'),
            dirname(__DIR__) . '/database/seeds' => base_path('database/seeds'),
            dirname(__DIR__) . '/tests/Feature' => base_path('tests/Feature'),
        ], 'laravel-journal');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app()->make(JournalController::class);
        $this->loadMigrationsFrom(dirname(__DIR__) . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadViewsFrom(__DIR__ . '/Views', 'laravel-journal');
    }
}
