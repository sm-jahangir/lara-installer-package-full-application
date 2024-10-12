<?php

namespace Codersgift\Installer;
use Illuminate\Support\ServiceProvider;
use Codersgift\Installer\Http\Middleware\InstallCheck;
use Codersgift\Installer\Http\Middleware\Installed;

class InstallerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load the views from the package's resources directory
        $this->loadViewsFrom(__DIR__.'/resources/views', 'installer');
        
        $this->loadRoutesFrom(__DIR__.'/routes/installer.php');

        // Register middleware as route middleware
        $this->app['router']->aliasMiddleware('installcheck', InstallCheck::class);
        $this->app['router']->aliasMiddleware('installed', Installed::class);

         // Load helper functions
         if (file_exists(__DIR__.'/helpers.php')) {
            require_once __DIR__.'/helpers.php';
        }


            // Publishing configuration
        $this->publishes([
            __DIR__.'/config/installer.php' => config_path('installer.php'),
        ], 'config');

         // Publish assets to public directory
        $this->publishes([
            __DIR__.'/resources/assets/install' => public_path('install'),
        ], 'installer-assets');

    }
    public function register()
    {
        
    }
    
}
