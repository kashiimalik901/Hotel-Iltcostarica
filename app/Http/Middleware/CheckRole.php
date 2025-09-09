<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!$request->user() || !$request->user()->role) {
            abort(403, 'Unauthorized access.');
        }

        $userRole = $request->user()->role->name;
        
        if (!in_array($userRole, $roles)) {
            abort(403, 'Insufficient permissions.');
        }

        return $next($request);
    }
}
