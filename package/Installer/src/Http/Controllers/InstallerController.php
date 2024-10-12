<?php

namespace Codersgift\Installer\Http\Controllers;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\View\Components\Alert;



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

    public function importFreshSql()
    {
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');

        return $this->orgCreate();
    }
    protected function orgCreate()
    {
        return view('installer::install.setupOrg');
    }

    public function orgSetup(Request $request)
    {
        // return $request->all();
        
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '-' . $logo->getClientOriginalName();
            $logoPath = $logo->storeAs('public/logos', $logoName); // Saves in storage/app/public/logos
            $logoUrl = Storage::url($logoPath);
            Setting::updateOrCreate(
                ['name' => 'logo'], 
                ['value' => $logoUrl]
            );
        }

        if ($request->has('company_name')) {
            Setting::updateOrCreate(['name' => 'company_name'], ['value' => $request->company_name]);
        }

        if ($request->has('company_email')) {
            Setting::updateOrCreate(['name' => 'company_email'], ['value' => $request->company_email]);
        }

        if ($request->has('company_phone_number')) {
            Setting::updateOrCreate(['name' => 'company_phone_number'], ['value' => $request->company_phone_number]);
        }

        if ($request->has('company_tel_number')) {
            Setting::updateOrCreate(['name' => 'company_tel_number'], ['value' => $request->company_tel_number]);
        }

        if ($request->has('company_address')) {
            Setting::updateOrCreate(['name' => 'company_address'], ['value' => $request->company_address]);
        }

        if ($request->has('test_connection_email')) {
            Setting::updateOrCreate(['name' => 'test_connection_email'], ['value' => $request->test_connection_email]);
            overWriteEnvFile('TEST_CONNECTION_MAIL', $request->test_connection_email);
        }

        if ($request->has('test_connection_sms')) {
            Setting::updateOrCreate(['name' => 'test_connection_sms'], ['value' => $request->test_connection_sms]);
            overWriteEnvFile('TEST_CONNECTION_SMS', $request->test_connection_sms);
        }
        return $this->adminCreate();

    }
    //admin create page
    protected function adminCreate()
    {
        return view('installer::install.user');
    }


    //create a admin with full access
    //save and add the super access permission
    // replace the RouteService provider when installation is done
    //return the dashboard when all is done
    public function adminStore(Request $request)
    {

        $checkUser = User::where('email', $request->email)->count();

        if ($checkUser == 0) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role_id = 1;
            $user->status = 1;

            if ($user->save()) {
                overWriteEnvFile('APP_INSTALL', 'YES');
                //replace the env file
                $se = Str::before(env('APP_URL'), '/public');

                overWriteEnvFile('APP_URL', $se);

                return view('installer::install.done');
            } else {
                Alert::error(translate('Whoops'), translate('There are some problem try again'));

                return back();
            }
        } else {
            Alert::error(translate('Whoops'), translate('User Already Exist'));

            return back();
        }
    }
    public function instalComplete() {

        Artisan::call('optimize:clear');

        return redirect()->to('/');
    }


    
    

}