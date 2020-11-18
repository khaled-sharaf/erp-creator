<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
class LangController extends Controller
{
    public function lang($lang) {
        $name_cookies = env('LARAVEL_COOKIES_LANG_NAME', 'laravel_cookies_lang');
        if (session()->has($name_cookies)) {
            session()->forget($name_cookies);
            Cookie::forget($name_cookies);
        }
        if (env('USER_LANG_ALLOW') === true) {
            if (auth()->check()) {
                $user = auth()->user();
                $user->lang = $lang;
                $user->save();
            }
        }
        session()->put($name_cookies, $lang);
        setcookie($name_cookies, $lang, time() + (60 * 24 * 30 * 12), '/'); // expired after 1 year.
        return back();
    }
}
