<?php

namespace Codersgift\Installer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Installed
{
    public function handle(Request $request, Closure $next)
    {
        try {
            // Check if database connection is available and APP_INSTALL is set correctly
            if (! \Illuminate\Support\Facades\DB::connection()->getPdo() || env('APP_INSTALL') !== 'YES') {
                return redirect()->route('system.install');
            }

            return $next($request);
        } catch (\Exception $exception) {
            return redirect()->route('system.install');
        }
    }
}
