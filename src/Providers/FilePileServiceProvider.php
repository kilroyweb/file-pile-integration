<?php

namespace KilroyWeb\FilePile\Providers;

use Illuminate\Support\ServiceProvider;

class FilePileServiceProvider extends ServiceProvider{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \KilroyWeb\FilePile\Commands\FilePile::class,
                \KilroyWeb\FilePile\Commands\FilePileList::class,
                \KilroyWeb\FilePile\Commands\FilePileInstallPile::class,
            ]);
        }
        $this->publishes([
            __DIR__.'/../Configuration/Templates/filepile.php' => config_path('filepile.php')
        ], 'config');
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../Configuration/Templates/filepile.php', 'filepile'
        );
    }

}