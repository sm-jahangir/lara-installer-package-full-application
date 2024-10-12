<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Laravel Installer package


Step: env file
	APP_INSTALL=NO

Step: bootstrap/providers.php
	   Codersgift\Installer\InstallerServiceProvider::class,

Step: composer.json file
	"autoload-dev": {
      	      "psr-4": {
           		"Tests\\": "tests/",
           		"Codersgift\\Installer\\": "package/Installer/src/"
       	      }
   	},

Step 3: Publish the Assets
php artisan vendor:publish --tag=installer-assets
This will copy the assets to public/install/css.


Step:  if you choose fresh data you have the available Setting model




Step for fresh data
The user create so user table 
	$table->foreignId('role_id')->default(2);
$table->boolean('status')->default(false);

