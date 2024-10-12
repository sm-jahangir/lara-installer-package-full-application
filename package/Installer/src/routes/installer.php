<?php

use Codersgift\Installer\Http\Controllers\InstallerController;
use Illuminate\Support\Facades\Route;

// Grouping installation routes
Route::group(['middleware' => 'installcheck', 'prefix' => 'install'], function () {
    
    // Route to initiate installation
    Route::get('/', [InstallerController::class, 'index'])
        ->name('system.install');


    // ... additional installation routes
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
