<?php

namespace Codersgift\Installer\Http\Controllers;

use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Request;



class InstallerController extends Controller
{
    public function welcomeInstaller()
    {
      Artisan::call('key:generate');
      Artisan::call('optimize:clear');
      overWriteEnvFile('APP_URL', URL::to('/'));

      return view('installer::install.welcome');
    }
    // permission
    public function permission()
    {
        $permission['curl_enabled'] = function_exists('curl_version');
        $permission['db_file_write_perm'] = is_writable(base_path('.env'));
        $permission['storage'] = is_writable(base_path('storage'));
        $permission['bootstrap'] = is_readable(base_path('bootstrap/cache'));
        $permission['public'] = is_writable(base_path('public'));
        $permission['htaccess'] = is_readable(base_path('.htaccess'));

        return view('installer::install.permission', compact('permission'));
    }
}