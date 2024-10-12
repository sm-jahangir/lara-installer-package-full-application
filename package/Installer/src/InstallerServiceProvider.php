<?php

namespace Codersgift\Installer;
use Illuminate\Support\ServiceProvider;

class InstallerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/installer.php');

    }
    public function register()
    {
        
    }
    
}
