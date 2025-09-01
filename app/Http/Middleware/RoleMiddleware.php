<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = $request->user();

        // Sesuaikan akses role di kolom users.role (string)
        if (!$user->hasAnyRole($roles)) {
            abort(403); // Forbidden
        }

        return $next($request);
    }
}
