<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/** Placeholder for links that are out of scope for the technical test. */
class ComingSoonController extends Controller
{
    public const SECTIONS = ['corporate', 'help', 'platform', 'login', 'resources', 'about', 'privacy', 'social'];

    public function __invoke(Request $request): View
    {
        $section = $request->query('sezione');

        return view('pages.coming-soon', [
            'section' => is_string($section) && in_array($section, self::SECTIONS, true) ? $section : null,
        ]);
    }
}
