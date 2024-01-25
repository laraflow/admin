<?php

namespace VendorName\Skeleton;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use VendorName\Skeleton\Commands\InstallSkeletonCommand;
use VendorName\Skeleton\Providers\EventServiceProvider;
use VendorName\Skeleton\Providers\RepositoryServiceProvider;
use VendorName\Skeleton\Providers\RouteServiceProvider;

class SkeletonServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/skeleton.php', ':vendor_slug.skeleton'
        );

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'skeleton');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'skeleton');

        Blade::componentNamespace('VendorName\\Skeleton\\Views\\Components', 'skeleton');

        $this->loadPublishOptions();

        $this->registerCommands();

    }

    private function loadPublishOptions()
    {
        // Package Configuration
        $this->publishes([
            __DIR__ . '/../config/skeleton.php' => config_path(':vendor_slug/skeleton.php'),
        ], 'skeleton-config');

        //Package Translation
        $this->publishes([
            __DIR__ . '/../lang' => $this->app->langPath('vendor/skeleton'),
        ], 'skeleton-lang');

        //Package Blade Views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/:vendor_slug/skeleton'),
        ], 'skeleton-views');

        //Package Public Assets
        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/skeleton'),
        ], 'skeleton-assets');

        //Package Database Migrations
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'skeleton-migrations');
    }

    private function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallSkeletonCommand::class
            ]);
        }
    }
}
