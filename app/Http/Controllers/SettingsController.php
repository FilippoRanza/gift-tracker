<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{

    public function index() 
    {
        return view('private.user_settings', ['user' => Auth::user()]);
    }


}
