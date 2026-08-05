<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTicketDomainIsolation
{
    /**
     * Only ticket pages may be served on the ticket subdomain. Everything else
     * (main-site pages, Filament /admin, etc.) belongs to the main domain.
     * Runs for every request on the 'web' group, so it wins regardless of
     * route registration order (Filament routes included).
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->getHost() === config('app.ticket_domain')) {
            $path = '/' . ltrim($request->path(), '/');

            $allowed = $path === '/'
                || str_starts_with($path, '/checkout')
                || str_starts_with($path, '/payment')
                || str_starts_with($path, '/status')
                || str_starts_with($path, '/fnt')
                || $path === '/font-css';

            if (! $allowed) {
                abort(404);
            }
        }

        return $next($request);
    }
}
