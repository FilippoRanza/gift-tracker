<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home() {
        $user = Auth::user();
        return view('private.home', ['user' => $user]);
    }
}
