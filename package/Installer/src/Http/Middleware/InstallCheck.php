<?php

namespace Codersgift\Installer\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InstallCheck
{
    public function handle(Request $request, Closure $next)
    {
        if (env('APP_INSTALL') == 'NO') {
            return $next($request);
        } else {
            return redirect()->to('/');
        }
    }
}
