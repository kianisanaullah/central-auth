<?php

namespace Kiani\CentralAuth\Middleware;

use Closure;
use Illuminate\Http\Request;
use Kiani\CentralAuth\Support\CentralAuth;

class EnsureCentralRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!CentralAuth::enabled()) {
            return $next($request);
        }

        $user = $request->user();

        if (!$user) {
            abort(401, 'Unauthenticated.');
        }

        if (!method_exists($user, 'authorizeRoles')) {
            abort(500, 'CentralAuth: User model must implement authorizeRoles().');
        }

        $user->authorizeRoles($roles);

        return $next($request);
    }
}
