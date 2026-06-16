<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check() || auth()->user()->email !== 'admin@admin.com') {
            abort(403, 'Unauthorized access. Only super admin (admin@admin.com) is allowed.');
        }

        return $next($request);
    }
}
