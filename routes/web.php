<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/lang/{locale}', function (string $locale) {
    if (! in_array($locale, ['ar', 'en'])) {
        abort(404);
    }

    session(['locale' => $locale]);
    App::setLocale($locale);

    return redirect()->back();
});
