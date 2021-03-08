<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

define("LOCALES", ['en', 'it']);
define("LOCALES_LONG", ['en' => 'English 🇬🇧', 'it' => 'Italiano 🇮🇹']);

class LocaleController extends Controller
{
    public function set_locale(Request $req) 
    {
        $user = User::find(Auth::id());
        $locale = $req->locale;
        if(in_array($locale, LOCALES)) {
            $user->locale = $locale;
            $user->save();
        }

        if($req->input('current-url')) {
            $url = $req->input('current-url');
        } else {
            $url = route('settings:index');
        }

        return Redirect::to($url);
    }

    public function available_locales(Request $req) 
    {
        $current = $this->get_current_locale($req);
        error_log($current);
        $output = [
            'locales' => LOCALES,
            'locales-long' => LOCALES_LONG,
            'current' => $current,
            'default' => App::getLocale(),
        ];
        return response()->json($output);
    }

    public function set_cookie_locale(Request $req)
    {
        $locale = $req->locale;
        if(in_array($locale, LOCALES)) {
            $cookie = cookie()->forever('locale', $locale);
            $output  = Redirect::to($req->input('current-url'))->withCookie($cookie);
        } else {
            abort(404);
        }
        return $output;
    }

    function get_current_locale(Request $req) {
        $user = Auth::user();
        if($user) {
            return $user->locale;
        } elseif ($req->cookie('locale')) {
            return $req->cookie('locale');
        } else {
            return App::getLocale();
        }
    }

}
