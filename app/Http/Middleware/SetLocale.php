<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if ($user) {
            if($user->locale) {
                App::setLocale($user->locale);
            } else {
                $this->set_locale_from_cookie($request);
            }
        } else {
            $this->set_locale_from_cookie($request);
        }

        return $next($request);
    }

    function set_locale_from_cookie($request) {
        $locale = $request->cookie('locale');
        if($locale) {
            App::setLocale($locale);
        }
    }
}
