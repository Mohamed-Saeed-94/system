<?php

namespace App\Modules\Core\Support;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale', config('app.locale', 'en'));
        App::setLocale($locale);

        if ($locale === 'ar') {
            config(['backpack.theme-tabler.classes.body' => 'rtl text-end']);
        }

        return $next($request);
    }
}

