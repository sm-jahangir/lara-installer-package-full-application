<?php

namespace Codersgift\Installer;
use Illuminate\Support\ServiceProvider;
use Codersgift\Installer\Http\Middleware\InstallCheck;
use Codersgift\Installer\Http\Middleware\Installed;

class InstallerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/installer.php');

        // Register middleware as route middleware
        $this->app['router']->aliasMiddleware('installcheck', InstallCheck::class);
        $this->app['router']->aliasMiddleware('installed', Installed::class);

            // Publishing configuration
        $this->publishes([
            __DIR__.'/config/installer.php' => config_path('installer.php'),
        ], 'config');

    }
    public function register()
    {
        
    }
    
}
