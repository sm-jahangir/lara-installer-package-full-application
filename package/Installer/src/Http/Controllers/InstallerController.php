<?php

namespace Codersgift\Installer\Http\Controllers;

use Illuminate\Support\Str;
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

        return redirect()->route('sql.setup');
    }

    public function importSql()
    {
        try {
            // Attempt to connect to the database
            DB::connection()->getPdo();
            
            // If successful, pass a success message to the view
            return view('installer::install.importSql', ['message' => 'success', 'text' => 'Your database connection done successfully']);
        } catch (\Exception $e) {
            // If an error occurs, pass an error message to the view
            return view('installer::install.importSql', ['message' => 'wrong', 'text' => 'Could not connect to the database. Please check your configuration']);
        }
    }
        /*import here demo data with instructor register form*/
    public function importDummySql()
    {
        Artisan::call('migrate --seed');

        overWriteEnvFile('APP_INSTALL', 'YES');
        $se = Str::before(env('APP_URL'), '/public');
        overWriteEnvFile('APP_URL', $se);

        return view('installer::install.done');
    }
    

}