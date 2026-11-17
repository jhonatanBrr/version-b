<?php

namespace App\Support;

use Illuminate\Http\Request;

/** Builds the URL of the current page in another locale (keeps path and query). */
final class LocaleUrl
{
    public static function switchTo(string $locale, ?Request $request = null): string
    {
        $request ??= request();
        $segments = $request->segments();

        if ($segments !== [] && in_array($segments[0], config('app.supported_locales'), true)) {
            $segments[0] = $locale;
        } else {
            array_unshift($segments, $locale);
        }

        $query = $request->getQueryString();

        return url(implode('/', $segments)).($query ? '?'.$query : '');
    }
}
