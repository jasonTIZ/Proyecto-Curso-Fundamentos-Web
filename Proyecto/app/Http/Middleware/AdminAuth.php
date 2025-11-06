<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->has('admin_id')) {
            return $next($request);
        }

        return redirect()->route('admin.login');
    }
}
