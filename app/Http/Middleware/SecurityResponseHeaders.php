<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Conservative headers for Laravel-generated HTML (including Filament).
 * Nginx-served static assets need a separate hosting configuration.
 * HSTS stays explicitly OFF until HTTPS deployment/rollback is certified.
 */
final class SecurityResponseHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        if ($request->isSecure() && config('zny_security.hsts_enabled', false)) {
            $response->headers->set('Strict-Transport-Security', 'max-age=86400');
        }

        return $response;
    }
}
