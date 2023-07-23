<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Class AdminerAuthenticated.
 */
class AdminerAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request     $request
     * @param Closure     $next
     * @param null|string $guard
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ?string $guard = null): mixed
    {
        if (auth()->guard('admin')->check()) {
            if (auth()->guard('admin')->user()?->hasRole('Superadmin')) {
                return $next($request);
            }

            return redirect(route('backend.home'));
        }

        return redirect(url('/'));
    }
}
