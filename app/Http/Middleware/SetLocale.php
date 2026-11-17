<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

/**
 * Reads the {locale} route segment, applies it to the app and makes it the
 * default parameter so route('home') generates /it or /es automatically.
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->route('locale');

        if (! in_array($locale, config('app.supported_locales'), true)) {
            abort(404);
        }

        app()->setLocale($locale);
        URL::defaults(['locale' => $locale]);

        // Controllers do not need {locale} as an argument.
        $request->route()->forgetParameter('locale');

        return $next($request);
    }
}
