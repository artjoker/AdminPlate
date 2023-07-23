<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

/**
 * Class SetLocale.
 */
class SetLocale
{
    /**
     * Смена языка.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var string $raw_locale */
        $raw_locale = Session::get('backend_locale');

        /** @var array<int, string> $backend_locales */
        $backend_locales = config('app.backend_locales');

        if (in_array($raw_locale, $backend_locales, true)) {
            $locale = $raw_locale;
        } else {
            /** @var string $locale */
            $locale = config('app.backend_locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
