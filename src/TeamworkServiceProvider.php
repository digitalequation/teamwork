<?php

namespace DigitalEquation\Teamwork;

use DigitalEquation\Teamwork\Console\InstallCommand;
use DigitalEquation\Teamwork\Console\PublishCommand;
use Illuminate\Support\ServiceProvider;

class TeamworkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        /*
         * Optional methods to load the package assets.
         */
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('teamwork.php'),
            ], 'config');
        }
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'teamwork');

        $this->commands([
            InstallCommand::class,
            PublishCommand::class,
        ]);

        // Register the main class to use with the facade
        $this->app->singleton('teamwork', function () {
            return new Teamwork;
        });
    }
}
