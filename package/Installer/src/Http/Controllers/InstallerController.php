<?php

namespace Codersgift\Installer\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;



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
        // create
    public function create()
    {
        return view('installer::install.setup');
    }
    public function dbStore(Request $request)
    {
        foreach ($request->types as $type) {
            //here the get database key or data for env file
            overWriteEnvFile($type, $request[$type]);
        }
        Artisan::call('optimize:clear');

        return redirect()->route('check.db');
    }
    // checkDbConnection
    public function checkDbConnection()
    {
        try {
            DB::connection()->getPdo();
            // Redirect to import SQL page with success message
            return redirect()->route('sql.setup')->with('success', 'Your database connection done successfully');
        } catch (\Exception $e) {
            // Redirect to import SQL page with error message
            return redirect()->route('sql.setup')->with('wrong', 'Could not connect to the database. Please check your configuration');
        }
    }
    public function importSql()
    {
        return view('installer::install.importSql');
    }

}