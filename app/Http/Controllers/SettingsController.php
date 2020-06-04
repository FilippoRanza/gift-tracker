<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SettingsController extends Controller
{
    public function index(Request $req) 
    {
        $args = ['user' => Auth::user()];
        if(isset($req->password)) {
            $args['error'] = true;
        }
        return view('private.user_settings', $args);
    }
}
