<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

define("LOCALES", ['en', 'it']);

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

        return Redirect::to(route('settings:index'));
    }

    public function available_locales() 
    {
        $user = Auth::user();
        $output = [
            'locales' => LOCALES,
            'current' => $user->locale,
            'default' => App::getLocale(),
        ];
        return response()->json($output);
    }
}