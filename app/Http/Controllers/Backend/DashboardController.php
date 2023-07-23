<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('backend.dashboard.index');
    }

    /**
     * @return RedirectResponse
     */
    public function clearCache(): RedirectResponse
    {
        Cache::flush();

        return redirect()->back()->with('success', __('backend.cache_cleared'));
    }

    /**
     * Switch language.
     *
     * @param string $locale
     *
     * @return RedirectResponse
     */
    public function setLocale(string $locale): RedirectResponse
    {
        /** @var array<string> $locales */
        $locales = config('app.backend_locales');

        if (in_array($locale, $locales, true)) {
            session()->put('backend_locale', $locale);
        }

        return redirect()->back();
    }
}
