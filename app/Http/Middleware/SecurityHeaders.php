<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // OWASP Security Headers
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN'); // Clickjacking protection
        $response->headers->set('X-Content-Type-Options', 'nosniff'); // MIME sniffing protection
        $response->headers->set('X-XSS-Protection', '1; mode=block'); // XSS protection
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin'); // Referrer protection
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()'); // Feature policy

        return $response;
    }
}
