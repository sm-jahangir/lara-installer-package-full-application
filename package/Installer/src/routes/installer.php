<?php

use Codersgift\Installer\Http\Controllers\InstallerController;
use Illuminate\Support\Facades\Route;

// Grouping installation routes
Route::group(['middleware' => 'installcheck', 'prefix' => 'install'], function () {
    
    // Route to initiate installation
    Route::get('/', [InstallerController::class, 'welcomeInstaller'])
        ->name('system.install');
        
        Route::get('server/permission', [InstallerController::class, 'permission'])->name('permission');
        Route::get('database/create', [InstallerController::class, 'create'])->name('create');
        Route::get('setup/database', [InstallerController::class, 'dbStore'])->name('db.setup');
        Route::get('database/check', [InstallerController::class, 'checkDbConnection'])->name('check.db');
        Route::get('setup/import/sql', [InstallerController::class, 'importSql'])->name('sql.setup');
    
        Route::get('import/fresh/data', [InstallerController::class, 'importFreshSql'])->name('import.fresh.data'); // upload fresh data
        Route::get('import/dummy/data', [InstallerController::class, 'importDummySql'])->name('import.dummy.data'); // upload dummy data
    
        Route::get('setup/org/create', [InstallerController::class, 'orgCreate'])->name('org.create');
        Route::post('setup/org/store', [InstallerController::class, 'orgSetup'])->name('org.store');
        Route::get('setup/admin', [InstallerController::class, 'adminCreate'])->name('admin.create');
        Route::post('setup/admin/store', [InstallerController::class, 'adminStore'])->name('admin.store');



});

// Protected routes that require the application to be installed
Route::group(['middleware' => 'installed'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/hello-world', function () {
        return "Hello world page, finally done";
    })->name('helloworld');
});
