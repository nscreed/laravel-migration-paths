<?php
namespace NsCreed\MigrationPath;


use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class ServiceProvider extends LaravelServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole())
        {
            $this->publishes([
                __DIR__ . '/../config/laravel-migration-paths.php' => config_path('laravel-migration-paths.php'),
            ], 'config');
        }
    }

    public function register()
    {
        if ( $this->app->runningInConsole() )
        {
            $this->mergeConfigFrom(
                __DIR__ . '/../config/laravel-migration-paths.php',
                'laravel-migration-paths'
            );

            $customMigrationPaths = new CustomMigrationPaths(config('laravel-migration-paths'));
            $this->loadMigrationsFrom($customMigrationPaths->getRegisteredPaths());
        }
    }
}
